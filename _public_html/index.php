<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake Barton - Personal Page</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .portfolio-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.3s;
        }
        .portfolio-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <?php
    $name = "Jake Barton";
    $location = "Birmingham, AL";
    $major = "Game Design";
    ?>

    <div class="container">
        <div class="hero">
            <h1>Hello, I'm <?php echo $name; ?></h1>
            <p style="font-size: 1.2rem; margin: 20px 0;">Game Designer | Creative Developer | T-Shirt Artist</p>
            <a href="portfolio/" class="portfolio-link">View My Portfolio</a>
        </div>
        
        <div class="content-section">
            <h2>About Me</h2>
            <p>I'm a Game Design major based in <?php echo $location; ?>. I'm passionate about creating 
            interactive experiences and bringing virtual worlds to life through game development.</p>
            
            <p>As a student in <?php echo $major; ?>, I'm constantly learning and exploring new technologies 
            and design principles to create engaging gaming experiences.</p>
            
            <p>Beyond game design, I also create t-shirt designs and other graphic art. Check out my 
            <a href="portfolio/tshirt-designs/">t-shirt design portfolio</a> to see my work over the years!</p>
        </div>
    </div>
</body>
</html>