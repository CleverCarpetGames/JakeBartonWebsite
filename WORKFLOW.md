# 🚀 Jake Barton Website - Development & Deployment Workflow

## 📁 Folder Structure

```
JakeBartonWebsite/
├── _public_html/              <- Your development folder (edit files here)
│   ├── index.php
│   ├── assets/
│   └── portfolio/
│
├── hostinger_upload/          <- Always ready to deploy (auto-synced)
│   ├── index.php
│   ├── assets/
│   ├── portfolio/
│   └── test.php
│
└── sync_to_hostinger.sh       <- Sync script (run after changes)
```

---

## 🔄 Workflow

### For Local Development:

1. **Start the PHP server:**
   ```bash
   cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite/_public_html
   php -S localhost:8000
   ```

2. **Edit files** in `_public_html/` folder
   - Work on index.php
   - Update CSS in assets/css/styles.css
   - Add designs to portfolio/tshirt-designs/

3. **Test locally** at `http://localhost:8000`

### To Deploy to Hostinger:

**Option A: Automatic Sync (Recommended)**
```bash
cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite
./sync_to_hostinger.sh
```
This automatically updates `hostinger_upload/` with your latest changes!

**Option B: I'll auto-sync for you**
Whenever I make changes, I'll automatically run the sync script so `hostinger_upload/` is always ready.

### Upload to Hostinger:

1. Open Finder → Go to `hostinger_upload/` folder
2. Drag & drop ALL contents into Hostinger's `public_html`
3. Visit `yourdomain.com/test.php` to verify

---

## 📝 What Gets Synced

✅ **Included:**
- index.php
- assets/ (CSS, JS)
- portfolio/
- All your t-shirt design images
- test.php (for deployment testing)

❌ **Excluded (automatically removed):**
- readme.html
- README.txt
- SETUP_GUIDE.md
- convert_images.sh
- .DS_Store files

---

## 🎯 Quick Commands

### Start local server:
```bash
cd ~/Documents/GitHub/JakeBartonWebsite/_public_html && php -S localhost:8000
```

### Stop server:
```bash
pkill -f "php -S"
```

### Sync to deployment folder:
```bash
cd ~/Documents/GitHub/JakeBartonWebsite && ./sync_to_hostinger.sh
```

---

## 💡 Tips

- **Always edit in `_public_html/`** - This is your working directory
- **Never edit in `hostinger_upload/`** - It gets overwritten by sync
- **Run sync before deploying** - Keeps deployment folder up-to-date
- **Keep test.php** - Useful for verifying deployments

---

## ✨ From Now On

When I make changes to your website, I'll automatically:
1. Update files in `_public_html/`
2. Run the sync script
3. Let you know `hostinger_upload/` is ready to deploy

You just drag & drop to Hostinger whenever you want to update your live site! 🎉

---

## 🆘 Need Help?

- **Local site not working?** Make sure server is running
- **Deployment not working?** Run test.php on Hostinger
- **Files out of sync?** Run `./sync_to_hostinger.sh`

Last updated: November 4, 2025
