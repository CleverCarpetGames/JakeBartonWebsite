<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake Barton - Game Designer & 3D Artist</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <?php
    $name = "Jake Barton";
    $university = "Samford University";
    $location = "Birmingham, AL";
    $major = "Game Design & 3D Animation";
    $minor = "Computer Science";
    $year = "Junior";
    
    $skills = [
        "Python", "C++", "Godot", "Unreal Engine 5", "Unity",
        "Autodesk Maya", "Blender", "Figma", "UX Design",
        "Adobe Illustrator", "Photoshop", "Web Development"
    ];
    
    $leadership = [
        "T-Shirt Chair - Pi Kappa Phi (2 years)",
        "Social Chair - Pi Kappa Phi Alpha Eta Chapter"
    ];
    ?>

    <header>
        <nav>
            <div class="nav-logo">JB</div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="portfolio/">Portfolio</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Hero Section -->
        <div class="content-section" id="home" style="text-align: center; padding: 100px 60px; margin-top: 60px;">
            <h1 style="font-size: 4.5rem; margin-bottom: 20px; animation: fadeInUp 0.8s ease-out;">
                <?php echo $name; ?>
            </h1>
            <p style="font-size: 1.5rem; color: var(--accent-blue); margin-bottom: 15px; animation: fadeInUp 1s ease-out;">
                Game Designer | 3D Artist | Developer
            </p>
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 40px; animation: fadeInUp 1.2s ease-out;">
                <?php echo $year; ?> at <?php echo $university; ?>, <?php echo $location; ?>
            </p>
            <a href="portfolio/" class="btn" style="animation: fadeInUp 1.4s ease-out;">View My Work</a>
        </div>
        
        <!-- About Section -->
        <div class="content-section" id="about">
            <h2>About Me</h2>
            <p style="font-size: 1.15rem; line-height: 1.9;">
                I'm a <?php echo $year; ?> at <strong style="color: var(--accent-blue);"><?php echo $university; ?></strong> 
                in <?php echo $location; ?>, majoring in <strong style="color: var(--accent-purple);"><?php echo $major; ?></strong> 
                with a minor in <strong style="color: var(--accent-blue);"><?php echo $minor; ?></strong>.
            </p>
            
            <p style="font-size: 1.15rem; line-height: 1.9; margin-top: 20px;">
                I specialize in creating immersive gaming experiences and stunning 3D visuals, combining technical expertise 
                with creative design. From coding in <strong>Python</strong> and <strong>C++</strong> to bringing worlds to life in 
                <strong>Unreal Engine 5</strong>, <strong>Godot</strong>, and <strong>Unity</strong>, I'm passionate about every 
                aspect of game development.
            </p>

            <p style="font-size: 1.15rem; line-height: 1.9; margin-top: 20px;">
                My creative toolkit includes <strong>Autodesk Maya</strong>, <strong>Blender</strong>, <strong>Adobe Creative Suite</strong>, 
                and <strong>Figma</strong>, allowing me to craft everything from 3D models to user interfaces and graphic designs.
            </p>
        </div>

        <!-- Leadership Section -->
        <div class="content-section">
            <h2>Leadership & Experience</h2>
            <p style="font-size: 1.15rem; line-height: 1.9;">
                As a member of <strong style="color: var(--accent-purple);">Pi Kappa Phi Fraternity - Alpha Eta Chapter</strong>, 
                I've held key leadership positions that have sharpened my creative and organizational skills:
            </p>
            <ul style="margin-top: 25px; font-size: 1.1rem; line-height: 2;">
                <?php foreach ($leadership as $position): ?>
                    <li style="color: var(--text-muted); margin-bottom: 10px;">
                        <span style="color: var(--accent-blue);">▸</span> <?php echo $position; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p style="font-size: 1.15rem; line-height: 1.9; margin-top: 25px;">
                For two years as <strong>T-Shirt Chair</strong>, I've designed and produced custom apparel for our chapter, 
                bringing creative visions to life. Check out my <a href="portfolio/tshirt-designs/" 
                style="color: var(--accent-blue); text-decoration: none; border-bottom: 2px solid var(--accent-blue);">
                t-shirt design portfolio</a> to see my work!
            </p>
        </div>

        <!-- Skills Section -->
        <div class="content-section" id="skills">
            <h2>Technical Skills & Tools</h2>
            <p style="margin-bottom: 30px;">Technologies and software I work with:</p>
            <div class="skills-container">
                <?php foreach ($skills as $skill): ?>
                    <span class="skill-tag"><?php echo $skill; ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="content-section" style="text-align: center; padding: 60px;">
            <h2 style="margin-bottom: 25px;">Ready to See What I've Created?</h2>
            <p style="font-size: 1.2rem; margin-bottom: 35px;">
                Explore my portfolio featuring game projects, 3D artwork, and design work.
            </p>
            <a href="portfolio/" class="btn" style="margin-right: 15px;">View Portfolio</a>
            <a href="portfolio/tshirt-designs/" class="btn" style="background: rgba(139, 92, 246, 0.2); 
               border: 2px solid var(--accent-purple);">T-Shirt Designs</a>
        </div>
    </div>

    <style>
        /* Additional Hero Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>
</html>