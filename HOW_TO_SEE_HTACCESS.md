# 🔍 How to See and Upload .htaccess File

## The Problem
`.htaccess` files are **hidden by default** because they start with a dot (.).

---

## ✅ The File EXISTS - Here's Proof:
```bash
# File is in _public_html:
-rw-r--r--  1 jakebarton  staff  901 Nov  4 16:02 .htaccess

# File is in hostinger_upload:
-rw-r--r--  1 jakebarton  staff  901 Nov  4 15:59 .htaccess
```

---

## 📁 How to See Hidden Files

### Option 1: Show Hidden Files in Finder (Mac)
**Keyboard Shortcut:**
- Press: `Cmd + Shift + .` (period)
- Hidden files will appear grayed out
- Press again to hide them

### Option 2: Use Terminal
```bash
# Navigate to the folder
cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite/hostinger_upload

# List all files including hidden ones
ls -la

# You'll see .htaccess in the list
```

### Option 3: Open in VS Code
- VS Code shows hidden files by default
- You already have it open (.htaccess is in your editor context)
- Just navigate to the file in the sidebar

---

## 📤 How to Upload .htaccess to Hostinger

### Method 1: Hostinger File Manager (Easiest)
1. Log in to Hostinger control panel
2. Go to **File Manager**
3. Navigate to `public_html` folder
4. Click **Upload Files**
5. Select ALL files from `hostinger_upload/` folder
   - Make sure "Show hidden files" is enabled in your file picker
   - Or just drag the entire folder contents
6. The `.htaccess` file WILL upload (file managers show hidden files)

### Method 2: FTP Client (FileZilla, Cyberduck)
1. Open your FTP client
2. Connect to Hostinger
3. In **Preferences/Settings**, enable "Show hidden files"
   - FileZilla: Server → Force showing hidden files
   - Cyberduck: View → Show Hidden Files
4. Upload all files from `hostinger_upload/`

### Method 3: Terminal/Command Line
```bash
# Using rsync (if you have SSH access)
rsync -avz hostinger_upload/ user@yourhost:/path/to/public_html/

# The -a flag includes hidden files automatically
```

---

## ✅ Verify .htaccess Uploaded

After uploading, check in Hostinger File Manager:
1. Click the **eye icon** or **settings** in File Manager
2. Enable "Show hidden files"
3. You should see `.htaccess` in your `public_html` folder

---

## 📋 What's in .htaccess (Current Version)

Your `.htaccess` file contains:
- URL rewriting rules (/home redirect)
- PHP extension removal
- Cache prevention for CSS/JS (fixes the scrolling issue!)
- HTTPS redirect (commented out for now)

**File Size:** 901 bytes
**Last Updated:** November 4, 2025

---

## 🚨 Important Notes

1. **The file IS there** - it's just hidden
2. **When you upload, it WILL transfer** - file upload dialogs can see hidden files
3. **Hostinger File Manager shows hidden files** by default
4. **Don't worry** - hidden files are normal on servers

---

## 🎯 Quick Test

To confirm the file is really there:

```bash
# In Terminal:
cat /Users/jakebarton/Documents/GitHub/JakeBartonWebsite/hostinger_upload/.htaccess
```

This will print the file contents. If you see the rewrite rules, the file exists!

---

## 💡 Pro Tip

When uploading to Hostinger:
- Just drag the **entire contents** of `hostinger_upload/` folder
- Don't worry about selecting individual files
- Hidden files will be included automatically
- Hostinger will receive everything, including `.htaccess`

---

*The .htaccess file is critical for the cache fix to work!*
*Make sure it uploads when you transfer your files.*
