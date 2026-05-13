<?php
/**
 * qr.php — Printable QR business card
 * Generates a real QR code server-side with PHP + GD (no external libs)
 * Downloads a print-quality PNG via data URI
 */

// ── Pure-PHP QR Matrix Generator ────────────────────────────────────────────
// Implements QR Code 2005 spec (byte mode, EC level M) — public domain logic
// Adapted from the widely-used phpqrcode / qr-bacon implementations

class QRMatrix {
    private $size;
    private $data;
    private $reserved;

    public function __construct(private array $modules, private int $moduleCount) {}

    public static function encode(string $text, int $ecLevel = 1): self
    {
        // ecLevel: 0=L,1=M,2=Q,3=H
        $data    = array_values(unpack('C*', $text));
        $typeNum = self::getTypeNumber($data, $ecLevel);
        $matrix  = new self([], 0);
        $matrix->build($data, $typeNum, $ecLevel);
        return $matrix;
    }

    public function getModuleCount(): int { return $this->moduleCount; }
    public function isDark(int $r, int $c): bool { return $this->modules[$r][$c] ?? false; }

    // ── RS tables (full 256-entry GF(2^8)) ──────────────────────────────
    private static function expTable(): array {
        static $t;
        if ($t) return $t;
        $t = array_fill(0, 256, 0);
        for ($i = 0; $i < 8; $i++) $t[$i] = 1 << $i;
        for ($i = 8; $i < 256; $i++)
            $t[$i] = $t[$i-4] ^ $t[$i-5] ^ $t[$i-6] ^ $t[$i-8];
        return $t;
    }
    private static function logTable(): array {
        static $t;
        if ($t) return $t;
        $exp = self::expTable();
        $t   = array_fill(0, 256, 0);
        for ($i = 0; $i < 255; $i++) $t[$exp[$i]] = $i;
        return $t;
    }
    private static function gexp(int $n): int {
        $e = self::expTable();
        while ($n < 0)   $n += 255;
        while ($n >= 256) $n -= 255;
        return $e[$n];
    }
    private static function glog(int $n): int {
        if ($n < 1) throw new \RuntimeException("glog($n)");
        return self::logTable()[$n];
    }

    // ── RS block table (typeNum 1-10, ecLevel 0-3) ───────────────────────
    private static $RS = [
        // [totalCount, dataCount] × nBlocks
        // Index: (typeNum-1)*4 + ecLevel
        0 =>[[1,26,19]],   1=>[[1,26,16]],   2=>[[1,26,13]],   3=>[[1,26,9]],
        4 =>[[1,44,34]],   5=>[[1,44,28]],   6=>[[1,44,22]],   7=>[[1,44,16]],
        8 =>[[1,70,55]],   9=>[[1,70,44]],  10=>[[2,35,17]],  11=>[[2,35,13]],
        12=>[[1,100,80]], 13=>[[2,50,32]],  14=>[[2,50,24]],  15=>[[4,25,9]],
        16=>[[1,134,108]],17=>[[2,67,43]],  18=>[[2,33,15],[2,34,16]],19=>[[2,33,11],[2,34,12]],
        20=>[[2,86,68]],  21=>[[4,43,27]],  22=>[[4,43,19]],  23=>[[4,43,15]],
        24=>[[2,98,78]],  25=>[[4,49,31]],  26=>[[2,32,14],[4,33,15]],27=>[[4,39,13],[1,40,14]],
        28=>[[2,121,97]], 29=>[[2,60,38],[2,61,39]],30=>[[4,40,18],[2,41,19]],31=>[[4,40,14],[2,41,15]],
        32=>[[2,146,116]],33=>[[3,58,36],[2,59,37]],34=>[[4,36,16],[4,37,17]],35=>[[4,36,12],[4,37,13]],
        36=>[[2,86,68],[2,87,69]],37=>[[4,69,43],[1,70,44]],38=>[[6,43,19],[2,44,20]],39=>[[6,43,15],[2,44,16]],
    ];

    private static function getRSBlocks(int $typeNum, int $ecLevel): array {
        $key = ($typeNum - 1) * 4 + $ecLevel;
        if (!isset(self::$RS[$key])) throw new \RuntimeException("No RS block for type $typeNum ec $ecLevel");
        $out = [];
        foreach (self::$RS[$key] as $row) {
            // row = [count, total, data] or just [total, data] when count implicit 1
            if (count($row) === 3) {
                [$cnt, $total, $data] = $row;
                for ($i = 0; $i < $cnt; $i++) $out[] = [$total, $data];
            } else {
                $out[] = [$row[0], $row[1]];
            }
        }
        return $out;
    }

