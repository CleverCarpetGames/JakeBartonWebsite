# Jake Barton Website - Portfolio Section

This website now includes a professional portfolio section for showcasing t-shirt designs and other creative work.

## 🚀 Quick Start

1. **Test the site locally:**
   ```bash
   cd _public_html
   php -S localhost:8000
   ```
   Then visit http://localhost:8000

2. **Add your t-shirt designs:**
   - See `_public_html/portfolio/tshirt-designs/SETUP_GUIDE.md` for detailed instructions
   - See `_public_html/portfolio/tshirt-designs/README.md` for quick reference

## 📁 Project Structure

```
_public_html/
├── index.php                   # Homepage (updated with portfolio link)
├── assets/
│   ├── css/
│   │   └── styles.css         # Shared styles for all pages
│   └── js/
│       └── gallery.js         # Gallery functionality
├── portfolio/
│   ├── index.php              # Portfolio landing page
│   └── tshirt-designs/
│       ├── index.php          # T-shirt design gallery
│       ├── SETUP_GUIDE.md    # Detailed setup instructions
│       ├── README.md         # Quick reference
│       ├── convert_images.sh # Helper script for image conversion
│       └── images/
│           ├── thumbnails/   # Thumbnail images (500px)
│           └── full/         # Full-size images (2000px)
```

## 🎨 Working with Adobe Illustrator Files

Since browsers cannot display .ai files directly, you need to export them:

### Option 1: Export from Illustrator
- **File → Export → Export for Screens**
- Create two versions:
  - Thumbnail: 500x500px PNG
  - Full: 2000x2000px PNG

### Option 2: Use the Helper Script
```bash
cd _public_html/portfolio/tshirt-designs
./convert_images.sh
```

## ✨ Features

- **Responsive Gallery**: Works on desktop, tablet, and mobile
- **Lightbox Viewer**: Click images to view full-size with navigation
- **Year Filtering**: Filter designs by year
- **Clean Design**: Modern, professional appearance
- **Easy to Expand**: Add more portfolio categories easily

## 🔧 Adding New Designs

1. Export your .ai file to PNG (see above)
2. Place images in `portfolio/tshirt-designs/images/`
3. Edit `portfolio/tshirt-designs/index.php`
4. Add entry to `$designs` array:
   ```php
   [
       'id' => 3,
       'title' => 'Your Design Name',
       'description' => 'Design description',
       'year' => '2024',
       'thumbnail' => 'images/thumbnails/design3.png',
       'full' => 'images/full/design3.png'
   ],
   ```

## 📝 Notes

- Keep original .ai files backed up separately (they're in .gitignore)
- Thumbnail images load on the main page (keep them optimized)
- Full-size images only load when clicked
- All design data is stored in the PHP file (no database needed)

## 🌐 Deployment

When ready to deploy:
1. Upload entire `_public_html` folder to your web host
2. Ensure your host supports PHP
3. Test all links and images

---

For detailed setup instructions, see:
- `portfolio/tshirt-designs/SETUP_GUIDE.md`
