# T-Shirt Design Portfolio Setup Guide

## Overview
Your website now has a complete portfolio section for displaying t-shirt designs! The structure is organized and professional.

## Folder Structure
```
_public_html/
├── assets/
│   ├── css/
│   │   └── styles.css              # Main stylesheet
│   └── js/
│       └── gallery.js              # Gallery functionality
├── portfolio/
│   ├── index.php                    # Portfolio landing page
│   └── tshirt-designs/
│       ├── index.php                # T-shirt gallery page
│       └── images/
│           ├── thumbnails/          # Put thumbnail images here (250x250px recommended)
│           └── full/                # Put full-size images here (1200px+ width recommended)
├── index.php                        # Updated homepage
```

## Converting Adobe Illustrator Files to Web Format

Since browsers can't display .ai files directly, you'll need to export them as PNG, JPG, or SVG. Here are the recommended methods:

### Method 1: Export from Adobe Illustrator (Best Quality)

1. **Open your .ai file in Illustrator**
2. **Export Thumbnail:**
   - File → Export → Export for Screens
   - Format: PNG
   - Size: 250x250px (or larger, square aspect ratio)
   - Save to: `portfolio/tshirt-designs/images/thumbnails/`
   - Name: `design1.png`, `design2.png`, etc.

3. **Export Full Size:**
   - File → Export → Export for Screens
   - Format: PNG (for complex designs) or SVG (for simple vector art)
   - Size: 2000x2000px or larger
   - Save to: `portfolio/tshirt-designs/images/full/`
   - Name: Same as thumbnail (e.g., `design1.png`)

### Method 2: Batch Export Script (For Multiple Files)

If you have many designs, use Illustrator's batch export:
1. File → Scripts → SaveDocsAsPDF (or use Actions panel)
2. Then convert PDFs to PNG using Preview or ImageMagick

### Method 3: Using CloudConvert or Online Converters

1. Upload .ai files to https://cloudconvert.com/ai-to-png
2. Download converted PNG files
3. Resize using Preview (Mac) or any image editor:
   - Thumbnails: 250x250px
   - Full: 1200x1200px or larger

## Adding Your Designs to the Website

1. **Export and place your images** in the appropriate folders (thumbnails and full)

2. **Edit** `portfolio/tshirt-designs/index.php`

3. **Update the $designs array** around line 8:

```php
$designs = [
    [
        'id' => 1,
        'title' => 'Sunset Beach Design',
        'description' => 'Summer-themed t-shirt with palm trees and sunset',
        'year' => '2020',
        'thumbnail' => 'images/thumbnails/sunset-beach.png',
        'full' => 'images/full/sunset-beach.png'
    ],
    [
        'id' => 2,
        'title' => 'Gaming Logo',
        'description' => 'Retro pixel art gaming controller design',
        'year' => '2021',
        'thumbnail' => 'images/thumbnails/gaming-logo.png',
        'full' => 'images/full/gaming-logo.png'
    ],
    // Add more designs here!
];
```

## Features Included

### ✅ Responsive Gallery
- Grid layout that adapts to screen size
- Works on desktop, tablet, and mobile

### ✅ Lightbox/Modal Viewer
- Click any design to see full-size version
- Navigate with arrow keys or on-screen buttons
- Close with ESC key or X button

### ✅ Year Filtering
- Filter designs by year
- Automatically generates filter buttons based on your data

### ✅ Professional Design
- Modern, clean interface
- Smooth animations and transitions
- Optimized for performance

## Testing Your Setup

1. **Start a local server** (required for PHP):
   ```bash
   cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite/_public_html
   php -S localhost:8000
   ```

2. **Open in browser:**
   - Homepage: http://localhost:8000/
   - Portfolio: http://localhost:8000/portfolio/
   - T-Shirt Designs: http://localhost:8000/portfolio/tshirt-designs/

## Tips for Best Results

1. **Image Sizes:**
   - Thumbnails: 250x250px to 500x500px (keeps page loading fast)
   - Full size: 1200x1200px to 2400x2400px (for high-quality viewing)

2. **File Formats:**
   - PNG: Best for designs with transparency or complex gradients
   - JPG: Best for photographic-style designs (smaller file size)
   - SVG: Best for simple vector designs (infinite scaling)

3. **Naming Convention:**
   - Use descriptive names: `dragon-tee-2023.png`
   - Keep names lowercase with hyphens
   - Match thumbnail and full-size names

4. **Organization:**
   - Add designs chronologically
   - Include accurate years for filtering
   - Write clear descriptions

## Next Steps

1. Export your Illustrator files as PNG/JPG
2. Place images in the thumbnails and full folders
3. Edit `portfolio/tshirt-designs/index.php` to add your designs
4. Test locally with PHP server
5. Upload to your web host

## Need Help?

Common issues:
- **Images not showing?** Check file paths are correct relative to the PHP file
- **PHP not working?** Make sure you're using a server (php -S) not opening files directly
- **Styling looks off?** Clear browser cache (Cmd+Shift+R on Mac)

Enjoy showcasing your t-shirt designs! 🎨👕