    private static function getTypeNumber(array $data, int $ecLevel): int {
        $len = count($data);
        for ($t = 1; $t <= 10; $t++) {
            $blocks = self::getRSBlocks($t, $ecLevel);
            $maxData = 0;
            foreach ($blocks as $b) $maxData += $b[1];
            // byte mode overhead: 4 (mode) + 8 (length) + 4 (term) = 2 bytes
            if ($maxData >= $len + 2) return $t;
        }
        throw new \RuntimeException("String too long for QR type 1-10");
    }

    // ── RS error correction polynomial ──────────────────────────────────
    private static function getECPoly(int $n): array {
        $p = [1];
        for ($i = 0; $i < $n; $i++) {
            $r = [1, self::gexp($i)];
            // multiply p by r
            $out = array_fill(0, count($p) + count($r) - 1, 0);
            foreach ($p as $pi => $pv)
                foreach ($r as $ri => $rv)
                    $out[$pi+$ri] ^= self::gexp((self::glog($pv) + self::glog($rv)) % 255);
            // zero entries -> replace with 0
            foreach ($out as &$v) if ($v === 0) $v = 0; // noop but explicit
            $p = $out;
        }
        return $p;
    }

    // ── Polynomial mod ──────────────────────────────────────────────────
    private static function polyMod(array $a, array $b): array {
        while (count($a) >= count($b)) {
            if ($a[0] === 0) { array_shift($a); continue; }
            $ratio = self::glog($a[0]);
            for ($i = 0; $i < count($b); $i++) {
                if ($b[$i] !== 0)
                    $a[$i] ^= self::gexp((self::glog($b[$i]) + $ratio) % 255);
            }
            array_shift($a);
        }
        return $a;
    }

    // ── Build data codewords ─────────────────────────────────────────────
    private static function createData(array $data, int $typeNum, int $ecLevel): array {
        $blocks     = self::getRSBlocks($typeNum, $ecLevel);
        $totalData  = 0;
        foreach ($blocks as $b) $totalData += $b[1];

        // Bit buffer
        $bits = [];
        // Mode: 0100 = byte
        self::pushBits($bits, 0b0100, 4);
        // Length
        $lenBits = $typeNum < 10 ? 8 : 16;
        self::pushBits($bits, count($data), $lenBits);
        // Data bytes
        foreach ($data as $byte) self::pushBits($bits, $byte, 8);
        // Terminator
        $capacity = $totalData * 8;
        $term     = min(4, $capacity - count($bits));
        if ($term > 0) self::pushBits($bits, 0, $term);
        // Pad to byte boundary
        while (count($bits) % 8 !== 0) $bits[] = 0;
        // Pad to capacity
        $padBytes = [0xEC, 0x11];
        $pi = 0;
        while (count($bits) < $capacity) {
            self::pushBits($bits, $padBytes[$pi++ % 2], 8);
        }
        // Slice into bytes
        $bytes = [];
        for ($i = 0; $i < count($bits); $i += 8) {
            $b = 0;
            for ($j = 0; $j < 8; $j++) $b = ($b << 1) | ($bits[$i+$j] ?? 0);
            $bytes[] = $b;
        }

        // Interleave data + EC
        $dataBlocks = [];
        $ecBlocks   = [];
        $offset = 0;
        foreach ($blocks as [$total, $dataCount]) {
            $ecCount = $total - $dataCount;
            $block   = array_slice($bytes, $offset, $dataCount);
            $offset += $dataCount;
            $ecPoly  = self::getECPoly($ecCount);
            $msg     = array_merge($block, array_fill(0, $ecCount, 0));
            $ecWords = self::polyMod($msg, $ecPoly);
            while (count($ecWords) < $ecCount) array_unshift($ecWords, 0);
            $dataBlocks[] = $block;
            $ecBlocks[]   = $ecWords;
        }

        $result = [];
        $maxLen = max(array_map('count', $dataBlocks));
        for ($i = 0; $i < $maxLen; $i++)
            foreach ($dataBlocks as $b)
                if (isset($b[$i])) $result[] = $b[$i];
        $maxEc = max(array_map('count', $ecBlocks));
        for ($i = 0; $i < $maxEc; $i++)
            foreach ($ecBlocks as $b)
                if (isset($b[$i])) $result[] = $b[$i];

        return $result;
    }

