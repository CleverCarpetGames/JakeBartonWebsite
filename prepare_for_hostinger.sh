#!/bin/bash

# Prepare files for Hostinger deployment
# This script creates a clean deployment folder

echo "🚀 Preparing files for Hostinger deployment..."

# Create deployment directory
DEPLOY_DIR="hostinger_upload"
rm -rf "$DEPLOY_DIR"
mkdir -p "$DEPLOY_DIR"

# Copy necessary files from _public_html
echo "📁 Copying files..."

# Copy main files
cp _public_html/index.php "$DEPLOY_DIR/"

# Copy assets folder
cp -r _public_html/assets "$DEPLOY_DIR/"

# Copy portfolio folder
cp -r _public_html/portfolio "$DEPLOY_DIR/"

# Remove unnecessary files
echo "🧹 Cleaning up unnecessary files..."
rm -f "$DEPLOY_DIR/test.php"
rm -f "$DEPLOY_DIR/readme.html"
rm -f "$DEPLOY_DIR/README.txt"
find "$DEPLOY_DIR" -name ".DS_Store" -delete

echo "✅ Done!"
echo ""
echo "📦 Files ready in: $DEPLOY_DIR/"
echo ""
echo "Next steps:"
echo "1. Login to Hostinger File Manager"
echo "2. Navigate to public_html folder"
echo "3. Delete any default files in public_html"
echo "4. Upload ALL contents from '$DEPLOY_DIR/' folder"
echo "5. Make sure the structure is:"
echo "   public_html/"
echo "   ├── index.php"
echo "   ├── assets/"
echo "   └── portfolio/"
echo ""
echo "⚠️  Do NOT upload the '$DEPLOY_DIR' folder itself!"
echo "    Only upload the FILES and FOLDERS inside it."
