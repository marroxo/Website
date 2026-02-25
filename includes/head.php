<?php
// Page-level variables should be set BEFORE including this file:
// $page_title, $page_desc, $page_game (optional, e.g. 'cs2', 'gta', etc.)
$page_title = $page_title ?? 'TGModz — Premium Gaming Software Store | Est. 2021';
$page_desc  = $page_desc  ?? 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021. Instant delivery, 24/7 support, verified products.';
$page_game  = $page_game  ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ─── RESET ─── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

/* ─── VARIABLES ─── */
:root {
  --bg:       #060b18;
  --bg2:      #0a1128;
  --surface:  #0d1530;
  --surface2: #111d3e;
  --card:     #0f1a36;
  --card2:    #13204a;
  --border:   rgba(59,130,246,0.12);
  --border2:  rgba(59,130,246,0.22);
  --blue:     #3b82f6;
  --blue-lo:  rgba(59,130,246,0.08);
  --blue-md:  rgba(59,130,246,0.18);
  --blue-hi:  rgba(59,130,246,0.35);
  --cyan:     #06b6d4;
  --cyan-lo:  rgba(6,182,212,0.10);
  --indigo:   #6366f1;
  --orange:   #f97316;
  --orange-hi:rgba(249,115,22,0.30);
  --green:    #22c55e;
  --green-lo: rgba(34,197,94,0.10);
  --red:      #ef4444;
  --text:     #e8edf5;
  --text2:    #94a3b8;
  --text3:    #475569;
  --glow:     0 0 40px rgba(59,130,246,0.15);
}

/* ─── BASE ─── */
body {
  background: var(--bg);
  color: var(--text);
  font-family: 'Inter', -apple-system, sans-serif;
  overflow-x: hidden;
  line-height: 1.6;
}
body::before {
  content: '';
  position: fixed; inset: 0;
  background-image:
    linear-gradient(rgba(59,130,246,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(59,130,246,0.03) 1px, transparent 1px);
  background-size: 60px 60px;
  pointer-events: none;
  z-index: 0;
}
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 3px; }

/* ─── CONTAINER ─── */
.container { max-width: 1260px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 1; }

/* ─── INTRO ANIMATION ─── */
#intro-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: var(--bg);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  pointer-events: all;
}
#intro-overlay.hidden {
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.6s ease;
}
.intro-panel {
  position: absolute;
  top: -10%;
  width: 65%;
  height: 120%;
  background: linear-gradient(160deg, #0d1530 0%, #111d3e 60%, #0f1e47 100%);
}
.intro-panel-left {
  left: -65%;
  transform: skewX(-8deg);
  animation: panelSlideLeft 0.8s cubic-bezier(0.4,0,0.2,1) forwards;
}
.intro-panel-right {
  right: -65%;
  transform: skewX(-8deg);
  animation: panelSlideRight 0.8s cubic-bezier(0.4,0,0.2,1) forwards;
}
@keyframes panelSlideLeft  { to { left:  -44%; } }
@keyframes panelSlideRight { to { right: -44%; } }

.intro-line {
  position: absolute;
  width: 1px;
  height: 65%;
  background: linear-gradient(to bottom, transparent, rgba(59,130,246,0.7) 50%, transparent);
  transform: scaleY(0);
  transform-origin: top center;
  animation: lineGrow 0.7s ease 0.95s forwards;
}
.intro-line-1 { left:  calc(50% - 100px); }
.intro-line-2 { right: calc(50% - 100px); }
@keyframes lineGrow { to { transform: scaleY(1); } }

.intro-light {
  position: absolute;
  top: 50%; left: -5%;
  width: 110%; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(59,130,246,0.5) 35%, rgba(6,182,212,0.8) 50%, rgba(59,130,246,0.5) 65%, transparent);
  opacity: 0;
  animation: lightSweep 0.5s ease 0.5s forwards;
}
@keyframes lightSweep {
  0%   { opacity: 0; transform: scaleX(0); }
  50%  { opacity: 1; }
  100% { opacity: 0; transform: scaleX(1); }
}