    private static function pushBits(array &$bits, int $val, int $n): void {
        for ($i = $n - 1; $i >= 0; $i--)
            $bits[] = ($val >> $i) & 1;
    }

    // ── BCH type info ────────────────────────────────────────────────────
    private static function bchTypeInfo(int $data): int {
        $g15 = 0x537; $g15mask = 0x5412;
        $d = $data << 10;
        while (self::bchDigit($d) - self::bchDigit($g15) >= 0)
            $d ^= $g15 << (self::bchDigit($d) - self::bchDigit($g15));
        return (($data << 10) | $d) ^ $g15mask;
    }
    private static function bchTypeNumber(int $data): int {
        $g18 = 0x1F25;
        $d = $data << 12;
        while (self::bchDigit($d) - self::bchDigit($g18) >= 0)
            $d ^= $g18 << (self::bchDigit($d) - self::bchDigit($g18));
        return ($data << 12) | $d;
    }
    private static function bchDigit(int $d): int {
        $n = 0;
        while ($d) { $n++; $d >>= 1; }
        return $n;
    }

    // ── Mask functions ───────────────────────────────────────────────────
    private static function mask(int $p, int $i, int $j): bool {
        switch ($p) {
            case 0: return ($i + $j) % 2 === 0;
            case 1: return $i % 2 === 0;
            case 2: return $j % 3 === 0;
            case 3: return ($i + $j) % 3 === 0;
            case 4: return (intdiv($i,2) + intdiv($j,3)) % 2 === 0;
            case 5: return ($i*$j%2 + $i*$j%3) === 0;
            case 6: return ($i*$j%2 + $i*$j%3) % 2 === 0;
            case 7: return ($i*$j%3 + ($i+$j)%2) % 2 === 0;
        }
        return false;
    }

    // ── Alignment pattern positions ──────────────────────────────────────
    private static $alignTable = [
        [],[6,18],[6,22],[6,26],[6,30],[6,34],
        [6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],
    ];

    // ── Build the full QR matrix ─────────────────────────────────────────
    private function build(array $data, int $typeNum, int $ecLevel): void {
        $this->moduleCount = $typeNum * 4 + 17;
        $n = $this->moduleCount;
        $this->modules   = array_fill(0, $n, array_fill(0, $n, null));
        $this->reserved  = array_fill(0, $n, array_fill(0, $n, false));

        // Finder patterns
        $this->placeFinderPattern(0, 0);
        $this->placeFinderPattern($n - 7, 0);
        $this->placeFinderPattern(0, $n - 7);

        // Separators (already covered by finder borders)
        // Format information areas
        $this->reserveFormatAreas($n);

        // Alignment patterns
        if ($typeNum >= 2) {
            $pos = self::$alignTable[$typeNum] ?? [];
            foreach ($pos as $r)
                foreach ($pos as $c) {
                    if ($this->reserved[$r][$c]) continue;
                    $this->placeAlignPattern($r, $c);
                }
        }

        // Timing patterns
        for ($i = 8; $i < $n - 8; $i++) {
            if ($this->reserved[$i][6]) continue;
            $this->modules[$i][6] = $i % 2 === 0;
            $this->reserved[$i][6] = true;
        }
        for ($i = 8; $i < $n - 8; $i++) {
            if ($this->reserved[6][$i]) continue;
            $this->modules[6][$i] = $i % 2 === 0;
            $this->reserved[6][$i] = true;
        }

        // Dark module
        $this->modules[$n - 8][8] = true;
        $this->reserved[$n - 8][8] = true;

        // Type number (version 7+)
        if ($typeNum >= 7) {
            $bits = self::bchTypeNumber($typeNum);
            for ($i = 0; $i < 18; $i++) {
                $v = (($bits >> $i) & 1) === 1;
                $r = intdiv($i, 3); $c = $i % 3 + $n - 8 - 3;
                $this->modules[$r][$c] = $v; $this->reserved[$r][$c] = true;
                $this->modules[$c][$r] = $v; $this->reserved[$c][$r] = true;
            }
        }

        // Data + EC codewords
        $codewords = self::createData($data, $typeNum, $ecLevel);
        $this->placeData($codewords);

        // Find best mask
        $bestPenalty = PHP_INT_MAX;
        $bestMask = 0;
        for ($m = 0; $m < 8; $m++) {
            $this->applyFormatInfo($ecLevel, $m, false);
            $penalty = $this->penalty();
            if ($penalty < $bestPenalty) { $bestPenalty = $penalty; $bestMask = $m; }
        }
        $this->applyFormatInfo($ecLevel, $bestMask, true);
    }

