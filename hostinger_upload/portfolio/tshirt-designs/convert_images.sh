#!/bin/bash
# T-Shirt Design Image Converter
# This script helps convert images to the right sizes for your portfolio

echo "🎨 T-Shirt Design Portfolio - Image Converter"
echo "=============================================="
echo ""

# Check if source directory exists
if [ ! -d "source_images" ]; then
    echo "Creating 'source_images' directory..."
    mkdir -p source_images
    echo "✅ Please place your high-resolution exported images in the 'source_images' folder"
    echo "   (Export from Illustrator as PNG or JPG first)"
    exit 0
fi

# Create output directories if they don't exist
mkdir -p images/thumbnails
mkdir -p images/full

# Count files to process
file_count=$(find source_images -type f \( -iname "*.png" -o -iname "*.jpg" -o -iname "*.jpeg" \) | wc -l)

if [ $file_count -eq 0 ]; then
    echo "❌ No PNG or JPG files found in source_images/"
    echo "   Please export your .ai files to PNG or JPG first, then place them in source_images/"
    exit 1
fi

echo "Found $file_count image(s) to process"
echo ""

# Check if ImageMagick is installed
if ! command -v magick &> /dev/null && ! command -v convert &> /dev/null; then
    echo "⚠️  ImageMagick not found!"
    echo ""
    echo "Install ImageMagick to use this script:"
    echo "  brew install imagemagick"
    echo ""
    echo "Or use Preview (Mac):"
    echo "  1. Open image in Preview"
    echo "  2. Tools → Adjust Size"
    echo "  3. Set width to 500px (thumbnail) or 2000px (full)"
    echo "  4. Save to appropriate folder"
    exit 1
fi

# Determine which command to use
if command -v magick &> /dev/null; then
    CONVERT_CMD="magick"
else
    CONVERT_CMD="convert"
fi

# Process each image
for img in source_images/*.{png,jpg,jpeg,PNG,JPG,JPEG} 2>/dev/null; do
    # Skip if no files match
    [ -e "$img" ] || continue
    
    # Get filename without path and extension
    filename=$(basename "$img")
    name="${filename%.*}"
    ext="${filename##*.}"
    
    echo "Processing: $filename"
    
    # Create thumbnail (500x500, maintain aspect ratio)
    echo "  → Creating thumbnail..."
    $CONVERT_CMD "$img" -resize 500x500 -quality 85 "images/thumbnails/${name}.png"
    
    # Create full size (2000x2000, maintain aspect ratio)
    echo "  → Creating full-size image..."
    $CONVERT_CMD "$img" -resize 2000x2000 -quality 90 "images/full/${name}.png"
    
    echo "  ✅ Done!"
    echo ""
done

echo "=============================================="
echo "✅ All images processed successfully!"
echo ""
echo "Next steps:"
echo "  1. Check images/thumbnails/ and images/full/"
echo "  2. Edit index.php to add your designs to the \$designs array"
echo "  3. Test your site with: php -S localhost:8000"
echo ""
