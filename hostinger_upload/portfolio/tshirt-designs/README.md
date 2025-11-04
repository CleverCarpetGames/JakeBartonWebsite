# T-Shirt Design Portfolio - Quick Reference

## How to Add a New Design

1. **Export your .ai file to PNG/JPG:**
   - Thumbnail: 250x250px → save to `images/thumbnails/`
   - Full size: 1200x1200px → save to `images/full/`

2. **Open `index.php` in this folder**

3. **Add to the $designs array:**
   ```php
   [
       'id' => 3,  // Increment this number
       'title' => 'Your Design Name',
       'description' => 'Brief description of the design',
       'year' => '2024',  // Year created
       'thumbnail' => 'images/thumbnails/your-design.png',
       'full' => 'images/full/your-design.png'
   ],
   ```

4. **Save and refresh your browser!**

## Image Export Settings (Illustrator)

**For Thumbnails:**
- File → Export → Export for Screens
- Format: PNG
- Width: 500px (will auto-resize to fit)
- Resolution: 72 PPI

**For Full Size:**
- File → Export → Export for Screens  
- Format: PNG or JPG
- Width: 2000px
- Resolution: 150 PPI (for print quality)

## Alternative: Batch Convert with ImageMagick

If you have ImageMagick installed, convert multiple files at once:

```bash
# Convert .ai or .pdf to PNG
for file in *.ai; do
    magick "$file" -resize 500x500 "thumbnails/${file%.ai}.png"
    magick "$file" -resize 2000x2000 "full/${file%.ai}.png"
done
```

## Test Your Site

```bash
cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite/_public_html
php -S localhost:8000
```

Then visit: http://localhost:8000/portfolio/tshirt-designs/
