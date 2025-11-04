<?php
// Games Portfolio
$pageTitle = "Game Projects";

// Games data
$games = [
    [
        'id' => 1,
        'title' => 'Phase Runner',
        'description' => 'A fast-paced endless runner where you phase through dimensions to avoid obstacles. Built with Godot Engine.',
        'year' => '2024',
        'tech' => ['Godot', 'GDScript', 'Web Export'],
        'thumbnail' => 'phase-runner/PhaseRunnerWeb.png',
        'playLink' => 'phase-runner/',
        'controls' => 'Keyboard: Arrow Keys or WASD to move'
    ],
    // Add more games here as you create them
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Jake Barton</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .game-card {
            background: var(--secondary-black);
            border: 3px solid var(--border-gray);
            padding: 0;
            margin-bottom: 40px;
            transition: all 0.3s ease;
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 0;
        }

        .game-card:hover {
            border-color: var(--accent-white);
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(255, 255, 255, 0.1);
        }

        .game-thumbnail {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-right: 3px solid var(--border-gray);
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }

        .game-card:hover .game-thumbnail {
            filter: grayscale(0%);
        }

        .game-info {
            padding: 40px;
        }

        .game-info h3 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
        }

        .game-meta {
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .tech-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .tech-tag {
            background: var(--primary-black);
            border: 2px solid var(--border-gray);
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .tech-tag:hover {
            border-color: var(--accent-white);
            color: var(--accent-white);
        }

        .game-controls {
            background: var(--primary-black);
            padding: 15px;
            margin-top: 20px;
            border: 2px solid var(--border-gray);
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .game-controls strong {
            color: var(--accent-white);
        }

        @media (max-width: 768px) {
            .game-card {
                grid-template-columns: 1fr;
            }

            .game-thumbnail {
                height: 250px;
                border-right: none;
                border-bottom: 3px solid var(--border-gray);
            }

            .game-info {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <header>
        <nav>
            <div class="nav-logo">JB</div>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../">Portfolio</a></li>
                <li><a href="./">Games</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="content-section" style="text-align: center; padding: 80px;">
            <h1 style="font-size: 4.5rem;">GAME PROJECTS</h1>
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-top: 25px; max-width: 900px; margin-left: auto; margin-right: auto;">
                Interactive experiences built with <strong style="color: var(--accent-white); font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">GODOT ENGINE</strong>, 
                <strong style="color: var(--accent-white); font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">UNREAL ENGINE 5</strong>, 
                and <strong style="color: var(--accent-white); font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">UNITY</strong>. 
                Click to play directly in your browser!
            </p>
        </div>

        <div class="content-section">
            <?php foreach ($games as $game): ?>
                <div class="game-card">
                    <img src="<?php echo $game['thumbnail']; ?>" 
                         alt="<?php echo htmlspecialchars($game['title']); ?>"
                         class="game-thumbnail">
                    <div class="game-info">
                        <h3><?php echo strtoupper(htmlspecialchars($game['title'])); ?></h3>
                        <p class="game-meta">
                            <strong style="color: var(--accent-white);">YEAR:</strong> <?php echo $game['year']; ?>
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
                            <?php echo htmlspecialchars($game['description']); ?>
                        </p>
                        
                        <div class="tech-tags">
                            <?php foreach ($game['tech'] as $tech): ?>
                                <span class="tech-tag"><?php echo strtoupper($tech); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <?php if (!empty($game['controls'])): ?>
                        <div class="game-controls">
                            <strong>CONTROLS:</strong> <?php echo $game['controls']; ?>
                        </div>
                        <?php endif; ?>

                        <a href="<?php echo $game['playLink']; ?>" class="btn" style="margin-top: 25px; display: inline-block;">
                            PLAY NOW
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="content-section" style="text-align: center;">
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                More games coming soon! Check back regularly for new projects.
            </p>
        </div>
    </div>
</body>
</html>