.intro-logo {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(2.2rem, 5vw, 3.5rem);
  font-weight: 800;
  color: #fff;
  letter-spacing: -1px;
  position: relative;
  z-index: 10;
  transform: scale(1.6);
  opacity: 0;
  animation: logoReveal 0.45s cubic-bezier(0.34,1.56,0.64,1) 0.55s forwards;
  text-shadow: 0 0 60px rgba(59,130,246,0.5);
}
.intro-logo span { color: var(--blue); }
@keyframes logoReveal { to { transform: scale(1); opacity: 1; } }

/* ─── NAV ─── */
nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 900;
  height: 64px;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 5%;
  background: rgba(6,11,24,0.85);
  backdrop-filter: blur(24px) saturate(180%);
  -webkit-backdrop-filter: blur(24px) saturate(180%);
  border-bottom: 1px solid var(--border);
  transition: all 0.3s ease;
}
nav.scrolled { background: rgba(6,11,24,0.97); box-shadow: 0 4px 30px rgba(0,0,0,0.3); }
.nav-logo {
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 700; font-size: 1.5rem;
  color: var(--text); text-decoration: none;
  display: flex; align-items: center; gap: 10px;
  flex-shrink: 0;
}
.nav-logo span { color: var(--blue); }
.nav-logo .logo-badge {
  background: var(--blue); color: #fff;
  font-size: 0.6rem; font-weight: 700;
  padding: 2px 7px; border-radius: 4px;
  letter-spacing: 0.5px; text-transform: uppercase;
}
.nav-links { display: flex; align-items: center; gap: 28px; list-style: none; }
.nav-links a {
  color: var(--text2); text-decoration: none;
  font-size: 0.88rem; font-weight: 500;
  transition: color 0.2s; position: relative;
  white-space: nowrap;
}
.nav-links a:hover { color: var(--text); }
.nav-links a::after {
  content: ''; position: absolute; bottom: -4px; left: 0; width: 0;
  height: 2px; background: var(--blue); border-radius: 1px; transition: width 0.3s;
}
.nav-links a:hover::after { width: 100%; }
.nav-links a.active { color: var(--blue); }
.nav-links a.active::after { width: 100%; }
.nav-cta {
  background: var(--blue) !important; color: #fff !important;
  padding: 9px 20px; border-radius: 8px; font-weight: 600;
  font-size: 0.85rem; text-decoration: none; transition: all 0.3s;
  border: none; cursor: pointer; min-height: 38px;
  display: inline-flex; align-items: center;
}
.nav-cta:hover { background: #2563eb !important; transform: translateY(-1px); box-shadow: 0 4px 20px rgba(59,130,246,0.4); }
.nav-cta::after { display: none !important; }
.hamburger {
  display: none; flex-direction: column; gap: 5px;
  cursor: pointer; padding: 8px; background: none; border: none;
  min-width: 44px; min-height: 44px; align-items: center; justify-content: center;
}
.hamburger span { width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: 0.3s; display: block; }
.hamburger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.hamburger.open span:nth-child(2) { opacity: 0; }
.hamburger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

/* ─── SECTION COMMON ─── */
section { padding: 80px 0; position: relative; z-index: 1; }
.section-label {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: 2px; color: var(--blue); margin-bottom: 12px;
}
.section-label::before { content: ''; width: 24px; height: 2px; background: var(--blue); border-radius: 1px; }
.section-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(1.8rem, 3.5vw, 2.4rem);
  font-weight: 800; margin-bottom: 16px; letter-spacing: -0.5px;
}
.section-sub {
  font-size: 1.05rem; color: var(--text2); max-width: 560px; line-height: 1.7;
}
.section-header { margin-bottom: 48px; }
.section-header.center { text-align: center; }
.section-header.center .section-sub { margin: 0 auto; }

