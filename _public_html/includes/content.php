<?php
/**
 * Landing-page content registry.
 * Project source packages live in /projects; public display assets live in /_public_html/assets.
 */

$content = [];

$content['name'] = 'Jake Barton';
$content['title'] = 'Jake Barton — Gameplay Programmer & Technical Designer';
$content['email'] = 'jbarton4@samford.edu';
$content['website'] = 'https://jakebartoncreative.com';
$content['github'] = 'jake-barton';
$content['instagram'] = 'jakebarton13';
$content['linkedin'] = 'jakebartoncreative';
$content['hero_subtitle'] = 'Gameplay programmer and technical designer building responsive systems, playful worlds, and polished real-time experiences.';
$content['home_statement'] = 'I am a gameplay programmer and technical designer building responsive systems, playful worlds, and polished real-time experiences.';

$content['home_categories'] = [
    ['label' => 'Featured Games', 'url' => '/work/', 'video' => 'assets/home/media/phase-runner.mp4', 'poster' => 'assets/home/media/phase-runner-poster.jpg'],
    ['label' => 'Gameplay Systems', 'url' => '/work/', 'video' => 'assets/home/media/mode7.mp4', 'poster' => 'assets/home/media/mode7-poster.jpg'],
    ['label' => 'Real-Time Art', 'url' => '/work/', 'video' => 'assets/home/media/environment.mp4', 'poster' => 'assets/home/media/environment-poster.jpg'],
    ['label' => 'Interactive Web', 'url' => '/work/', 'video' => 'assets/home/media/vr-gameplay.mp4', 'poster' => 'assets/home/media/vr-gameplay-poster.jpg'],
    ['label' => 'Visual Design', 'url' => '/work/', 'video' => 'assets/home/media/penguins-creed.mp4', 'poster' => 'assets/home/media/penguins-creed-poster.jpg'],
];

$content['home_clients'] = [
    ['name' => 'IronSpark', 'image' => 'assets/organizations/ironspark.svg'],
    ['name' => 'Tech Birmingham', 'image' => 'assets/organizations/tech-birmingham.svg'],
    ['name' => 'Veritas Social', 'image' => 'assets/organizations/veritas.svg'],
    ['name' => 'Pi Kappa Phi', 'image' => 'assets/organizations/pi-kappa-phi.svg'],
    ['name' => 'Sloss City Music Festival', 'image' => 'assets/organizations/sloss-city-music-festival.svg'],
    ['name' => 'Framewrk', 'wordmark' => 'FRAMEWRK'],
];

$content['home_accolades'] = [
    ['category' => 'Current', 'logo' => 'assets/organizations/ironspark.svg', 'logo_alt' => 'IronSpark Studios', 'title' => 'Lead Programmer', 'detail' => 'Leading gameplay engineering and technical development for studio projects.'],
    ['category' => 'AI Development', 'logo' => 'assets/organizations/tech-birmingham.svg', 'logo_alt' => 'Tech Birmingham', 'title' => 'AI Tools', 'detail' => 'Developed AI-powered research tools for Birmingham’s technology ecosystem.'],
    ['category' => 'Game Development', 'logo' => 'assets/organizations/samford-university.svg', 'logo_alt' => 'Samford University', 'title' => 'Lead Programmer', 'detail' => 'Led core gameplay systems, technical standards, and development decisions.'],
    ['category' => 'Leadership', 'logo' => 'assets/organizations/samford-sga.svg', 'logo_alt' => 'Samford SGA', 'title' => 'Executive Board', 'detail' => 'Serving as Chaplain and helping organize campus programs and legislative decisions.'],
    ['category' => 'Leadership', 'logo' => 'assets/organizations/pi-kappa-phi.svg', 'logo_alt' => 'Pi Kappa Phi', 'title' => 'Philanthropy Chair', 'detail' => 'Directing fundraising, accessibility awareness, and community partnerships.'],
    ['category' => 'Current', 'logo' => 'assets/organizations/sloss-city-music-festival.svg', 'logo_alt' => 'Sloss City Music Festival', 'title' => 'Creative Director', 'detail' => 'Leading the festival’s creative direction through Instagram growth, graphic design, sponsor relationships, and cohesive brand development.'],
    ['category' => 'Co-Founder', 'logo' => 'assets/organizations/framewrk.svg', 'logo_alt' => 'Framewrk LLC', 'title' => 'Programming Co-Founder', 'detail' => 'Co-founded and built a mobile marketplace connecting creative professionals with clients for booking, delivery, and payments.'],
    ['category' => 'Technical Toolkit', 'mark' => '</>', 'logo_alt' => 'Programming', 'title' => 'C++ / Python / JS', 'detail' => 'Unreal, Godot, React, Git, Maya, Blender, Substance Painter, and Adobe tools.'],
];