    private function placeFinderPattern(int $row, int $col): void {
        for ($r = -1; $r <= 7; $r++) {
            for ($c = -1; $c <= 7; $c++) {
                $rr = $row + $r; $cc = $col + $c;
                if ($rr < 0 || $rr >= $this->moduleCount || $cc < 0 || $cc >= $this->moduleCount) continue;
                $dark = ($r >= 0 && $r <= 6 && ($c === 0 || $c === 6))
                     || ($c >= 0 && $c <= 6 && ($r === 0 || $r === 6))
                     || ($r >= 2 && $r <= 4 && $c >= 2 && $c <= 4);
                $this->modules[$rr][$cc] = $dark;
                $this->reserved[$rr][$cc] = true;
            }
        }
    }

    private function placeAlignPattern(int $row, int $col): void {
        for ($r = -2; $r <= 2; $r++)
            for ($c = -2; $c <= 2; $c++) {
                $dark = ($r === -2 || $r === 2 || $c === -2 || $c === 2 || ($r === 0 && $c === 0));
                $this->modules[$row+$r][$col+$c] = $dark;
                $this->reserved[$row+$r][$col+$c] = true;
            }
    }

    private function reserveFormatAreas(int $n): void {
        // Around top-left finder
        for ($i = 0; $i <= 8; $i++) {
            $this->reserved[$i][8] = true;
            $this->reserved[8][$i] = true;
        }
        // Around top-right finder
        for ($i = $n-8; $i < $n; $i++) $this->reserved[8][$i] = true;
        // Around bottom-left finder
        for ($i = $n-8; $i < $n; $i++) $this->reserved[$i][8] = true;
    }

    private function placeData(array $codewords): void {
        $n    = $this->moduleCount;
        $bits = [];
        foreach ($codewords as $cw)
            for ($i = 7; $i >= 0; $i--) $bits[] = ($cw >> $i) & 1;

        $idx = 0; $up = true;
        for ($col = $n - 1; $col >= 1; $col -= 2) {
            if ($col === 6) $col--;
            for ($row = 0; $row < $n; $row++) {
                $r = $up ? $n - 1 - $row : $row;
                for ($d = 0; $d < 2; $d++) {
                    $c = $col - $d;
                    if ($this->reserved[$r][$c]) continue;
                    $this->modules[$r][$c] = isset($bits[$idx]) ? $bits[$idx++] === 1 : false;
                }
            }
            $up = !$up;
        }
    }

    private function applyFormatInfo(int $ecLevel, int $maskPattern, bool $write): void {
        $n    = $this->moduleCount;
        $ecMap = [1 => 0, 0 => 1, 3 => 2, 2 => 3]; // M=0,L=1,H=2,Q=3 → format bits
        $fi   = self::bchTypeInfo(($ecMap[$ecLevel] << 3) | $maskPattern);

        for ($i = 0; $i < 15; $i++) {
            $v = (($fi >> $i) & 1) === 1;
            // top-left horizontal
            if ($i < 6)       { if ($write) $this->modules[$i][8] = $v; }
            elseif ($i < 8)   { if ($write) $this->modules[$i+1][8] = $v; }
            else               { if ($write) $this->modules[$n-15+$i][8] = $v; }
            // top-left vertical
            if ($i < 8)       { if ($write) $this->modules[8][$n-$i-1] = $v; }
            elseif ($i < 9)   { if ($write) $this->modules[8][15-$i-1+1] = $v; }
            else               { if ($write) $this->modules[8][15-$i-1] = $v; }
        }

        if (!$write) return;
        // Apply mask to data modules
        for ($r = 0; $r < $n; $r++)
            for ($c = 0; $c < $n; $c++)
                if (!$this->reserved[$r][$c] && self::mask($maskPattern, $r, $c))
                    $this->modules[$r][$c] = !$this->modules[$r][$c];
    }

