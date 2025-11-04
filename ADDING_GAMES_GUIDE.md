# 🎮 Adding Games to Your Portfolio

## Quick Guide

### Step 1: Export Your Game from Godot

1. Go to **Project** → **Export**
2. Select **HTML5 (Web)** preset
3. Set these options:
   - Export Mode: **Release**
   - Canvas Resize Policy: **Adaptive**
   - Focus Canvas on Start: **Yes**
4. Click **Export Project**
5. Save with a name like `YourGameName.html`

### Step 2: Add Game to Website

1. **Create game folder:**
   ```bash
   mkdir _public_html/portfolio/games/your-game-name
   ```

2. **Copy your exported files:**
   - YourGameName.html
   - YourGameName.js
   - YourGameName.wasm
   - YourGameName.pck
   - YourGameName.png (thumbnail)
   
3. **Rename HTML file:**
   ```bash
   mv YourGameName.html index.html
   ```

### Step 3: Update Games Portfolio Page

Edit `_public_html/portfolio/games/index.php`

Add your game to the `$games` array:

```php
[
    'id' => 2,
    'title' => 'Your Game Name',
    'description' => 'A short description of your game...',
    'year' => '2024',
    'tech' => ['Godot', 'GDScript', 'Web Export'],
    'thumbnail' => 'your-game-name/YourGameName.png',
    'playLink' => 'your-game-name/',
    'controls' => 'Keyboard: Arrow Keys to move, Space to jump'
],
```

### Step 4: Sync and Deploy

```bash
cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite
./sync_to_hostinger.sh
```

Then drag & drop `hostinger_upload/` to Hostinger!

---

## Current Games

### Phase Runner
- **Location:** `_public_html/portfolio/games/phase-runner/`
- **URL:** `yourdomain.com/portfolio/games/phase-runner/`
- **Added:** November 4, 2025

---

## Tips

✅ **DO:**
- Use descriptive folder names (lowercase, hyphens)
- Include a good thumbnail (PNG format)
- Test locally before deploying
- Keep file sizes reasonable (<100MB total)

❌ **DON'T:**
- Upload Debug builds (use Release)
- Forget to rename HTML to index.html
- Use spaces in folder names

---

## File Structure

```
portfolio/
└── games/
    ├── index.php              <- Games listing page
    ├── phase-runner/          <- Your game folder
    │   ├── index.html        <- Game HTML (renamed)
    │   ├── PhaseRunnerWeb.js
    │   ├── PhaseRunnerWeb.wasm
    │   ├── PhaseRunnerWeb.pck
    │   └── PhaseRunnerWeb.png <- Thumbnail
    └── your-next-game/       <- Add more games here
        └── ...
```

---

## Testing

1. **Local Test:**
   ```bash
   cd _public_html
   php -S localhost:8000
   ```
   Visit: http://localhost:8000/portfolio/games/your-game-name/

2. **Check:**
   - Game loads properly
   - Controls work
   - No console errors
   - Thumbnail displays

3. **Deploy when ready!**

