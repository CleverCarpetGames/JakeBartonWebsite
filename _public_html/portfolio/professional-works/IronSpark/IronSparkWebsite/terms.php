<?php
$page_title = 'Terms of Use';
require_once 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <p class="eyebrow page-hero__eyebrow">Legal</p>
        <h1 style="font-family:var(--font-display);font-size:clamp(3rem,7vw,8rem);text-transform:uppercase;line-height:0.92;">Terms of Use</h1>
        <p class="body-large mt-md" style="color:var(--color-muted)">Last updated: <?= date('F Y') ?></p>
    </div>
</section>
<section class="section">
    <div class="container" style="max-width:800px">
        <p style="color:var(--color-muted-light);line-height:1.8;margin-bottom:1.5rem">
            By accessing and using ironsparkstudios.com, you agree to be bound by these terms. All content on this site — including copy, design, and imagery — is the intellectual property of IronSpark Studios and may not be reproduced without written permission.
        </p>
        <p style="color:var(--color-muted-light);line-height:1.8;margin-bottom:1.5rem">
            IronSpark Studios reserves the right to update these terms at any time. Continued use of the site constitutes acceptance of any changes.
        </p>
        <p style="color:var(--color-muted-light);line-height:1.8">
            Questions? <a href="mailto:hello@ironsparkstudios.com" style="color:var(--color-spark)">hello@ironsparkstudios.com</a>
        </p>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>