    private function penalty(): int {
        $n   = $this->moduleCount;
        $pen = 0;
        // Rule 1: 5+ in a row same color
        for ($r = 0; $r < $n; $r++) {
            $run = 1;
            for ($c = 1; $c < $n; $c++) {
                if ($this->modules[$r][$c] === $this->modules[$r][$c-1]) { $run++; if ($run === 5) $pen += 3; elseif ($run > 5) $pen++; }
                else $run = 1;
            }
        }
        for ($c = 0; $c < $n; $c++) {
            $run = 1;
            for ($r = 1; $r < $n; $r++) {
                if ($this->modules[$r][$c] === $this->modules[$r-1][$c]) { $run++; if ($run === 5) $pen += 3; elseif ($run > 5) $pen++; }
                else $run = 1;
            }
        }
        // Rule 2: 2×2 blocks
        for ($r = 0; $r < $n-1; $r++)
            for ($c = 0; $c < $n-1; $c++) {
                $v = $this->modules[$r][$c];
                if ($v===$this->modules[$r][$c+1] && $v===$this->modules[$r+1][$c] && $v===$this->modules[$r+1][$c+1]) $pen += 3;
            }
        return $pen;
    }
}

// ── Render QR to PNG data URI ─────────────────────────────────────────────
function qr_to_png_data_uri(string $url, int $cellPx = 12, int $margin = 4): string {
    $matrix  = QRMatrix::encode($url, 1); // EC level M
    $count   = $matrix->getModuleCount();
    $imgSize = ($count + $margin * 2) * $cellPx;

    $img   = imagecreatetruecolor($imgSize, $imgSize);
    $white = imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorallocate($img, 0,   0,   0);
    imagefill($img, 0, 0, $white);

    for ($r = 0; $r < $count; $r++)
        for ($c = 0; $c < $count; $c++)
            if ($matrix->isDark($r, $c)) {
                $x = ($c + $margin) * $cellPx;
                $y = ($r + $margin) * $cellPx;
                imagefilledrectangle($img, $x, $y, $x + $cellPx - 1, $y + $cellPx - 1, $black);
            }

    ob_start();
    imagepng($img);
    $png = ob_get_clean();
    imagedestroy($img);
    return 'data:image/png;base64,' . base64_encode($png);
}

