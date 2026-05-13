#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────────────────
#  sync-ironspark.sh
#
#  Copies the IronSpark site from your Desktop into the portfolio repo,
#  patches all absolute paths to work as a subfolder, then commits & pushes.
#
#  Usage:
#    ./sync-ironspark.sh
#    ./sync-ironspark.sh "Added new work page section"   ← custom commit message
#
#  What it does:
#    1. Copies PHP/CSS/JS/HTML/JSON from ~/Desktop/IronSpark → repo subfolder
#    2. Skips large video files (they're already on Hostinger via direct FTP)
#    3. Replaces all absolute paths  /css/ /js/ /Assets/  with the subfolder prefix
#    4. Fixes the CSS mask-image path for the orange logo
#    5. Commits with a timestamp and pushes — GitHub Actions deploys to Hostinger
# ─────────────────────────────────────────────────────────────────────────────

set -e

# ── Config ────────────────────────────────────────────────────────────────────
SRC="$HOME/Desktop/IronSpark"
DEST="$(dirname "$0")/_public_html/portfolio/professional-works/IronSpark"
PREFIX="/portfolio/professional-works/IronSpark"
COMMIT_MSG="${1:-"sync: IronSpark update $(date '+%Y-%m-%d %H:%M')"}"

# ── Sanity checks ─────────────────────────────────────────────────────────────
if [ ! -d "$SRC" ]; then
  echo "❌  Source not found: $SRC"
  echo "    Make sure your IronSpark project is at ~/Desktop/IronSpark"
  exit 1
fi

cd "$(dirname "$0")"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  IronSpark Sync → Portfolio Repo"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  Source : $SRC"
echo "  Dest   : $DEST"
echo ""

# ── Step 1: Copy files (skip videos and .git) ─────────────────────────────────
echo "📁  Copying files..."
rsync -av \
  --exclude="*.mp4" \
  --exclude="*.mov" \
  --exclude="*.webm" \
  --exclude="*.mkv" \
  --exclude=".git" \
  --exclude=".DS_Store" \
  --exclude="node_modules" \
  "$SRC/" "$DEST/"
echo ""

# ── Step 2: Patch absolute paths in all PHP/CSS/JS/HTML files ─────────────────
echo "🔧  Patching absolute paths..."

FILES=$(find "$DEST" \
  -not -path "$DEST/.git/*" \
  -not -name "showcase.php" \
  \( -name "*.php" -o -name "*.css" -o -name "*.js" -o -name "*.html" -o -name "*.json" \))

PATCHED=0
for f in $FILES; do
  # Replace /css/ /js/ /Assets/ /send-mail.php and page hrefs
  # but only when they appear as root-absolute paths (starting with /)
  if grep -qE "(src|href|url|action)=[\"']/" "$f" 2>/dev/null || \
     grep -qE "url\s*\(" "$f" 2>/dev/null; then

    sed -i '' \
      -e "s|src=\"/css/|src=\"${PREFIX}/css/|g" \
      -e "s|href=\"/css/|href=\"${PREFIX}/css/|g" \
      -e "s|src=\"/js/|src=\"${PREFIX}/js/|g" \
      -e "s|href=\"/js/|href=\"${PREFIX}/js/|g" \
      -e "s|src=\"/Assets/|src=\"${PREFIX}/Assets/|g" \
      -e "s|href=\"/Assets/|href=\"${PREFIX}/Assets/|g" \
      -e "s|url('/Assets/|url('${PREFIX}/Assets/|g" \
      -e "s|url(\"/Assets/|url(\"${PREFIX}/Assets/|g" \
      -e "s|href=\"/about|href=\"${PREFIX}/about|g" \
      -e "s|href=\"/services|href=\"${PREFIX}/services|g" \
      -e "s|href=\"/work|href=\"${PREFIX}/work|g" \
      -e "s|href=\"/contact|href=\"${PREFIX}/contact|g" \
      -e "s|href=\"/home|href=\"${PREFIX}/index.php|g" \
      -e "s|href=\"/index|href=\"${PREFIX}/index|g" \
      -e "s|action=\"/send-mail|action=\"${PREFIX}/send-mail|g" \
      -e "s|fetch('/send-mail|fetch('${PREFIX}/send-mail|g" \
      -e "s|fetch(\"/send-mail|fetch(\"${PREFIX}/send-mail|g" \
      "$f"
    PATCHED=$((PATCHED + 1))
  fi
done

echo "    Patched $PATCHED files."
echo ""

# ── Step 3: Fix the .htaccess (remove standalone redirect rules) ──────────────
echo "🔧  Fixing .htaccess..."
cat > "$DEST/.htaccess" << 'HTEOF'
# IronSpark sub-folder .htaccess
# Standalone redirect rules removed — site is embedded at /portfolio/professional-works/IronSpark/
RewriteEngine On

# Remove .php extension from URLs (e.g. /about -> about.php)
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php [L]
HTEOF
echo "    .htaccess updated."
echo ""

# ── Step 4: Commit & push ─────────────────────────────────────────────────────
echo "🚀  Committing and pushing..."
git add "$DEST"
git add "$DEST/.htaccess"

# Only commit if there are actual changes
if git diff --cached --quiet; then
  echo "    ✅  No changes detected — everything is already up to date."
else
  git commit -m "$COMMIT_MSG"
  git push
  echo ""
  echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
  echo "  ✅  Done! GitHub Actions is now deploying to Hostinger."
  echo "      View progress: https://github.com/jake-barton/JakeBartonWebsite/actions"
  echo ""
  echo "  Live URL (for leadership):"
  echo "      https://jakebartoncreative.com/portfolio/professional-works/IronSpark/"
  echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
fi
