<?php
$page_title = $page_title ?? 'TGModz — Premium Gaming Software Store | Est. 2021';
$page_desc  = $page_desc  ?? 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021. Instant delivery, 24/7 support, verified products.';
$extra_css  = $extra_css  ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
:root{
  --bg:#02040D;--bg2:#040812;--surface:#070E1F;--surface2:#0B1528;
  --card:#0B1528;--card2:#0d1a30;
  --border:rgba(59,130,246,0.09);--border2:rgba(59,130,246,0.18);
  --blue:#3B82F6;--blue-hi:#60A5FA;--blue-dim:rgba(59,130,246,0.12);
  --blue-md:rgba(59,130,246,0.12);--blue-glow:rgba(59,130,246,0.28);--blue-deep:#1D4ED8;
  --green:#22C55E;--green-dim:rgba(34,197,94,0.1);--green-lo:rgba(34,197,94,0.1);
  --red:#EF4444;--red-dim:rgba(239,68,68,0.12);
  --gold:#F59E0B;--orange:#F97316;--cyan:#06B6D4;
  --text:#EEF4FF;--text2:#8BA4C8;--text3:#3D5070;
}
body{background:var(--bg);color:var(--text);font-family:'Outfit',sans-serif;overflow-x:hidden;}
body::after{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:9999;opacity:0.07;}
::-webkit-scrollbar{width:4px;}::-webkit-scrollbar-track{background:var(--bg);}::-webkit-scrollbar-thumb{background:var(--blue);border-radius:2px;}
a{color:inherit;text-decoration:none;}

/* LAYOUT */
.container{max-width:1300px;margin:0 auto;padding:0 4%;}
.section{position:relative;z-index:1;padding:80px 4%;}
.section-inner{max-width:1300px;margin:0 auto;}
.tag{display:inline-block;font-size:0.68rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--blue-hi);margin-bottom:0.6rem;}
.sh{font-family:'Bebas Neue',sans-serif;font-size:clamp(2rem,4vw,3rem);letter-spacing:0.05em;line-height:1;margin-bottom:0.75rem;}
.sd{color:var(--text2);font-size:0.95rem;font-weight:300;line-height:1.7;max-width:480px;}
.section-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;gap:1rem;flex-wrap:wrap;}