/* ─── HERO ─── */
.hero {
  padding: 130px 0 80px;
  position: relative; overflow: hidden;
}
.hero::before {
  content: ''; position: absolute; top: -200px; right: -200px;
  width: 700px; height: 700px;
  background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 70%);
  pointer-events: none;
}
.hero::after {
  content: ''; position: absolute; bottom: -100px; left: -100px;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(6,182,212,0.08) 0%, transparent 70%);
  pointer-events: none;
}
.hero-inner {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 60px; align-items: center;
}
.hero-content { position: relative; z-index: 2; }
.hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--blue-lo); border: 1px solid var(--border2);
  padding: 6px 16px; border-radius: 50px;
  font-size: 0.78rem; font-weight: 600; color: var(--blue);
  margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;
  opacity: 0; animation: fadeUp 0.6s ease 1.8s forwards;
}
.hero-badge .pulse {
  width: 8px; height: 8px; background: var(--green);
  border-radius: 50%; animation: pulse 2s infinite;
}
@keyframes pulse {
  0%,100% { opacity:1; box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
  50%      { opacity:0.8; box-shadow: 0 0 0 6px rgba(34,197,94,0); }
}
.hero h1 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(2.2rem, 4.5vw, 3.5rem);
  font-weight: 800; line-height: 1.1;
  margin-bottom: 20px; letter-spacing: -1px;
  opacity: 0; animation: fadeUp 0.6s ease 2.0s forwards;
}
.hero h1 .highlight {
  background: linear-gradient(135deg, var(--blue), var(--cyan));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-sub {
  font-size: 1.05rem; color: var(--text2); line-height: 1.7;
  margin-bottom: 36px; max-width: 480px;
  opacity: 0; animation: fadeUp 0.6s ease 2.2s forwards;
}
.hero-actions {
  display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 40px;
  opacity: 0; animation: fadeUp 0.6s ease 2.4s forwards;
}
.hero-stats {
  display: flex; gap: 36px; flex-wrap: wrap;
  opacity: 0; animation: fadeUp 0.6s ease 2.6s forwards;
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
.hero-stat .num {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.6rem; font-weight: 700; color: var(--text);
}
.hero-stat .num span { color: var(--blue); }
.hero-stat .label {
  font-size: 0.78rem; color: var(--text2);
  text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;
}

/* ─── HERO SHOWCASE ─── */
.hero-showcase {
  position: relative; z-index: 2;
  display: flex; justify-content: center; align-items: center;
  min-height: 420px;
  opacity: 0; animation: fadeUp 0.8s ease 2.2s forwards;
}
.showcase-glow {
  position: absolute; width: 350px; height: 350px;
  background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);
  border-radius: 50%; animation: floatAnim 6s ease-in-out infinite;
}
@keyframes floatAnim { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-20px); } }
.showcase-card {
  background: var(--card); border: 1px solid var(--border2);
  border-radius: 16px; padding: 20px; position: absolute;
  backdrop-filter: blur(10px); transition: all 0.4s ease; box-shadow: var(--glow);
}
.showcase-card:hover { transform: scale(1.05) !important; border-color: var(--blue); }
.sc-1 { top: 10px;  left: 10px;  width: 220px; animation: floatAnim 6s ease-in-out 0s   infinite; }
.sc-2 { top: 60px;  right: 0;    width: 240px; animation: floatAnim 6s ease-in-out 1s   infinite; }
.sc-3 { bottom: 10px; left: 40px; width: 260px; animation: floatAnim 6s ease-in-out 2s   infinite; }
.showcase-card .sc-game {
  font-size: 0.65rem; text-transform: uppercase;
  letter-spacing: 1px; color: var(--cyan); font-weight: 600; margin-bottom: 6px;
}
.showcase-card .sc-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 8px; color: var(--text); }
.showcase-card .sc-bottom { display: flex; justify-content: space-between; align-items: center; }
.showcase-card .sc-price {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.15rem; font-weight: 700; color: var(--blue);
}
.showcase-card .sc-tag {
  font-size: 0.65rem; padding: 3px 9px;
  border-radius: 5px; font-weight: 600; text-transform: uppercase;
}
.tag-hot { background: rgba(239,68,68,0.15); color: var(--red); }
.tag-pop { background: var(--blue-md); color: var(--blue); }
.tag-new { background: var(--green-lo); color: var(--green); }

