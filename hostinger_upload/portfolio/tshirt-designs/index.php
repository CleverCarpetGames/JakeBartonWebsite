<?php
// T-Shirt Design Portfolio
$pageTitle = "T-Shirt Designs Portfolio";

// Design data - Add your designs here!
$designs = [
    [
        'id' => 1,
        'title' => 'Southern Gents Design 1',
        'description' => 'Custom t-shirt design for Pi Kappa Phi - Southern Gents collection',
        'year' => '2024',
        'thumbnail' => 'images/thumbnails/SouthernGents-01.svg',
        'full' => 'images/full/SouthernGents-01.svg'
    ],
    [
        'id' => 2,
        'title' => 'Southern Gents Design 2',
        'description' => 'Custom t-shirt design for Pi Kappa Phi - Southern Gents collection',
        'year' => '2024',
        'thumbnail' => 'images/thumbnails/SouthernGents_Artboard 1-02.svg',
        'full' => 'images/full/SouthernGents_Artboard 1-02.svg'
    ],
    [
        'id' => 3,
        'title' => 'Southern Gents Design 3',
        'description' => 'Custom t-shirt design for Pi Kappa Phi - Southern Gents collection',
        'year' => '2024',
        'thumbnail' => 'images/thumbnails/SouthernGents_Artboard 1-03.svg',
        'full' => 'images/full/SouthernGents_Artboard 1-03.svg'
    ],
    [
        'id' => 4,
        'title' => 'Southern Gents Design 4',
        'description' => 'Custom t-shirt design for Pi Kappa Phi - Southern Gents collection',
        'year' => '2024',
        'thumbnail' => 'images/thumbnails/SouthernGents_Artboard 1-04.svg',
        'full' => 'images/full/SouthernGents_Artboard 1-04.svg'
    ],
    [
        'id' => 5,
        'title' => 'Southern Gents Design 5',
        'description' => 'Custom t-shirt design for Pi Kappa Phi - Southern Gents collection',
        'year' => '2024',
        'thumbnail' => 'images/thumbnails/SouthernGents_Artboard 1-05.svg',
        'full' => 'images/full/SouthernGents_Artboard 1-05.svg'
    ],
    // Add more designs here as you upload them
];

// Get unique years for filtering
$years = array_unique(array_column($designs, 'year'));
sort($years);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Jake Barton</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="animated-bg"></div>

    <header>
        <nav>
            <div class="nav-logo">JB</div>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../">Portfolio</a></li>
                <li><a href="./">T-Shirt Designs</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="content-section" style="text-align: center; padding: 80px;">
            <h1 style="font-size: 4.5rem;"><?php echo strtoupper($pageTitle); ?></h1>
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-top: 25px; max-width: 900px; margin-left: auto; margin-right: auto;">
                A showcase of custom t-shirt designs I've created as <strong style="color: var(--accent-white); font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">T-SHIRT CHAIR</strong> 
                for Pi Kappa Phi Fraternity - Alpha Eta Chapter over the past two years.
            </p>
        </div>

        <div class="content-section">
            <!-- Filter Controls -->
            <div class="filter-controls">
                <button class="filter-btn active" data-filter="all"><span>All Designs</span></button>
                <?php foreach ($years as $year): ?>
                    <button class="filter-btn" data-filter="<?php echo $year; ?>"><span><?php echo $year; ?></span></button>
                <?php endforeach; ?>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php foreach ($designs as $design): ?>
                    <div class="gallery-item" 
                         data-title="<?php echo htmlspecialchars($design['title']); ?>"
                         data-description="<?php echo htmlspecialchars($design['description']); ?>"
                         data-year="<?php echo $design['year']; ?>">
                        <img src="<?php echo $design['thumbnail']; ?>" 
                             alt="<?php echo htmlspecialchars($design['title']); ?>"
                             loading="lazy">
                        <div class="gallery-item-info">
                            <h3><?php echo htmlspecialchars($design['title']); ?></h3>
                            <p><?php echo $design['year']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-section" style="text-align: center;">
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                Click on any design to view it in full size. More designs will be added as they are created!
            </p>
        </div>
    </div>

    <!-- Modal for full-size images -->
    <div id="designModal" class="modal">
        <span class="close">&times;</span>
        <span class="modal-nav modal-prev">&#10094;</span>
        <span class="modal-nav modal-next">&#10095;</span>
        <div class="modal-content">
            <img id="modalImage" src="" alt="">
            <div class="modal-info">
                <h2 id="modalTitle"></h2>
                <p id="modalDescription"></p>
                <p><strong style="color: var(--accent-blue);">Year:</strong> <span id="modalYear"></span></p>
            </div>
        </div>
    </div>

    <script src="../../assets/js/gallery.js"></script>
</body>
</html>