/* ANNOUNCE */
.announce{background:linear-gradient(90deg,var(--blue-deep),var(--blue),var(--blue-deep));padding:0.45rem 1rem;text-align:center;font-size:0.8rem;font-weight:600;letter-spacing:0.04em;position:relative;z-index:600;}
.announce a{color:#fff;text-decoration:underline;text-underline-offset:2px;}
.announce strong{color:#fff;}

/* NAV */
nav#navbar{position:sticky;top:0;z-index:500;height:64px;display:flex;align-items:center;justify-content:space-between;padding:0 4%;background:rgba(2,4,13,0.94);backdrop-filter:blur(24px) saturate(160%);border-bottom:1px solid var(--border);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.75rem;letter-spacing:0.08em;color:var(--text);}
.nav-logo em{color:var(--blue);font-style:normal;}
.logo-badge{font-family:'Outfit',sans-serif;font-size:0.52rem;font-weight:700;letter-spacing:0.1em;background:var(--blue-dim);border:1px solid var(--border2);color:var(--blue-hi);padding:2px 7px;border-radius:4px;text-transform:uppercase;vertical-align:middle;margin-left:6px;}
.nav-links{display:flex;align-items:center;gap:1.75rem;list-style:none;}
.nav-links a{color:var(--text2);font-size:0.875rem;font-weight:500;letter-spacing:0.02em;transition:color 0.2s;}
.nav-links a:hover,.nav-links a.active{color:var(--text);}
.nav-links a.active{color:var(--blue-hi);}
.nav-right{display:flex;gap:0.6rem;align-items:center;}
.pill{display:inline-flex;align-items:center;gap:0.4rem;padding:0.45rem 1.1rem;border-radius:100px;font-size:0.82rem;font-weight:600;cursor:pointer;border:none;transition:all 0.2s;font-family:'Outfit',sans-serif;letter-spacing:0.02em;text-decoration:none;}
.pill-ghost{background:transparent;color:var(--text2);border:1px solid var(--border2);}
.pill-ghost:hover{color:var(--text);border-color:rgba(59,130,246,0.35);}
.pill-blue{background:var(--blue);color:#fff;box-shadow:0 0 20px var(--blue-glow);}
.pill-blue:hover{background:var(--blue-hi);box-shadow:0 0 32px rgba(59,130,246,0.45);transform:translateY(-1px);}
.nav-cart-btn{position:relative;display:inline-flex;align-items:center;color:var(--text2);padding:6px;}
.nav-cart-btn:hover{color:var(--blue-hi);}
.cart-badge{position:absolute;top:-4px;right:-6px;background:var(--blue);color:#fff;border-radius:50%;width:17px;height:17px;font-size:0.58rem;font-weight:800;display:inline-flex;align-items:center;justify-content:center;line-height:1;}
.hamburger{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:4px;}
.hamburger span{display:block;width:22px;height:2px;background:var(--text2);border-radius:2px;transition:all 0.3s;}

/* BUTTONS */
.btn-primary,.btn-main{display:inline-flex;align-items:center;gap:0.5rem;padding:0.85rem 1.9rem;background:var(--blue);color:#fff;font-weight:700;font-size:0.9rem;border-radius:6px;text-decoration:none;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;transition:all 0.2s;box-shadow:0 0 30px var(--blue-glow),inset 0 1px 0 rgba(255,255,255,0.2);border:none;cursor:pointer;}
.btn-primary:hover,.btn-main:hover{background:var(--blue-hi);transform:translateY(-2px);box-shadow:0 0 50px rgba(59,130,246,0.5);}
.btn-secondary,.btn-sec,.btn-outline{display:inline-flex;align-items:center;gap:0.5rem;padding:0.85rem 1.9rem;background:transparent;color:var(--text);font-weight:600;font-size:0.9rem;border-radius:6px;text-decoration:none;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;border:1px solid var(--border2);transition:all 0.2s;cursor:pointer;}
.btn-secondary:hover,.btn-sec:hover,.btn-outline:hover{border-color:rgba(59,130,246,0.4);background:rgba(59,130,246,0.06);}
.btn-discord{display:inline-flex;align-items:center;gap:0.6rem;padding:0.9rem 2rem;background:#5865F2;color:#fff;font-weight:700;font-size:0.9rem;border-radius:8px;text-decoration:none;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;transition:all 0.2s;box-shadow:0 0 24px rgba(88,101,242,0.3);border:none;cursor:pointer;}
.btn-discord:hover{background:#4752C4;transform:translateY(-2px);box-shadow:0 0 36px rgba(88,101,242,0.45);}
.btn-tp{display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.5rem;background:transparent;color:#00B67A;font-weight:700;font-size:0.85rem;border-radius:6px;text-decoration:none;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;border:1px solid rgba(0,182,122,0.3);transition:all 0.2s;}
.btn-tp:hover{background:rgba(0,182,122,0.08);border-color:rgba(0,182,122,0.5);}

/* TRUST BAR */
.trust-bar{background:var(--surface);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:0 4%;}
.trust-inner{max-width:1300px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:0.875rem 0;gap:0.5rem;flex-wrap:wrap;}
.ti{display:flex;align-items:center;gap:0.6rem;font-size:0.8rem;color:var(--text2);}
.ti strong{color:var(--text);font-weight:600;}
.ti-icon{width:26px;height:26px;background:var(--blue-dim);border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;}
.ti-sep{width:1px;height:20px;background:var(--border2);}

/* PAYMENT MARQUEE */
.payment-strip{background:var(--bg2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:0.9rem 4%;overflow:hidden;}
.payment-inner{max-width:1300px;margin:0 auto;display:flex;align-items:center;gap:1.25rem;}
.payment-title{font-size:0.75rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--text2);font-weight:600;white-space:nowrap;}
.payment-marquee{position:relative;flex:1;overflow:hidden;mask-image:linear-gradient(to right,transparent,black 8%,black 92%,transparent);}
.payment-track{display:flex;width:max-content;gap:0.6rem;animation:payScroll 22s linear infinite;}
.payment-strip:hover .payment-track{animation-play-state:paused;}
@keyframes payScroll{from{transform:translateX(0);}to{transform:translateX(-50%);}}
.pm{padding:0.35rem 0.75rem;background:var(--surface);border:1px solid var(--border2);border-radius:6px;font-size:0.7rem;font-weight:600;color:var(--text2);letter-spacing:0.04em;white-space:nowrap;transition:all 0.2s;}
.pm:hover{border-color:rgba(59,130,246,0.35);color:var(--text);}

/* PRODUCT CARDS */
.prods-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;}
.prod{background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;transition:all 0.25s;text-decoration:none;color:inherit;display:flex;flex-direction:column;}
.prod:hover{border-color:rgba(59,130,246,0.3);transform:translateY(-4px);box-shadow:0 16px 40px rgba(0,0,0,0.5),0 0 0 1px rgba(59,130,246,0.12);}
.prod-thumb{height:120px;display:flex;align-items:center;justify-content:center;font-size:2.75rem;position:relative;background:var(--surface2);}
.prod-thumb img{width:100%;height:100%;object-fit:cover;opacity:0.75;transition:opacity 0.3s;position:absolute;inset:0;}
.prod:hover .prod-thumb img{opacity:0.95;}
.prod-thumb::after{content:'';position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,var(--surface) 100%);pointer-events:none;}
.prod-badge{position:absolute;top:8px;left:8px;z-index:1;padding:0.2rem 0.5rem;border-radius:4px;font-size:0.65rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;}
.badge-hot{background:var(--red-dim);color:var(--red);border:1px solid rgba(239,68,68,0.25);}
.badge-new{background:var(--blue-dim);color:var(--blue-hi);border:1px solid rgba(59,130,246,0.25);}
.badge-sale,.badge-bestseller{background:rgba(245,158,11,0.12);color:var(--gold);border:1px solid rgba(245,158,11,0.25);}
.badge-pop,.badge-popular{background:var(--green-dim);color:var(--green);border:1px solid rgba(34,197,94,0.25);}
.prod-body{padding:0.875rem;flex:1;display:flex;flex-direction:column;}
.prod-game{font-size:0.68rem;color:var(--text3);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.3rem;}
.prod-name{font-weight:600;font-size:0.88rem;line-height:1.3;margin-bottom:0.4rem;}
.prod-social{font-size:0.7rem;color:var(--text3);margin-bottom:auto;}
.prod-social em{color:var(--green);font-style:normal;}
.prod-foot{display:flex;align-items:center;justify-content:space-between;margin-top:0.875rem;padding-top:0.75rem;border-top:1px solid var(--border);}
.prod-price{font-family:'Bebas Neue',sans-serif;font-size:1.25rem;letter-spacing:0.04em;color:var(--blue-hi);}
.prod-orig{font-size:0.75rem;color:var(--text3);text-decoration:line-through;margin-right:0.3rem;}
.prod-save{font-size:0.7rem;color:var(--green);font-weight:700;}
.prod-btn{padding:0.35rem 0.85rem;background:var(--blue);color:#fff;font-size:0.72rem;font-weight:700;border-radius:5px;letter-spacing:0.05em;text-transform:uppercase;transition:all 0.15s;border:none;cursor:pointer;font-family:'Outfit',sans-serif;}
.prod-btn:hover{background:var(--blue-hi);box-shadow:0 0 16px var(--blue-glow);}

/* CATEGORY CARDS */
.cat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;}
.cat-card{display:flex;flex-direction:column;align-items:center;gap:10px;padding:1.4rem 1rem;background:var(--surface);border:1px solid var(--border);border-radius:12px;text-decoration:none;color:inherit;transition:all 0.25s;text-align:center;}
.cat-card:hover{border-color:rgba(59,130,246,0.3);transform:translateY(-3px);background:var(--surface2);}
.cat-icon-wrap{width:48px;height:48px;border-radius:12px;background:var(--blue-dim);border:1px solid var(--border2);display:flex;align-items:center;justify-content:center;font-size:1.35rem;flex-shrink:0;}
.cat-name{font-size:0.8rem;font-weight:600;color:var(--text2);}
.cat-count{font-size:0.65rem;color:var(--text3);}

/* HOW IT WORKS */
.how-bg{background:var(--bg2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);}
.steps-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;background:var(--border);border-radius:14px;overflow:hidden;}
.step{background:var(--surface);padding:2.25rem 2rem;position:relative;}
.step-num{font-family:'Bebas Neue',sans-serif;font-size:4rem;line-height:1;color:rgba(59,130,246,0.07);position:absolute;top:1rem;right:1.25rem;letter-spacing:0.05em;}
.step-icon{width:52px;height:52px;border-radius:12px;background:var(--blue-dim);border:1px solid var(--border2);display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;}
.step-title{font-weight:700;font-size:1.05rem;margin-bottom:0.5rem;}
.step-desc{font-size:0.85rem;color:var(--text2);line-height:1.65;font-weight:300;}

/* WHY US */
.why-bg{background:var(--bg2);}
.why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--border);border-radius:14px;overflow:hidden;}
.why-card{background:var(--surface);padding:2rem 1.75rem;position:relative;transition:background 0.2s;}
.why-card:hover{background:var(--surface2);}
.why-num{font-family:'Bebas Neue',sans-serif;font-size:3.5rem;color:rgba(59,130,246,0.07);letter-spacing:0.05em;line-height:1;position:absolute;top:1rem;right:1.25rem;user-select:none;}
.why-icon{width:46px;height:46px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;margin-bottom:1rem;background:var(--blue-dim);border:1px solid var(--border2);}
.why-title{font-weight:700;font-size:1rem;margin-bottom:0.5rem;letter-spacing:0.01em;}
.why-desc{font-size:0.85rem;color:var(--text2);line-height:1.65;font-weight:300;}

/* STATS */
.stats-section{background:var(--surface);border-top:1px solid var(--border);border-bottom:1px solid var(--border);}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);}
.stat-box{padding:2.5rem 2rem;border-right:1px solid var(--border);position:relative;overflow:hidden;}
.stat-box:last-child{border-right:none;}
.stat-box::before{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--blue),transparent);opacity:0;transition:opacity 0.3s;}
.stat-box:hover::before{opacity:1;}
.stat-n{font-family:'Bebas Neue',sans-serif;font-size:3rem;letter-spacing:0.04em;line-height:1;margin-bottom:0.4rem;}
.stat-n em{color:var(--blue-hi);font-style:normal;}
.stat-l{font-size:0.78rem;color:var(--text2);text-transform:uppercase;letter-spacing:0.08em;}
.stat-sub{font-size:0.72rem;color:var(--text3);margin-top:0.2rem;}

