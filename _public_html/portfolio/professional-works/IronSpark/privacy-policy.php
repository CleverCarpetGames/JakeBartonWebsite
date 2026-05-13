<?php
$page_title       = 'Privacy Policy';
$page_description = 'IronSpark Studios Privacy Policy';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="eyebrow page-hero__eyebrow">Legal</p>
        <h1 style="font-family:var(--font-display);font-size:clamp(3rem,7vw,8rem);text-transform:uppercase;line-height:0.92;">
            Privacy<br>Policy
        </h1>
        <p class="body-large mt-md" style="color:var(--color-muted)">Last updated: <?= date('F Y') ?></p>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width:800px">
        <div style="display:flex;flex-direction:column;gap:var(--space-lg)">

            <div>
                <h2 style="font-family:var(--font-display);font-size:2rem;text-transform:uppercase;margin-bottom:1rem">Information We Collect</h2>
                <p style="color:var(--color-muted-light);line-height:1.8;margin-bottom:1rem">
                    IronSpark Studios collects information you provide directly to us, such as your name, email address, and any messages you send through our contact form. We do not sell your personal information.
                </p>
            </div>

            <div>
                <h2 style="font-family:var(--font-display);font-size:2rem;text-transform:uppercase;margin-bottom:1rem">How We Use Your Information</h2>
                <p style="color:var(--color-muted-light);line-height:1.8;margin-bottom:1rem">
                    We use the information you provide to respond to inquiries, communicate about projects, and send updates you've opted into. We will never share your information with third parties for marketing purposes.
                </p>
            </div>

            <div>
                <h2 style="font-family:var(--font-display);font-size:2rem;text-transform:uppercase;margin-bottom:1rem">Cookies</h2>
                <p style="color:var(--color-muted-light);line-height:1.8;margin-bottom:1rem">
                    This site uses analytics cookies to understand how visitors interact with our website. No personally identifiable information is collected through cookies. You may disable cookies in your browser settings at any time.
                </p>
            </div>

            <div>
                <h2 style="font-family:var(--font-display);font-size:2rem;text-transform:uppercase;margin-bottom:1rem">Contact</h2>
                <p style="color:var(--color-muted-light);line-height:1.8">
                    For any questions about this privacy policy, contact us at
                    <a href="mailto:hello@ironsparkstudios.com" style="color:var(--color-spark)">hello@ironsparkstudios.com</a>.
                </p>
            </div>

        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