/* ─── BUTTONS ─── */
.btn-primary {
  background: var(--orange); color: #fff;
  padding: 14px 32px; border-radius: 10px; font-weight: 700; font-size: 0.95rem;
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  transition: all 0.3s; border: none; cursor: pointer;
  box-shadow: 0 4px 20px rgba(249,115,22,0.3); min-height: 50px;
}
.btn-primary:hover { background: #ea580c; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(249,115,22,0.4); }
.btn-secondary {
  background: var(--surface2); color: var(--text);
  padding: 14px 28px; border-radius: 10px; font-weight: 600; font-size: 0.95rem;
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  transition: all 0.3s; border: 1px solid var(--border2); min-height: 50px;
}
.btn-secondary:hover { background: var(--card2); border-color: var(--blue); transform: translateY(-2px); }

/* ─── TRUST BAR ─── */
.trust-bar {
  padding: 28px 0;
  border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
  background: var(--bg2);
}
.trust-items {
  display: flex; justify-content: center; align-items: center;
  gap: 32px; flex-wrap: wrap;
}
.trust-item {
  display: flex; align-items: center; gap: 12px;
  color: var(--text2); font-size: 0.85rem; font-weight: 500;
  white-space: nowrap;
}
.trust-icon {
  width: 40px; height: 40px; background: var(--blue-lo);
  border: 1px solid var(--border); border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; flex-shrink: 0;
}
.trust-item strong { color: var(--text); font-weight: 700; }

/* ─── CATEGORIES SECTION ─── */
.categories { background: var(--bg2); }
.categories-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 16px;
}
.cat-btn {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: 10px; padding: 24px 16px;
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; text-decoration: none; color: var(--text);
  transition: all 0.3s; cursor: pointer; min-height: 110px;
}
.cat-btn:hover {
  border-color: var(--blue); background: var(--surface2);
  transform: translateY(-4px); box-shadow: var(--glow);
  color: var(--text);
}
.cat-btn .cat-icon { font-size: 2rem; }
.cat-btn .cat-name {
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 700; font-size: 0.9rem; color: var(--text);
  text-align: center;
}
.cat-btn .cat-count {
  font-size: 0.7rem; color: var(--text3); font-weight: 500;
}
.cat-btn.active, .cat-btn:focus {
  border-color: var(--blue); background: var(--blue-lo);
}