/* TRUSTPILOT */
.tp-banner{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:2rem 2.5rem;display:flex;align-items:center;justify-content:space-between;gap:2rem;flex-wrap:wrap;position:relative;overflow:hidden;}
.tp-banner::before{content:'';position:absolute;inset:0;background:linear-gradient(110deg,transparent 0%,rgba(59,130,246,0.04) 45%,rgba(59,130,246,0.08) 50%,rgba(59,130,246,0.04) 55%,transparent 100%);transform:translateX(-120%);animation:tpShimmer 4s linear infinite;pointer-events:none;}
@keyframes tpShimmer{0%{transform:translateX(-120%);}100%{transform:translateX(120%);}}
.tp-left{display:flex;align-items:center;gap:1.5rem;}
.tp-logo-big{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.06em;}
.tp-logo-big em{color:#00B67A;font-style:normal;}
.tp-score-big{font-family:'Bebas Neue',sans-serif;font-size:3.5rem;color:#00B67A;letter-spacing:0.04em;line-height:1;}
.tp-score-label{font-size:0.78rem;color:var(--text2);}
.tp-divider{width:1px;height:60px;background:var(--border2);}
.tp-copy strong{display:block;font-size:1rem;font-weight:700;margin-bottom:0.25rem;}
.tp-copy span{font-size:0.85rem;color:var(--text2);font-weight:300;}

/* REVIEWS */
.reviews-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.review{background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1.5rem;transition:border-color 0.2s;}
.review:hover{border-color:var(--border2);}
.review-stars{color:var(--gold);font-size:0.8rem;margin-bottom:0.75rem;letter-spacing:0.1em;}
.review-text{font-size:0.875rem;color:var(--text2);line-height:1.65;font-weight:300;margin-bottom:1.25rem;font-style:italic;}
.review-author{display:flex;align-items:center;gap:0.75rem;}
.review-ava{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;background:var(--blue-dim);border:1px solid var(--border2);flex-shrink:0;}
.review-name{font-weight:600;font-size:0.82rem;}
.review-meta{font-size:0.7rem;color:var(--text3);}
.review-verified{display:inline-flex;align-items:center;gap:0.25rem;font-size:0.65rem;font-weight:600;color:var(--green);margin-top:0.2rem;}

/* RESELLER STRIP */
.reseller-strip{background:linear-gradient(135deg,rgba(59,130,246,0.06),rgba(29,78,216,0.03));border-top:1px solid rgba(59,130,246,0.12);border-bottom:1px solid rgba(59,130,246,0.12);padding:1.5rem 4%;}
.reseller-inner{max-width:1300px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
.reseller-text{display:flex;align-items:center;gap:0.75rem;}
.reseller-icon{font-size:1.5rem;}
.reseller-copy strong{display:block;font-size:0.9rem;font-weight:600;color:var(--text);margin-bottom:0.1rem;}
.reseller-copy span{font-size:0.8rem;color:var(--text2);}
.reseller-badges{display:flex;gap:0.5rem;flex-wrap:wrap;align-items:center;}
.rbadge{display:flex;align-items:center;gap:0.4rem;padding:0.35rem 0.75rem;background:var(--surface);border:1px solid var(--border2);border-radius:100px;font-size:0.72rem;font-weight:600;color:var(--text2);}
.rbadge em{color:var(--green);font-style:normal;}

/* FAQ */
.faq-bg{background:var(--bg2);}
.faq-list{max-width:760px;margin:0 auto;}
.faq-item{border-bottom:1px solid var(--border);}
.faq-q{width:100%;display:flex;align-items:center;justify-content:space-between;padding:1.25rem 0;background:none;border:none;color:var(--text);text-align:left;font-size:0.95rem;font-weight:600;cursor:pointer;font-family:'Outfit',sans-serif;gap:1rem;transition:color 0.2s;}
.faq-q:hover{color:var(--blue-hi);}
.faq-icon{width:24px;height:24px;border-radius:50%;border:1px solid var(--border2);display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;transition:all 0.2s;color:var(--text2);}
.faq-a{font-size:0.875rem;color:var(--text2);line-height:1.7;font-weight:300;max-height:0;overflow:hidden;transition:max-height 0.35s ease,padding 0.35s;}
.faq-item.open .faq-a{max-height:300px;padding-bottom:1.25rem;}
.faq-item.open .faq-icon{border-color:var(--blue);color:var(--blue-hi);background:var(--blue-dim);}

/* DISCORD CTA */
.discord-section{padding:80px 4%;position:relative;z-index:1;}
.discord-card{max-width:1300px;margin:0 auto;background:var(--surface);border:1px solid var(--border);border-radius:20px;padding:3rem;display:flex;align-items:center;justify-content:space-between;gap:2rem;flex-wrap:wrap;position:relative;overflow:hidden;}
.discord-card::before{content:'';position:absolute;top:-60px;right:-60px;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(88,101,242,0.12),transparent 70%);pointer-events:none;}
.dc-tag{font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#7289DA;margin-bottom:0.5rem;}
.dc-title{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:0.05em;margin-bottom:0.5rem;}
.dc-desc{font-size:0.9rem;color:var(--text2);font-weight:300;line-height:1.6;max-width:440px;}
.dc-right{display:flex;flex-direction:column;gap:0.75rem;align-items:flex-start;}
.dc-members{font-size:0.78rem;color:var(--text3);}
.dc-members strong{color:var(--text2);}

/* COMPLIANCE */
.compliance-strip{display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;padding:1rem 4%;background:var(--bg2);border-top:1px solid var(--border);}
.compliance-strip span{font-size:0.78rem;color:var(--text2);}

/* FOOTER */
footer{background:var(--surface);border-top:1px solid var(--border);padding:3rem 4% 1.5rem;position:relative;z-index:1;}
.footer-inner{max-width:1300px;margin:0 auto;}
.footer-top{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:3rem;margin-bottom:2.5rem;}
.footer-logo{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.08em;color:var(--text);display:block;margin-bottom:0.75rem;}
.footer-logo em{color:var(--blue-hi);font-style:normal;}
.footer-desc{font-size:0.82rem;color:var(--text2);line-height:1.65;font-weight:300;margin-bottom:1rem;}
.footer-disclaimer{font-size:0.72rem;color:var(--text3);line-height:1.6;padding:0.75rem;background:var(--bg2);border:1px solid var(--border);border-radius:6px;}
.footer-col-title{font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--text2);margin-bottom:1rem;}
.footer-col ul{list-style:none;display:flex;flex-direction:column;gap:0.5rem;}
.footer-col ul a{font-size:0.82rem;color:var(--text3);transition:color 0.2s;}
.footer-col ul a:hover{color:var(--blue-hi);}
.footer-bottom{border-top:1px solid var(--border);padding-top:1.5rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
.footer-copy{font-size:0.75rem;color:var(--text3);}
.footer-legal{display:flex;gap:1.25rem;}
.footer-legal a{font-size:0.75rem;color:var(--text3);transition:color 0.2s;}
.footer-legal a:hover{color:var(--text2);}

/* FORMS */
.field-group,.co-field{margin-bottom:1.25rem;}
.field-group label,.co-field label{display:block;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--text2);margin-bottom:0.5rem;}
.field-group input,.field-group textarea,.field-group select,
.co-field input,.co-field textarea,.co-field select{display:block;width:100%;background:var(--surface2);border:1px solid var(--border2);border-radius:8px;padding:0.75rem 1rem;color:var(--text);font-size:0.9rem;font-family:'Outfit',sans-serif;transition:border-color 0.2s;outline:none;resize:vertical;}
.field-group input:focus,.field-group textarea:focus,
.co-field input:focus,.co-field textarea:focus{border-color:var(--blue);}
.form-error,.auth-error{background:var(--red-dim);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.875rem 1.25rem;font-size:0.85rem;color:var(--red);margin-bottom:1.25rem;}

/* AUTH */
.auth-section{padding:120px 4% 80px;display:flex;align-items:center;justify-content:center;min-height:80vh;}
.auth-box{background:var(--surface);border:1px solid var(--border2);border-radius:20px;padding:2.5rem;width:100%;max-width:420px;}
.auth-box h2{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.05em;margin-bottom:0.5rem;}
.auth-box>p{font-size:0.85rem;color:var(--text2);margin-bottom:1.75rem;}
.auth-footer{margin-top:1.25rem;text-align:center;font-size:0.82rem;color:var(--text3);}
.auth-footer a{color:var(--blue-hi);}

/* REVEAL */
.reveal{opacity:0;transform:translateY(18px);transition:opacity 0.5s ease,transform 0.5s ease;}
.reveal.visible{opacity:1;transform:none;}

/* RESPONSIVE */
@media(max-width:1024px){
  .stats-grid{grid-template-columns:repeat(2,1fr);}
  .why-grid{grid-template-columns:repeat(2,1fr);}
  .reviews-grid{grid-template-columns:1fr 1fr;}
  .footer-top{grid-template-columns:1fr 1fr;}
  .steps-grid{grid-template-columns:1fr;}
  .tp-banner{flex-direction:column;align-items:flex-start;}
}
@media(max-width:768px){
  nav#navbar .nav-links{display:none;}
  nav#navbar .nav-links.open{display:flex;flex-direction:column;position:fixed;top:64px;left:0;right:0;background:rgba(2,4,13,0.97);backdrop-filter:blur(24px);padding:1.5rem 4%;gap:0;border-bottom:1px solid var(--border);}
  nav#navbar .nav-links.open li{border-bottom:1px solid var(--border);}
  nav#navbar .nav-links.open li:last-child{border:none;}
  nav#navbar .nav-links.open a{display:block;padding:0.875rem 0;font-size:1rem;}
  nav#navbar .nav-right .pill-ghost{display:none;}
  .hamburger{display:flex;}
  .reviews-grid{grid-template-columns:1fr;}
  .footer-top{grid-template-columns:1fr;}
  .trust-inner{gap:0.75rem;}
  .ti-sep{display:none;}
  .why-grid{grid-template-columns:1fr;}
  .discord-card{flex-direction:column;}
  .stats-grid{grid-template-columns:1fr 1fr;}
  .prods-grid{grid-template-columns:repeat(2,1fr);}
  .cat-grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:480px){
  .cat-grid{grid-template-columns:repeat(2,1fr);}
  .prods-grid{grid-template-columns:1fr 1fr;}
}
</style>
<?php if ($extra_css): ?><style><?= $extra_css ?></style><?php endif; ?>
</head>
