<?php
// College Guys Pressure Washing Graphics Portfolio
$pageTitle = "College Guys Pressure Washing - Professional Graphics";

// Design data for College Guys Pressure Washing project
$designs = [
    [
        'id' => 1,
        'title' => 'College Guys Banner',
        'description' => 'Professional banner graphic for College Guys Pressure Washing',
        'year' => '2024',
        'category' => 'banner',
        'thumbnail' => 'College Guys Pressure Washing Banner.svg',
        'full' => 'College Guys Pressure Washing Banner.svg'
    ],
    [
        'id' => 2,
        'title' => 'College Guys Backdrop',
        'description' => 'Professional backdrop graphic for College Guys Pressure Washing',
        'year' => '2024',
        'category' => 'backdrop',
        'thumbnail' => 'College Guys Pressure Washing Backdrop.svg',
        'full' => 'College Guys Pressure Washing Backdrop.svg'
    ],
];

// Get unique categories for filtering
$categories = array_unique(array_column($designs, 'category'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Jake Barton</title>
    <link rel="stylesheet" href="../../../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="animated-bg"></div>

    <header>
        <nav>
            <div class="nav-logo">JB</div>
            <ul>
                <li><a href="../../../index.php">Home</a></li>
                <li><a href="../../">Portfolio</a></li>
                <li><a href="../">Professional Works</a></li>
                <li><a href="./">College Guys</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="content-section" style="text-align: center; padding: 80px;">
            <h1 style="font-size: 4.5rem;">COLLEGE GUYS PRESSURE WASHING</h1>
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-top: 25px; max-width: 900px; margin-left: auto; margin-right: auto;">
                Professional graphic design work for <strong style="color: var(--accent-white); font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">COLLEGE GUYS PRESSURE WASHING</strong>, 
                a local pressure washing business. Created banner and backdrop graphics for branding and marketing purposes.
            </p>
        </div>

        <div class="content-section">
            <!-- Filter Controls -->
            <div class="filter-controls">
                <button class="filter-btn active" data-filter="all"><span>All Graphics</span></button>
                <button class="filter-btn" data-filter="banner"><span>Banner</span></button>
                <button class="filter-btn" data-filter="backdrop"><span>Backdrop</span></button>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php foreach ($designs as $design): ?>
                    <div class="gallery-item" 
                         data-title="<?php echo htmlspecialchars($design['title']); ?>"
                         data-description="<?php echo htmlspecialchars($design['description']); ?>"
                         data-year="<?php echo $design['year']; ?>"
                         data-category="<?php echo $design['category']; ?>"
                         data-full="<?php echo $design['full']; ?>">
                        <img src="<?php echo $design['thumbnail']; ?>" 
                             alt="<?php echo htmlspecialchars($design['title']); ?>"
                             loading="lazy">
                        <div class="gallery-item-info">
                            <h3><?php echo htmlspecialchars($design['title']); ?></h3>
                            <p><?php echo ucfirst($design['category']); ?> • <?php echo $design['year']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-section" style="text-align: center;">
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                Click on any design to view it in full size. This project showcases professional client work for branding and marketing materials.
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

    <script src="../../../assets/js/gallery.js"></script>
</body>
</html>