/* ─── PRODUCTS GRID ─── */
.products { background: var(--bg); }
.products-grid {
  display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
}
.product-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; overflow: hidden; transition: all 0.35s ease; position: relative;
}
.product-card:hover {
  border-color: var(--blue); transform: translateY(-6px);
  box-shadow: 0 12px 40px rgba(59,130,246,0.15);
}
.product-img {
  height: 150px; background: var(--surface);
  display: flex; align-items: center; justify-content: center;
  position: relative; overflow: hidden;
}
.product-img::after {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(180deg, transparent 50%, var(--card) 100%);
}
.product-game-icon { font-size: 3rem; opacity: 0.3; filter: grayscale(0.5); }
.product-badge {
  position: absolute; top: 10px; left: 10px;
  font-size: 0.6rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: 0.5px; padding: 4px 10px; border-radius: 6px; z-index: 2;
}
.badge-bestseller { background: var(--orange); color: #fff; }
.badge-popular    { background: var(--blue); color: #fff; }
.badge-new        { background: var(--green); color: #fff; }
.badge-hot        { background: var(--red); color: #fff; }
.product-info { padding: 18px; }
.product-game {
  font-size: 0.65rem; text-transform: uppercase;
  letter-spacing: 1.2px; color: var(--cyan); font-weight: 600; margin-bottom: 6px;
}
.product-name { font-weight: 700; font-size: 1rem; margin-bottom: 10px; color: var(--text); line-height: 1.3; }
.product-meta {
  display: flex; align-items: center; gap: 6px;
  margin-bottom: 14px; font-size: 0.75rem; color: var(--text2);
}
.product-stars { color: #fbbf24; }
.product-sold  { color: var(--text3); }
.product-bottom { display: flex; align-items: center; justify-content: space-between; }
.product-price {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.2rem; font-weight: 700; color: var(--text);
}
.product-price .old {
  font-size: 0.8rem; color: var(--text3);
  text-decoration: line-through; font-weight: 400; margin-left: 6px;
}
.product-buy {
  background: var(--orange); color: #fff;
  padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.78rem;
  text-decoration: none; transition: all 0.3s; border: none;
  cursor: pointer; min-height: 38px; display: inline-flex; align-items: center;
}
.product-buy:hover { background: #ea580c; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(249,115,22,0.3); }
.view-all-row { text-align: center; margin-top: 40px; }

/* ─── WHY CHOOSE US ─── */
.why-us { background: var(--bg2); }
.why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.why-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; padding: 28px; transition: all 0.35s ease;
}
.why-card:hover { border-color: var(--blue); transform: translateY(-4px); box-shadow: var(--glow); }
.why-icon {
  width: 48px; height: 48px; background: var(--blue-md); border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem; margin-bottom: 18px;
}
.why-card h3 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;
}
.why-card p { font-size: 0.88rem; color: var(--text2); line-height: 1.6; }

/* ─── STATS ─── */
.stats { background: var(--bg); }
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.stat-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; padding: 32px; text-align: center; transition: all 0.35s;
}
.stat-card:hover { border-color: var(--blue); box-shadow: var(--glow); }
.stat-num {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 2.4rem; font-weight: 800; color: var(--blue); margin-bottom: 4px;
}
.stat-label {
  font-size: 0.82rem; color: var(--text2); font-weight: 500;
  text-transform: uppercase; letter-spacing: 0.5px;
}

/* ─── HOW IT WORKS ─── */
.how-it-works { background: var(--bg2); }
.steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
.step-card {
  text-align: center; padding: 32px 20px;
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; position: relative; transition: all 0.35s;
}
.step-card:hover { border-color: var(--blue); transform: translateY(-4px); box-shadow: var(--glow); }
.step-num {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 2.5rem; font-weight: 800; color: var(--blue);
  opacity: 0.3; margin-bottom: 8px;
}
.step-icon { font-size: 2rem; margin-bottom: 16px; }
.step-card h3 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.05rem; font-weight: 700; margin-bottom: 8px;
}
.step-card p { font-size: 0.85rem; color: var(--text2); line-height: 1.6; }

/* ─── REVIEWS ─── */
.reviews { background: var(--bg); }
.reviews-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.review-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; padding: 28px; transition: all 0.35s;
}
.review-card:hover { border-color: var(--blue); box-shadow: var(--glow); }
.review-stars { color: #fbbf24; font-size: 0.9rem; margin-bottom: 14px; }
.review-text {
  font-size: 0.92rem; color: var(--text2); line-height: 1.7;
  margin-bottom: 18px; font-style: italic;
}
.review-author { display: flex; align-items: center; gap: 12px; }
.review-avatar {
  width: 40px; height: 40px; border-radius: 50%; background: var(--blue-md);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 0.85rem; color: var(--blue); flex-shrink: 0;
}
.review-name { font-weight: 600; font-size: 0.88rem; }
.review-verified {
  font-size: 0.7rem; color: var(--green); font-weight: 500;
  display: flex; align-items: center; gap: 4px;
}

/* ─── FAQ ─── */
.faq { background: var(--bg2); }
.faq-list { max-width: 720px; margin: 0 auto; }
.faq-item {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 12px; margin-bottom: 12px; overflow: hidden;
  transition: border-color 0.3s;
}
.faq-item:hover { border-color: var(--border2); }
.faq-q {
  display: flex; justify-content: space-between; align-items: center;
  padding: 20px 24px; cursor: pointer; font-weight: 600; font-size: 0.95rem;
  user-select: none; transition: color 0.2s; min-height: 60px;
  gap: 12px;
}
.faq-q:hover { color: var(--blue); }
.faq-q .arrow { font-size: 1.2rem; transition: transform 0.3s; color: var(--text3); flex-shrink: 0; }
.faq-item.open .faq-q .arrow { transform: rotate(180deg); color: var(--blue); }
.faq-item.open .faq-q { color: var(--blue); }
.faq-a { max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.3s ease; }
.faq-item.open .faq-a { max-height: 300px; padding: 0 24px 20px; }
.faq-a p { font-size: 0.88rem; color: var(--text2); line-height: 1.7; }

/* ─── DISCORD CTA ─── */
.discord-cta { background: var(--bg); padding: 80px 0; }
.discord-box {
  background: linear-gradient(135deg, var(--surface2), var(--card2));
  border: 1px solid var(--border2); border-radius: 20px;
  padding: 60px; text-align: center; position: relative; overflow: hidden;
}
.discord-box::before {
  content: ''; position: absolute; top: -50%; left: -50%;
  width: 200%; height: 200%;
  background: radial-gradient(circle at 30% 40%, rgba(59,130,246,0.08), transparent 50%),
              radial-gradient(circle at 70% 60%, rgba(99,102,241,0.06), transparent 50%);
  pointer-events: none;
}
.discord-box h2 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 800; margin-bottom: 14px; position: relative;
}
.discord-box p { font-size: 1.05rem; color: var(--text2); margin-bottom: 30px; position: relative; }
.btn-discord {
  background: #5865F2; color: #fff;
  padding: 14px 36px; border-radius: 10px; font-weight: 700; font-size: 0.95rem;
  text-decoration: none; display: inline-flex; align-items: center; gap: 10px;
  transition: all 0.3s; position: relative; border: none; cursor: pointer;
  min-height: 50px;
}
.btn-discord:hover { background: #4752c4; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(88,101,242,0.35); }
.discord-members { margin-top: 20px; font-size: 0.85rem; color: var(--text3); position: relative; }
.discord-members strong { color: var(--text2); }

/* ─── PAYMENT STRIP ─── */
.payment-strip {
  padding: 28px 0; border-top: 1px solid var(--border); background: var(--bg2);
}
.payment-inner {
  display: flex; justify-content: center; align-items: center;
  gap: 24px; flex-wrap: wrap;
}
.payment-inner > span {
  font-size: 0.82rem; color: var(--text3); font-weight: 600;
  text-transform: uppercase; letter-spacing: 1px; white-space: nowrap;
}
.payment-icons { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; justify-content: center; }
.pay-icon {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 8px; padding: 7px 14px;
  font-size: 0.75rem; font-weight: 700; color: var(--text2); white-space: nowrap;
}

/* ─── FOOTER ─── */
footer {
  background: var(--bg); border-top: 1px solid var(--border); padding: 60px 0 30px;
}
.footer-grid {
  display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px;
}
.footer-brand .brand-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.5rem; font-weight: 700; margin-bottom: 12px;
}
.footer-brand .brand-name span { color: var(--blue); }
.footer-brand p { font-size: 0.85rem; color: var(--text2); line-height: 1.7; max-width: 320px; }
.footer-col h4 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 0.85rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1px; color: var(--text); margin-bottom: 16px;
}
.footer-col a {
  display: block; color: var(--text2); text-decoration: none;
  font-size: 0.85rem; padding: 4px 0; transition: color 0.2s;
}
.footer-col a:hover { color: var(--blue); }
.footer-bottom {
  border-top: 1px solid var(--border); padding-top: 24px;
  display: flex; justify-content: space-between; align-items: center;
  font-size: 0.78rem; color: var(--text3); gap: 16px; flex-wrap: wrap;
}
.footer-badges { display: flex; gap: 12px; flex-wrap: wrap; }
.footer-badge {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 6px; padding: 5px 12px;
  font-size: 0.7rem; font-weight: 600; color: var(--text2);
}

