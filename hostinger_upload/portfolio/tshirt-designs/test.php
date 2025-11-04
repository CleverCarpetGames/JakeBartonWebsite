<!DOCTYPE html>
<html>
<head>
    <title>Test Page</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        img { border: 2px solid #ccc; margin: 10px; }
        .info { background: #f0f0f0; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>T-Shirt Portfolio Diagnostic</h1>
    
    <div class="info">
        <h2>File Paths Check:</h2>
        <p>Current directory: <?php echo getcwd(); ?></p>
        <p>Thumbnail exists: <?php echo file_exists('images/thumbnails/placeholder.svg') ? '✅ YES' : '❌ NO'; ?></p>
        <p>Full image exists: <?php echo file_exists('images/full/placeholder.svg') ? '✅ YES' : '❌ NO'; ?></p>
        <p>CSS exists: <?php echo file_exists('../../assets/css/styles.css') ? '✅ YES' : '❌ NO'; ?></p>
        <p>JS exists: <?php echo file_exists('../../assets/js/gallery.js') ? '✅ YES' : '❌ NO'; ?></p>
    </div>

    <div class="info">
        <h2>Image Test:</h2>
        <p>Thumbnail (relative path):</p>
        <img src="images/thumbnails/placeholder.svg" width="200" alt="Thumbnail test">
        
        <p>Full image (relative path):</p>
        <img src="images/full/placeholder.svg" width="300" alt="Full image test">
    </div>

    <div class="info">
        <h2>Design Data:</h2>
        <?php
        $designs = [
            ['id' => 1, 'title' => 'Test 1', 'year' => '2023', 'thumbnail' => 'images/thumbnails/placeholder.svg'],
            ['id' => 2, 'title' => 'Test 2', 'year' => '2024', 'thumbnail' => 'images/thumbnails/placeholder.svg'],
        ];
        echo '<p>Number of designs: ' . count($designs) . '</p>';
        foreach($designs as $d) {
            echo '<p>- ' . $d['title'] . ' (' . $d['year'] . ')</p>';
        }
        ?>
    </div>

    <p><a href="index.php">← Back to Portfolio</a></p>
</body>
</html>
