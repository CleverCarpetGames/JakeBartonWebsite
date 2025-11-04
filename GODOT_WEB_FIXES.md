# 🐛 Godot Web Export Issues & Fixes

## Issue 1: Browser Freezes on Quit Game

### Problem:
When you call `get_tree().quit()` in a web export, the browser doesn't allow it and the game freezes.

### Solution:
In your Godot project, replace quit functionality with a web-friendly approach:

```gdscript
# REPLACE THIS:
get_tree().quit()

# WITH THIS:
if OS.has_feature("web"):
    # For web builds - return to main menu or reload
    get_tree().change_scene_to_file("res://main_menu.tscn")  # Or your menu scene
    # OR reload the page:
    # JavaScript.eval("location.reload();")
else:
    # For desktop builds
    get_tree().quit()
```

### Better Alternative - Detect Platform:
```gdscript
func quit_game():
    if OS.has_feature("web"):
        # Option 1: Return to main menu
        get_tree().change_scene_to_file("res://scenes/main_menu.tscn")
        
        # Option 2: Show "Thanks for playing" screen
        # get_tree().change_scene_to_file("res://scenes/end_screen.tscn")
        
        # Option 3: Reload page (not recommended)
        # JavaScript.eval("window.location.reload();")
    else:
        # Desktop/native builds can quit normally
        get_tree().quit()
```

---

## Issue 2: Blurry/Glowing Pixel Art

### Problem:
Godot uses texture filtering by default, which makes pixel art look blurry with a "glow" effect.

### Solution - In Godot Project Settings:

#### Method 1: Project-Wide Settings (Recommended)
1. **Go to:** Project → Project Settings
2. **Search for:** "Filter"
3. **Set:** `rendering/textures/canvas_textures/default_texture_filter` = **Nearest**
4. **Export again**

#### Method 2: Per-Sprite Settings
For each Sprite2D node:
1. Select the Sprite2D
2. In Inspector → CanvasItem → Texture
3. Set **Filter** = **Nearest**

#### Method 3: Import Settings (Best for Pixel Art Games)
1. Select your texture in FileSystem
2. Go to Import tab
3. Set **Filter:** Nearest
4. Check **Repeat:** Disabled (usually)
5. Click **Reimport**
6. Do this for ALL pixel art textures

### Additional Pixel Art Settings:

```
Project → Project Settings → Display → Window
- Stretch Mode: viewport
- Stretch Aspect: keep
- Window Width/Height: Use multiples of your base resolution (e.g., 320x180, 640x360, 1280x720)

Project → Project Settings → Rendering
- Textures → Canvas Textures → Default Texture Filter: Nearest
- Textures → Canvas Textures → Default Texture Repeat: Disabled
- Anti Aliasing → Quality → Screen Space AA: Disabled
```

---

## Complete Export Checklist for Web:

### 1. Fix Quit Functionality
- [ ] Replace all `get_tree().quit()` calls with platform detection
- [ ] Add main menu or end screen for web version
- [ ] Test quit button in web export

### 2. Fix Pixel Art Rendering
- [ ] Set default texture filter to Nearest
- [ ] Reimport all pixel art textures with Nearest filter
- [ ] Disable anti-aliasing
- [ ] Set proper stretch mode

### 3. Export Settings
- [ ] Export Mode: Release
- [ ] Canvas Resize Policy: Adaptive
- [ ] Head Include: Add this for better pixel art:
```html
<style>
    canvas {
        image-rendering: pixelated;
        image-rendering: crisp-edges;
    }
</style>
```

### 4. Test Before Re-uploading
- [ ] Test quit button doesn't freeze
- [ ] Check pixel art looks crisp
- [ ] Verify controls work
- [ ] Test on different browsers

---

## Quick Fix Script for Your Project

Add this autoload script to handle web vs desktop differences:

**platform_helper.gd:**
```gdscript
extends Node

func quit_game():
    if OS.has_feature("web"):
        # Return to main menu for web builds
        get_tree().change_scene_to_file("res://scenes/main_menu.tscn")
    else:
        get_tree().quit()

func is_web() -> bool:
    return OS.has_feature("web")
```

Then use it anywhere:
```gdscript
# Instead of get_tree().quit()
PlatformHelper.quit_game()
```

---

## After Making Changes:

1. **In Godot:**
   - Make the changes above
   - Re-export to Web (HTML5)
   
2. **On Your Computer:**
   - Replace files in `WebPhaseRunner/` folder with new export
   
3. **Copy to Website:**
   ```bash
   cp -r WebPhaseRunner/* _public_html/portfolio/games/phase-runner/
   cd /Users/jakebarton/Documents/GitHub/JakeBartonWebsite
   ./sync_to_hostinger.sh
   ```

4. **Test locally:**
   - Visit http://localhost:8000/portfolio/games/phase-runner/
   - Check quit button works
   - Verify pixel art looks crisp

5. **Deploy to Hostinger when ready!**

---

## Need More Help?

Let me know:
- Does your game have a main menu scene?
- What resolution is your game?
- Are you using Godot 3 or Godot 4?

I can provide more specific fixes based on your setup!
