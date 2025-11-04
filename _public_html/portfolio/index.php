<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Jake Barton</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="animated-bg"></div>

    <header>
        <nav>
            <div class="nav-logo">JB</div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="./">Portfolio</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="content-section" style="text-align: center; padding: 80px 60px;">
            <h1 style="font-size: 4rem;">My Portfolio</h1>
            <p style="font-size: 1.3rem; color: var(--text-muted); margin-top: 20px;">
                Explore my creative work across game design, 3D art, and graphic design
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-top: 40px;">
            
            <!-- T-Shirt Designs Card -->
            <div class="content-section" style="text-align: center; padding: 50px 40px; transition: all 0.4s ease; cursor: pointer;"
                 onclick="window.location.href='tshirt-designs/';"
                 onmouseover="this.style.transform='translateY(-10px) scale(1.02)'; this.style.boxShadow='0 20px 60px rgba(0, 212, 255, 0.3)';"
                 onmouseout="this.style.transform=''; this.style.boxShadow='';">
                <div style="font-size: 4rem; margin-bottom: 20px;">👕</div>
                <h2 style="color: var(--accent-blue); margin-bottom: 15px;">T-Shirt Designs</h2>
                <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 25px;">
                    Custom apparel designs created as T-Shirt Chair for Pi Kappa Phi
                </p>
                <a href="tshirt-designs/" class="btn" onclick="event.stopPropagation();">View Gallery</a>
            </div>

            <!-- Game Projects Card (Coming Soon) -->
            <div class="content-section" style="text-align: center; padding: 50px 40px; opacity: 0.7;">
                <div style="font-size: 4rem; margin-bottom: 20px;">🎮</div>
                <h2 style="color: var(--accent-purple); margin-bottom: 15px;">Game Projects</h2>
                <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 25px;">
                    Interactive experiences built in Unreal, Unity, and Godot
                </p>
                <span class="btn" style="opacity: 0.5; cursor: not-allowed;">Coming Soon</span>
            </div>

            <!-- 3D Art Card (Coming Soon) -->
            <div class="content-section" style="text-align: center; padding: 50px 40px; opacity: 0.7;">
                <div style="font-size: 4rem; margin-bottom: 20px;">🎨</div>
                <h2 style="color: var(--accent-blue); margin-bottom: 15px;">3D Art & Models</h2>
                <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 25px;">
                    3D artwork and models created in Maya and Blender
                </p>
                <span class="btn" style="opacity: 0.5; cursor: not-allowed;">Coming Soon</span>
            </div>

            <!-- Web & UX Design Card (Coming Soon) -->
            <div class="content-section" style="text-align: center; padding: 50px 40px; opacity: 0.7;">
                <div style="font-size: 4rem; margin-bottom: 20px;">💻</div>
                <h2 style="color: var(--accent-purple); margin-bottom: 15px;">Web & UX Design</h2>
                <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 25px;">
                    User interface and experience design work in Figma
                </p>
                <span class="btn" style="opacity: 0.5; cursor: not-allowed;">Coming Soon</span>
            </div>
            
        </div>

        <div class="content-section" style="text-align: center; margin-top: 60px;">
            <p style="color: var(--text-muted); font-size: 1.1rem;">
                More projects and work samples are being added regularly. Check back soon!
            </p>
        </div>
    </div>
</body>
</html>
