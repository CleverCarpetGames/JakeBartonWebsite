<?php
$page_title       = '404 — Page Not Found';
$page_description = 'The page you\'re looking for doesn\'t exist.';
require_once 'includes/header.php';
?>

<section style="min-height:100svh;display:flex;align-items:center;padding-top:var(--nav-h)">
    <div class="container">
        <div style="display:flex;flex-direction:column;align-items:center;text-align:center;gap:var(--space-md)">
            <p class="eyebrow">404 — Lost in the void</p>
            <h1 style="font-family:var(--font-display);font-size:clamp(6rem,20vw,20rem);text-transform:uppercase;line-height:0.88;color:var(--color-spark);opacity:0.2">
                404
            </h1>
            <h2 style="font-family:var(--font-display);font-size:clamp(2rem,5vw,5rem);text-transform:uppercase;line-height:0.92;margin-top:-3rem">
                This page<br>doesn't <em>exist.</em>
            </h2>
            <p class="body-large" style="max-width:400px">
                The page you're looking for took a wrong turn somewhere.
                Let's get you back on track.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center">
                <a href="/" class="btn btn--primary">Back to Home</a>
                <a href="/portfolio/professional-works/IronSpark/work" class="btn btn--ghost">See Our Work</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