/* ─── SCROLL REVEAL ─── */
.reveal { opacity: 0; transform: translateY(30px); transition: all 0.7s cubic-bezier(0.16,1,0.3,1); }
.reveal.visible { opacity: 1; transform: translateY(0); }
.stagger-1 { transition-delay: 0.05s; }
.stagger-2 { transition-delay: 0.10s; }
.stagger-3 { transition-delay: 0.15s; }
.stagger-4 { transition-delay: 0.20s; }
.stagger-5 { transition-delay: 0.25s; }
.stagger-6 { transition-delay: 0.30s; }
.stagger-7 { transition-delay: 0.35s; }
.stagger-8 { transition-delay: 0.40s; }

/* ─── SUBDOMAIN PAGE HERO ─── */
.sub-hero {
  padding: 130px 0 70px; position: relative; overflow: hidden;
  background: linear-gradient(180deg, var(--bg2) 0%, var(--bg) 100%);
}
.sub-hero::before {
  content: ''; position: absolute; top: -100px; right: -100px;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(59,130,246,0.10) 0%, transparent 70%);
  pointer-events: none;
}
.sub-hero-inner { display: flex; flex-direction: column; align-items: flex-start; gap: 16px; }
.sub-hero-breadcrumb {
  font-size: 0.82rem; color: var(--text3);
  display: flex; align-items: center; gap: 8px;
}
.sub-hero-breadcrumb a { color: var(--text3); text-decoration: none; transition: color 0.2s; }
.sub-hero-breadcrumb a:hover { color: var(--blue); }
.sub-hero-breadcrumb span { color: var(--text3); }
.sub-hero h1 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800; line-height: 1.1; letter-spacing: -1px;
}
.sub-hero h1 .highlight {
  background: linear-gradient(135deg, var(--blue), var(--cyan));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.sub-hero p { font-size: 1rem; color: var(--text2); max-width: 560px; line-height: 1.7; }

/* ─── RESPONSIVE ─── */
@media (max-width: 1100px) {
  .hero-inner { grid-template-columns: 1fr; text-align: center; }
  .hero-sub    { margin: 0 auto 36px; }
  .hero-actions { justify-content: center; }
  .hero-stats  { justify-content: center; }
  .hero-showcase { display: none; }
  .products-grid { grid-template-columns: repeat(3, 1fr); }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .categories-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .nav-links { display: none; }
  .hamburger { display: flex; }
  .nav-links.open {
    display: flex; flex-direction: column;
    position: fixed; top: 64px; left: 0; right: 0;
    background: rgba(6,11,24,0.98);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    padding: 20px 24px; gap: 4px;
    border-bottom: 1px solid var(--border); z-index: 800;
  }
  .nav-links.open li { width: 100%; }
  .nav-links.open a { display: block; padding: 12px 0; font-size: 1rem; min-height: 44px; }
  .nav-links.open .nav-cta { text-align: center; justify-content: center; margin-top: 8px; }
  .hero { padding: 110px 0 60px; }
  .products-grid { grid-template-columns: repeat(2, 1fr); }
  .why-grid { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .steps-grid { grid-template-columns: repeat(2, 1fr); }
  .reviews-grid { grid-template-columns: 1fr; }
  .footer-grid { grid-template-columns: 1fr; }
  .trust-items { gap: 20px; }
  .trust-item { font-size: 0.8rem; }
  .discord-box { padding: 40px 24px; }
  .categories-grid { grid-template-columns: repeat(3, 1fr); }
  section { padding: 60px 0; }
  .container { padding: 0 16px; }
}
@media (max-width: 560px) {
  .hero { padding: 100px 0 50px; }
  .hero-stats { flex-direction: column; gap: 14px; align-items: center; }
  .products-grid { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: 1fr; }
  .steps-grid { grid-template-columns: 1fr; }
  .categories-grid { grid-template-columns: repeat(2, 1fr); }
  .hero-actions { flex-direction: column; align-items: stretch; }
  .btn-primary, .btn-secondary { width: 100%; justify-content: center; }
  .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
  .footer-badges { justify-content: center; }
  .payment-inner { gap: 14px; }
  .trust-item { flex-direction: column; text-align: center; gap: 8px; }
  .trust-items { gap: 24px; }
  nav { padding: 0 16px; }
  .discord-box { padding: 32px 16px; }
  .stat-num { font-size: 2rem; }
}
</style>
</head>