// ── Generate QR ───────────────────────────────────────────────────────────
$TARGET_URL  = 'https://jakebartoncreative.com/card';
$qrDataUri   = qr_to_png_data_uri($TARGET_URL, 10, 4); // 10px/cell, 4-cell quiet zone
$qrDataUriHD = qr_to_png_data_uri($TARGET_URL, 20, 4); // 20px/cell for download
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jake Barton — QR Business Card</title>
  <link rel="icon" type="image/png" href="assets/images/jb-logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:     #0a0a0a;
      --card:   #141414;
      --border: rgba(255,255,255,0.09);
      --text:   #f5f5f5;
      --muted:  rgba(255,255,255,0.4);
      --faint:  rgba(255,255,255,0.12);
    }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Inter', system-ui, sans-serif;
      -webkit-font-smoothing: antialiased;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 3rem 1.5rem 4rem;
      gap: 2.5rem;
    }

    .qr-header {
      text-align: center;
      animation: fade-up 0.5s cubic-bezier(0.16,1,0.3,1) both;
    }
    .qr-header-eyebrow {
      font-size: 0.65rem;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      color: var(--muted);
      margin-bottom: 0.5rem;
    }
    .qr-header h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: clamp(1.6rem, 5vw, 2.2rem);
      letter-spacing: -0.03em;
    }

    .qr-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 24px;
      padding: 2rem 2rem 1.8rem;
      width: 100%;
      max-width: 360px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
      animation: fade-up 0.55s 0.08s cubic-bezier(0.16,1,0.3,1) both;
    }

    /* QR image — white background, rounded corners */
    .qr-img-wrap {
      background: #fff;
      border-radius: 16px;
      padding: 16px;
      display: inline-flex;
      line-height: 0;
    }
    .qr-img-wrap img {
      display: block;
      width: 220px;
      height: 220px;
      image-rendering: pixelated;
      image-rendering: crisp-edges;
    }

    .qr-identity { text-align: center; }
    .qr-name {
      font-family: 'Syne', sans-serif;
      font-size: 1.25rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      margin-bottom: 0.2rem;
    }
    .qr-role {
      font-size: 0.75rem;
      color: var(--muted);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .qr-url-chip {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--faint);
      border-radius: 999px;
      padding: 0.35rem 0.9rem;
      font-size: 0.7rem;
      color: var(--muted);
      font-weight: 500;
      letter-spacing: 0.03em;
    }
    .qr-url-chip svg { width: 11px; height: 11px; opacity: 0.5; flex-shrink: 0; }

    .qr-instruction {
      text-align: center;
      max-width: 280px;
      font-size: 0.75rem;
      color: var(--muted);
      line-height: 1.6;
      animation: fade-up 0.55s 0.14s cubic-bezier(0.16,1,0.3,1) both;
    }
    .qr-instruction strong { color: rgba(255,255,255,0.75); }

    .qr-actions {
      display: flex;
      flex-direction: column;
      gap: 0.65rem;
      width: 100%;
      max-width: 360px;
      animation: fade-up 0.55s 0.2s cubic-bezier(0.16,1,0.3,1) both;
    }
    .qr-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.55rem;
      padding: 0.9rem 1.25rem;
      border-radius: 14px;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.88rem;
      letter-spacing: 0.01em;
      cursor: pointer;
      border: none;
      transition: opacity 0.15s, transform 0.15s;
      text-decoration: none;
      -webkit-tap-highlight-color: transparent;
    }
    .qr-btn:active { opacity: 0.8; transform: scale(0.98); }
    .qr-btn svg { width: 17px; height: 17px; flex-shrink: 0; }
    .qr-btn-primary  { background: #fff; color: #0a0a0a; }
    .qr-btn-secondary {
      background: transparent;
      color: rgba(255,255,255,0.7);
      border: 1px solid var(--border);
    }

    @media print {
      body { background:#fff !important; color:#000 !important; padding:0; }
      .qr-header, .qr-instruction, .qr-actions { display:none !important; }
      .qr-card { background:#fff !important; border:none !important; padding:1rem; margin:0 auto; border-radius:0; }
      .qr-name, .qr-role { color:#000 !important; }
      .qr-url-chip { color:#555 !important; border-color:#ddd !important; background:#f9f9f9 !important; }
    }

    @keyframes fade-up {
      from { opacity:0; transform:translateY(12px); }
      to   { opacity:1; transform:translateY(0); }
    }
  </style>
</head>
<body>

  <div class="qr-header">
    <p class="qr-header-eyebrow">Digital Business Card</p>
    <h1>Jake Barton</h1>
  </div>

  <div class="qr-card">
    <!-- Server-rendered QR code PNG (no JS required) -->
    <div class="qr-img-wrap">
      <img src="<?= htmlspecialchars($qrDataUri) ?>"
           alt="QR code linking to jakebartoncreative.com/card"
           id="qr-img">
    </div>

    <div class="qr-identity">
      <div class="qr-name">Jake Barton</div>
      <div class="qr-role">Gameplay Programmer · Technical Designer</div>
    </div>

    <div class="qr-url-chip">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <circle cx="12" cy="12" r="10"/>
        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      jakebartoncreative.com/card
    </div>
  </div>

  <p class="qr-instruction">
    Point any camera at the QR code to open<br>
    <strong>Jake's interactive digital business card</strong><br>
    — works on iPhone, Android, and desktop.
  </p>

  <div class="qr-actions">

    <!-- Download: uses the HD version (20px/cell) as a data URI -->
    <a href="<?= htmlspecialchars($qrDataUriHD) ?>"
       download="jake-barton-qr.png"
       class="qr-btn qr-btn-primary">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Download QR Code (PNG)
    </a>

    <button class="qr-btn qr-btn-secondary" onclick="window.print()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="6 9 6 2 18 2 18 9"/>
        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
        <rect x="6" y="14" width="12" height="8"/>
      </svg>
      Print QR Card
    </button>

    <a href="/card" class="qr-btn qr-btn-secondary">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="3" width="20" height="14" rx="2"/>
        <line x1="8" y1="21" x2="16" y2="21"/>
        <line x1="12" y1="17" x2="12" y2="21"/>
      </svg>
      Preview Digital Card
    </a>

  </div>

</body>
</html>
