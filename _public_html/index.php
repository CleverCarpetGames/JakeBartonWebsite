<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake Barton - Personal Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <?php
    $name = "Jake Barton";
    $location = "Birmingham, AL";
    $major = "Game Design";
    ?>

    <h1>Hello, I'm <?php echo $name; ?></h1>
    
    <div class="about-me">
        <h2>About Me</h2>
        <p>I'm a Game Design major based in <?php echo $location; ?>. I'm passionate about creating 
        interactive experiences and bringing virtual worlds to life through game development.</p>
        
        <p>As a student in <?php echo $major; ?>, I'm constantly learning and exploring new technologies 
        and design principles to create engaging gaming experiences.</p>
    </div>
</body>
</html>