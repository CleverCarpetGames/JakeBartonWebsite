<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake Barton - Game Designer & 3D Artist</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
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
    
    $contact = [
        'email' => 'jbarton4@samford.edu',
        'phone' => '615.943.9722',
        'address' => '800 Lakeshore Dr., Birmingham, AL',
        'instagram' => 'jakebarton13',
        'github' => '', // To be added later
        'youtube' => '' // To be added later
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
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Hero Section -->
        <div class="content-section" id="home" style="text-align: center; padding: 120px 60px; margin-top: 60px;">
            <h1 style="font-size: 6rem; margin-bottom: 20px; animation: fadeInUp 0.8s ease-out;">
                <?php echo $name; ?>
            </h1>
            <p style="font-size: 1.8rem; color: var(--accent-white); margin-bottom: 15px; animation: fadeInUp 1s ease-out; font-family: 'Bebas Neue', sans-serif; letter-spacing: 3px;">
                GAME DESIGNER | 3D ARTIST | DEVELOPER
            </p>
            <p style="font-size: 1.3rem; color: var(--text-muted); margin-bottom: 50px; animation: fadeInUp 1.2s ease-out;">
                <?php echo $year; ?> at <?php echo $university; ?>, <?php echo $location; ?>
            </p>
            <a href="portfolio/" class="btn" style="animation: fadeInUp 1.4s ease-out;">VIEW MY WORK</a>
        </div>
        
        <!-- About Section -->
        <div class="content-section" id="about">
            <h2>ABOUT ME</h2>
            <p style="font-size: 1.15rem; line-height: 1.9;">
                I'm a <?php echo $year; ?> at <strong style="color: var(--accent-white);"><?php echo $university; ?></strong> 
                in <?php echo $location; ?>, majoring in <strong style="color: var(--accent-white);"><?php echo $major; ?></strong> 
                with a minor in <strong style="color: var(--accent-white);"><?php echo $minor; ?></strong>.
            </p>
            
            <p style="font-size: 1.15rem; line-height: 1.9; margin-top: 20px;">
                I specialize in creating immersive gaming experiences and stunning 3D visuals, combining technical expertise 
                with creative design. From coding in <strong style="color: var(--accent-white);">Python</strong> and <strong style="color: var(--accent-white);">C++</strong> to bringing worlds to life in 
                <strong style="color: var(--accent-white);">Unreal Engine 5</strong>, <strong style="color: var(--accent-white);">Godot</strong>, and <strong style="color: var(--accent-white);">Unity</strong>, I'm passionate about every 
                aspect of game development.
            </p>

            <p style="font-size: 1.15rem; line-height: 1.9; margin-top: 20px;">
                My creative toolkit includes <strong style="color: var(--accent-white);">Autodesk Maya</strong>, <strong style="color: var(--accent-white);">Blender</strong>, <strong style="color: var(--accent-white);">Adobe Creative Suite</strong>, 
                and <strong style="color: var(--accent-white);">Figma</strong>, allowing me to craft everything from 3D models to user interfaces and graphic designs.
            </p>
        </div>

        <!-- Leadership Section -->
        <div class="content-section">
            <h2>LEADERSHIP & EXPERIENCE</h2>
            <p style="font-size: 1.15rem; line-height: 1.9;">
                As a member of <strong style="color: var(--accent-white);">Pi Kappa Phi Fraternity - Alpha Eta Chapter</strong>, 
                I've held key leadership positions that have sharpened my creative and organizational skills:
            </p>
            <ul style="margin-top: 25px; font-size: 1.1rem; line-height: 2;">
                <?php foreach ($leadership as $position): ?>
                    <li style="color: var(--text-muted); margin-bottom: 10px;">
                        <span style="color: var(--accent-white);">▸</span> <?php echo $position; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <div style="margin-top: 35px; padding: 30px; background: var(--secondary-black); border: 3px solid var(--border-gray); border-radius: 0px;">
                <h3 style="color: var(--accent-white); font-size: 2rem; margin-bottom: 20px; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">
                    SOCIAL CHAIR
                </h3>
                <p style="font-size: 1.15rem; line-height: 1.9; margin-bottom: 20px;">
                    As <strong style="color: var(--accent-white);">Social Chair</strong>, I specialize in 
                    <strong style="color: var(--accent-white);">event planning and organization</strong>, coordinating 
                    all aspects of our chapter's formal events. My responsibilities include:
                </p>
                <ul style="font-size: 1.1rem; line-height: 2; margin-left: 20px;">
                    <li style="color: var(--text-muted); margin-bottom: 12px;">
                        <span style="color: var(--accent-white);">▸</span> Leading a committee and coordinating team efforts for large-scale events
                    </li>
                    <li style="color: var(--text-muted); margin-bottom: 12px;">
                        <span style="color: var(--accent-white);">▸</span> Organizing and securing venues for chapter formal events
                    </li>
                    <li style="color: var(--text-muted); margin-bottom: 12px;">
                        <span style="color: var(--accent-white);">▸</span> Booking and coordinating with live bands and entertainment
                    </li>
                    <li style="color: var(--text-muted); margin-bottom: 12px;">
                        <span style="color: var(--accent-white);">▸</span> Creating custom banner artworks and event branding materials
                    </li>
                    <li style="color: var(--text-muted); margin-bottom: 12px;">
                        <span style="color: var(--accent-white);">▸</span> Managing event logistics, budgets, and timelines
                    </li>
                </ul>
            </div>

            <div style="margin-top: 35px; padding: 30px; background: var(--secondary-black); border: 3px solid var(--border-gray); border-radius: 0px;">
                <h3 style="color: var(--accent-white); font-size: 2rem; margin-bottom: 20px; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">
                    T-SHIRT CHAIR
                </h3>
                <p style="font-size: 1.15rem; line-height: 1.9;">
                    For two years as <strong style="color: var(--accent-white);">T-Shirt Chair</strong>, I've designed and produced 
                    custom apparel for our chapter, bringing creative visions to life through Adobe Illustrator. 
                    Check out my <a href="portfolio/tshirt-designs/" 
                    style="color: var(--accent-white); text-decoration: none; border-bottom: 3px solid var(--accent-white); font-weight: bold;">
                    t-shirt design portfolio</a> to see my work!
                </p>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="content-section" id="skills">
            <h2>TECHNICAL SKILLS & TOOLS</h2>
            <p style="margin-bottom: 30px;">Technologies and software I work with:</p>
            <div class="skills-container">
                <?php foreach ($skills as $skill): ?>
                    <span class="skill-tag"><?php echo $skill; ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="content-section" id="contact">
            <h2>GET IN TOUCH</h2>
            <p style="font-size: 1.15rem; line-height: 1.9; margin-bottom: 40px;">
                Interested in collaborating on a project or want to learn more about my work? 
                Feel free to reach out!
            </p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 50px;">
                <!-- Contact Form -->
                <div style="background: var(--secondary-black); padding: 40px; border: 3px solid var(--border-gray); border-radius: 0px;">
                    <h3 style="color: var(--accent-white); font-size: 2rem; margin-bottom: 25px; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">
                        SEND ME A MESSAGE
                    </h3>
                    <form action="mailto:<?php echo $contact['email']; ?>" method="post" enctype="text/plain">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 8px; font-weight: bold; letter-spacing: 1px;">YOUR NAME</label>
                            <input type="text" name="name" required 
                                   style="width: 100%; padding: 15px; background: var(--primary-black); border: 2px solid var(--border-gray); 
                                   color: var(--text-light); font-size: 1rem; border-radius: 0px; transition: border-color 0.3s;">
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 8px; font-weight: bold; letter-spacing: 1px;">YOUR EMAIL</label>
                            <input type="email" name="email" required 
                                   style="width: 100%; padding: 15px; background: var(--primary-black); border: 2px solid var(--border-gray); 
                                   color: var(--text-light); font-size: 1rem; border-radius: 0px; transition: border-color 0.3s;">
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; color: var(--text-light); margin-bottom: 8px; font-weight: bold; letter-spacing: 1px;">MESSAGE</label>
                            <textarea name="message" rows="6" required 
                                      style="width: 100%; padding: 15px; background: var(--primary-black); border: 2px solid var(--border-gray); 
                                      color: var(--text-light); font-size: 1rem; border-radius: 0px; resize: vertical; transition: border-color 0.3s;"></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%; margin: 0;">SEND MESSAGE</button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div>
                    <div style="background: var(--secondary-black); padding: 40px; border: 3px solid var(--border-gray); border-radius: 0px; margin-bottom: 30px;">
                        <h3 style="color: var(--accent-white); font-size: 2rem; margin-bottom: 25px; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">
                            CONTACT INFO
                        </h3>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">EMAIL</p>
                            <a href="mailto:<?php echo $contact['email']; ?>" 
                               style="color: var(--accent-white); font-size: 1.1rem; text-decoration: none; border-bottom: 2px solid var(--accent-white);">
                                <?php echo $contact['email']; ?>
                            </a>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">PHONE</p>
                            <a href="tel:+1<?php echo str_replace('.', '', $contact['phone']); ?>" 
                               style="color: var(--accent-white); font-size: 1.1rem; text-decoration: none; border-bottom: 2px solid var(--accent-white);">
                                <?php echo $contact['phone']; ?>
                            </a>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">ADDRESS</p>
                            <p style="color: var(--accent-white); font-size: 1.1rem;">
                                <?php echo $contact['address']; ?>
                            </p>
                        </div>
                    </div>

                    <div style="background: var(--secondary-black); padding: 40px; border: 3px solid var(--border-gray); border-radius: 0px;">
                        <h3 style="color: var(--accent-white); font-size: 2rem; margin-bottom: 25px; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">
                            SOCIAL MEDIA
                        </h3>
                        <?php if (!empty($contact['instagram'])): ?>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">INSTAGRAM</p>
                            <a href="https://instagram.com/<?php echo $contact['instagram']; ?>" target="_blank" 
                               style="color: var(--accent-white); font-size: 1.1rem; text-decoration: none; border-bottom: 2px solid var(--accent-white);">
                                @<?php echo $contact['instagram']; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($contact['github'])): ?>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">GITHUB</p>
                            <a href="https://github.com/<?php echo $contact['github']; ?>" target="_blank" 
                               style="color: var(--accent-white); font-size: 1.1rem; text-decoration: none; border-bottom: 2px solid var(--accent-white);">
                                github.com/<?php echo $contact['github']; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($contact['youtube'])): ?>
                        <div style="margin-bottom: 20px;">
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px; letter-spacing: 1px;">YOUTUBE</p>
                            <a href="https://youtube.com/@<?php echo $contact['youtube']; ?>" target="_blank" 
                               style="color: var(--accent-white); font-size: 1.1rem; text-decoration: none; border-bottom: 2px solid var(--accent-white);">
                                youtube.com/@<?php echo $contact['youtube']; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if (empty($contact['github']) && empty($contact['youtube'])): ?>
                        <p style="color: var(--text-muted); font-style: italic;">
                            More links coming soon...
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="content-section" style="text-align: center; padding: 80px;">
            <h2 style="margin-bottom: 25px;">READY TO SEE WHAT I'VE CREATED?</h2>
            <p style="font-size: 1.2rem; margin-bottom: 40px;">
                Explore my portfolio featuring game projects, 3D artwork, and design work.
            </p>
            <a href="portfolio/" class="btn" style="margin-right: 20px;">VIEW PORTFOLIO</a>
            <a href="portfolio/tshirt-designs/" class="btn" style="background: var(--primary-black); 
               border: 3px solid var(--accent-white); color: var(--accent-white);">T-SHIRT DESIGNS</a>
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

        /* Contact Form Styles */
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--accent-white) !important;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        input:hover, textarea:hover {
            border-color: var(--text-muted) !important;
        }

        /* Contact Links Hover Effects */
        #contact a {
            transition: all 0.3s ease;
        }

        #contact a:hover {
            color: var(--text-light) !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            border-bottom-color: var(--text-light) !important;
        }

        /* Responsive Contact Grid */
        @media (max-width: 768px) {
            #contact > div:nth-child(3) {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</body>
</html>