<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Societas GRH — Transformez votre gestion RH</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root {
  --blue:      #1a56db;
  --blue-dark: #1341b0;
  --blue-light:#eff6ff;
  --blue-mid:  #dbeafe;
  --navy:      #0f1f3d;
  --white:     #ffffff;
  --gray-50:   #f9fafb;
  --gray-100:  #f3f4f6;
  --gray-200:  #e5e7eb;
  --gray-400:  #9ca3af;
  --gray-500:  #6b7280;
  --gray-700:  #374151;
  --gray-900:  #111827;
  --green:     #059669;
  --font:      'Sora', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
}
*{ margin:0; padding:0; box-sizing:border-box; }
html{ scroll-behavior:smooth; font-size:16px; }
body{ font-family:var(--font-body); color:var(--gray-900); background:white; -webkit-font-smoothing:antialiased; overflow-x:hidden; }

/* ══ NAVBAR ══ */
.navbar {
  position:fixed; top:0; left:0; right:0; z-index:1000;
  height:68px; background:white;
  border-bottom:1px solid var(--gray-200);
  display:flex; align-items:center;
  padding:0 80px;
  transition:box-shadow .3s;
}
.navbar.scrolled { box-shadow:0 2px 20px rgba(0,0,0,.08); }
.nav-logo {
  display:flex; align-items:center; gap:10px;
  text-decoration:none; margin-right:48px;
}
.nav-logo-mark {
  width:36px; height:36px; background:var(--blue);
  border-radius:8px; display:flex; align-items:center;
  justify-content:center; color:white; font-weight:800;
  font-size:.9rem; font-family:var(--font);
}
.nav-logo-name { font-family:var(--font); font-weight:700; font-size:1rem; color:var(--gray-900); }
.nav-logo-name span { color:var(--blue); }
.nav-links { display:flex; align-items:center; gap:32px; flex:1; }
.nav-links a {
  font-size:.88rem; font-weight:500; color:var(--gray-500);
  text-decoration:none; transition:color .2s;
}
.nav-links a:hover { color:var(--gray-900); }
.nav-right { display:flex; align-items:center; gap:12px; }
.btn-login {
  padding:8px 20px; border-radius:8px;
  font-size:.85rem; font-weight:600;
  color:var(--blue); background:transparent;
  border:1.5px solid var(--blue);
  text-decoration:none; transition:all .2s;
  font-family:var(--font);
}
.btn-login:hover { background:var(--blue-light); }
.btn-demo {
  padding:8px 20px; border-radius:8px;
  font-size:.85rem; font-weight:600;
  color:white; background:var(--blue);
  border:none; cursor:pointer;
  text-decoration:none; transition:all .2s;
  font-family:var(--font);
  display:inline-flex; align-items:center; gap:6px;
}
.btn-demo:hover { background:var(--blue-dark); }

/* ══ HERO ══ */
.hero {
  min-height:100vh;
  position:relative;
  display:flex; align-items:center;
  padding:120px 80px 80px;
  overflow:hidden;
}
.hero-bg {
  position:absolute; inset:0; z-index:0;
  background:
    linear-gradient(110deg, rgba(15,31,61,.88) 0%, rgba(15,31,61,.75) 40%, rgba(26,86,219,.4) 100%),
    url('Manual-Of-Me-1.png') center/cover no-repeat;
}
.hero-bg::after {
  content:'';
  position:absolute; inset:0;
  background:linear-gradient(to right, rgba(15,31,61,.6) 0%, transparent 70%);
}
.hero-content { position:relative; z-index:1; max-width:680px; }
.hero-badge {
  display:inline-flex; align-items:center; gap:8px;
  background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.2);
  border-radius:20px; padding:6px 14px; margin-bottom:28px;
}
.hero-badge span { font-size:.75rem; font-weight:600; color:rgba(255,255,255,.85); letter-spacing:.5px; }
.hero-badge .dot { width:7px; height:7px; border-radius:50%; background:#34d399; }
.hero-title {
  font-family:var(--font);
  font-size:clamp(2.5rem,4.5vw,4rem);
  font-weight:800; color:white;
  line-height:1.12; margin-bottom:20px;
  letter-spacing:-.5px;
}
.hero-title .hl { color:#60a5fa; }
.hero-sub {
  font-size:1.05rem; color:rgba(255,255,255,.65);
  line-height:1.7; max-width:520px; margin-bottom:36px;
}
.hero-btns { display:flex; gap:14px; flex-wrap:wrap; margin-bottom:52px; }
.btn-hero-main {
  padding:14px 28px; border-radius:10px;
  background:var(--blue); color:white;
  font-family:var(--font); font-size:.95rem; font-weight:700;
  border:none; cursor:pointer; text-decoration:none;
  display:inline-flex; align-items:center; gap:8px;
  transition:all .25s; box-shadow:0 8px 24px rgba(26,86,219,.4);
}
.btn-hero-main:hover { background:#1d4ed8; transform:translateY(-2px); }
.btn-hero-outline {
  padding:14px 28px; border-radius:10px;
  background:rgba(255,255,255,.08);
  border:1.5px solid rgba(255,255,255,.25);
  color:white; font-family:var(--font);
  font-size:.95rem; font-weight:600;
  text-decoration:none; display:inline-flex; align-items:center; gap:8px;
  transition:all .25s;
}
.btn-hero-outline:hover { background:rgba(255,255,255,.14); border-color:rgba(255,255,255,.4); }

/* Stats hero */
.hero-stats { display:flex; gap:0; border-top:1px solid rgba(255,255,255,.12); padding-top:32px; }
.hstat { flex:1; padding-right:32px; border-right:1px solid rgba(255,255,255,.12); margin-right:32px; }
.hstat:last-child { border-right:none; padding-right:0; margin-right:0; }
.hstat .val { font-family:var(--font-mono); font-size:1.8rem; font-weight:700; color:white; }
.hstat .val span { color:#60a5fa; }
.hstat .lbl { font-size:.75rem; color:rgba(255,255,255,.45); margin-top:4px; text-transform:uppercase; letter-spacing:.6px; }

/* Dashboard visual right */
.hero-visual {
  position:absolute; right:60px; top:50%;
  transform:translateY(-50%);
  width:520px; z-index:1;
}
.dash-window {
  background:white; border-radius:14px;
  box-shadow:0 32px 80px rgba(0,0,0,.5);
  overflow:hidden; border:1px solid var(--gray-200);
}
.dash-topbar {
  background:var(--gray-50); border-bottom:1px solid var(--gray-200);
  padding:10px 16px; display:flex; align-items:center; gap:8px;
}
.dash-dot { width:9px; height:9px; border-radius:50%; }
.dash-title { font-size:.72rem; color:var(--gray-400); margin-left:4px; font-family:var(--font-mono); }
.dash-body { padding:16px; }
.dash-row { display:grid; grid-template-columns:repeat(4,1fr); gap:8px; margin-bottom:12px; }
.dash-kpi { background:var(--gray-50); border:1px solid var(--gray-200); border-radius:8px; padding:10px; }
.dash-kpi .dv { font-family:var(--font-mono); font-size:1rem; font-weight:800; color:var(--gray-900); }
.dash-kpi .dl { font-size:.6rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:.4px; margin-top:2px; }
.dash-kpi .dt { font-size:.62rem; font-weight:700; margin-top:3px; }
.dash-chart { background:var(--gray-50); border:1px solid var(--gray-200); border-radius:8px; padding:12px; margin-bottom:10px; }
.dash-chart-head { font-size:.65rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px; }
.dash-bars { display:flex; align-items:flex-end; gap:5px; height:48px; }
.dash-bar { flex:1; border-radius:3px 3px 0 0; }
.dash-table-head { display:flex; font-size:.6rem; font-weight:700; color:var(--gray-400); text-transform:uppercase; letter-spacing:.5px; padding:6px 8px; background:var(--gray-50); border:1px solid var(--gray-200); border-radius:6px 6px 0 0; gap:8px; }
.dash-table-row { display:flex; align-items:center; font-size:.68rem; padding:7px 8px; border:1px solid var(--gray-200); border-top:none; gap:8px; background:white; }
.dash-table-row:last-child { border-radius:0 0 6px 6px; }
.dash-av { width:20px; height:20px; border-radius:50%; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:.55rem; font-weight:800; color:white; }
.dash-pill { font-size:.55rem; font-weight:800; padding:2px 6px; border-radius:10px; }

/* ══ CLIENTS LOGOS ══ */
.logos-section {
  padding:40px 80px;
  background:var(--gray-50);
  border-top:1px solid var(--gray-200);
  border-bottom:1px solid var(--gray-200);
}
.logos-title { text-align:center; font-size:.8rem; font-weight:600; color:var(--gray-400); text-transform:uppercase; letter-spacing:1px; margin-bottom:24px; }
.logos-row { display:flex; align-items:center; justify-content:center; gap:48px; flex-wrap:wrap; }
.logo-item { font-family:var(--font); font-size:1rem; font-weight:800; color:var(--gray-300); letter-spacing:-.3px; }

/* ══ MODULES SECTION (style Socium) ══ */
.modules-section { padding:100px 80px; background:white; }
.sec-label {
  display:inline-flex; align-items:center; gap:6px;
  background:var(--blue-light); color:var(--blue);
  border-radius:20px; padding:5px 14px;
  font-size:.72rem; font-weight:700;
  text-transform:uppercase; letter-spacing:.8px; margin-bottom:14px;
}
.sec-title {
  font-family:var(--font); font-size:clamp(1.8rem,3vw,2.6rem);
  font-weight:800; color:var(--gray-900); line-height:1.2;
  margin-bottom:12px; letter-spacing:-.3px;
}
.sec-sub { font-size:1rem; color:var(--gray-500); line-height:1.7; max-width:600px; margin-bottom:64px; }

/* Module cards - style Socium alternant */
.module-block {
  display:grid; grid-template-columns:1fr 1fr;
  gap:64px; align-items:center; margin-bottom:80px;
}
.module-block.reverse { direction:rtl; }
.module-block.reverse > * { direction:ltr; }
.module-info {}
.module-tag {
  display:inline-flex; align-items:center; gap:6px;
  font-size:.72rem; font-weight:700; color:var(--blue);
  background:var(--blue-light); border-radius:6px;
  padding:4px 10px; margin-bottom:16px;
  text-transform:uppercase; letter-spacing:.5px;
}
.module-title { font-family:var(--font); font-size:1.5rem; font-weight:800; color:var(--gray-900); margin-bottom:12px; line-height:1.25; }
.module-desc { font-size:.92rem; color:var(--gray-500); line-height:1.7; margin-bottom:20px; }
.module-features { list-style:none; display:flex; flex-direction:column; gap:8px; }
.module-features li {
  display:flex; align-items:center; gap:10px;
  font-size:.88rem; color:var(--gray-700);
}
.module-features li::before {
  content:''; width:18px; height:18px; border-radius:50%;
  background:var(--blue-light); flex-shrink:0;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231a56db' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E");
  background-size:12px; background-position:center; background-repeat:no-repeat;
}

/* Module screenshot */
.module-visual {
  border-radius:14px; overflow:hidden;
  box-shadow:0 20px 60px rgba(0,0,0,.1);
  border:1px solid var(--gray-200);
  background:white;
}
.mv-bar {
  background:var(--gray-50); border-bottom:1px solid var(--gray-200);
  padding:10px 14px; display:flex; align-items:center; gap:6px;
}
.mv-dot { width:8px; height:8px; border-radius:50%; }
.mv-label { font-size:.68rem; color:var(--gray-400); margin-left:4px; font-family:var(--font-mono); }
.mv-body { padding:16px; }

/* Tableau employés mockup */
.mock-table { width:100%; border-collapse:collapse; }
.mock-table th { font-size:.6rem; font-weight:700; color:var(--gray-400); text-transform:uppercase; letter-spacing:.5px; padding:7px 10px; background:var(--gray-50); border-bottom:1px solid var(--gray-200); text-align:left; }
.mock-table td { font-size:.7rem; padding:8px 10px; border-bottom:1px solid var(--gray-100); color:var(--gray-700); vertical-align:middle; }
.mock-table tr:last-child td { border-bottom:none; }
.mt-av { width:22px; height:22px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:.55rem; font-weight:800; color:white; margin-right:6px; vertical-align:middle; }
.mt-badge { font-size:.6rem; font-weight:700; padding:2px 7px; border-radius:10px; display:inline-block; }
.mt-badge.actif { background:#dcfce7; color:#16a34a; }
.mt-badge.orange { background:#fef3c7; color:#d97706; }
.mt-badge.rouge { background:#fee2e2; color:#dc2626; }

/* Paie mockup */
.paie-mock { padding:0; }
.paie-header { padding:14px 16px; border-bottom:1px solid var(--gray-100); }
.paie-emp { display:flex; align-items:center; gap:10px; margin-bottom:12px; }
.paie-emp-av { width:38px; height:38px; border-radius:50%; background:var(--blue); display:flex; align-items:center; justify-content:center; color:white; font-weight:800; font-size:.8rem; }
.paie-emp-name { font-weight:700; font-size:.88rem; color:var(--gray-900); }
.paie-emp-role { font-size:.72rem; color:var(--gray-400); }
.paie-amounts { display:grid; grid-template-columns:repeat(3,1fr); gap:8px; }
.pa-item { background:var(--gray-50); border:1px solid var(--gray-200); border-radius:8px; padding:10px; text-align:center; }
.pa-item .pav { font-family:var(--font-mono); font-size:.9rem; font-weight:800; color:var(--gray-900); }
.pa-item .pal { font-size:.6rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:.4px; margin-top:2px; }
.paie-table { margin:12px 16px 0; }

/* Congés mockup */
.conge-mock { padding:0; }
.cal-header { display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-bottom:1px solid var(--gray-100); }
.cal-month { font-weight:700; font-size:.88rem; color:var(--gray-900); }
.cal-nav { display:flex; gap:4px; }
.cal-nav button { width:24px; height:24px; border:1px solid var(--gray-200); border-radius:6px; background:white; cursor:pointer; font-size:.8rem; color:var(--gray-500); }
.cal-grid-mock { padding:12px 16px; }
.cal-days-head { display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:6px; }
.cal-days-head span { font-size:.6rem; font-weight:700; color:var(--gray-400); text-transform:uppercase; }
.cal-grid-days { display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
.cday { aspect-ratio:1; display:flex; align-items:center; justify-content:center; font-size:.68rem; color:var(--gray-600); border-radius:6px; cursor:pointer; }
.cday:hover { background:var(--gray-100); }
.cday.today { background:var(--blue); color:white; font-weight:700; }
.cday.conge { background:#fce7f3; color:#be185d; }
.cday.absence { background:#fee2e2; color:#dc2626; }
.cday.other { color:var(--gray-300); }

/* ══ KPI ══ */
.kpi-section { background:var(--navy); padding:80px 80px; }
.kpi-section .sec-title { color:white; }
.kpi-section .sec-sub { color:rgba(255,255,255,.45); }
.kpi-section .sec-label { background:rgba(26,86,219,.2); color:#60a5fa; }
.kpi-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-top:48px; }
.kpi-card {
  background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.08);
  border-radius:14px; padding:24px;
  transition:all .25s;
}
.kpi-card:hover { background:rgba(255,255,255,.08); border-color:rgba(26,86,219,.4); transform:translateY(-3px); }
.kpi-icon { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:14px; }
.kpi-name { font-family:var(--font); font-size:1.1rem; font-weight:800; color:white; margin-bottom:6px; }
.kpi-formula { font-family:var(--font-mono); font-size:.72rem; color:#60a5fa; background:rgba(26,86,219,.15); padding:4px 8px; border-radius:5px; display:inline-block; margin-bottom:10px; }
.kpi-def { font-size:.82rem; color:rgba(255,255,255,.4); line-height:1.6; }

/* ══ CANDIDATURE ══ */
.cand-section { padding:100px 80px; background:var(--gray-50); }
.cand-layout { display:grid; grid-template-columns:1fr 1.1fr; gap:80px; align-items:start; }
.cand-left { position:sticky; top:100px; }
.cand-title { font-family:var(--font); font-size:2.2rem; font-weight:800; color:var(--gray-900); line-height:1.2; margin-bottom:16px; }
.cand-desc { font-size:.95rem; color:var(--gray-500); line-height:1.7; margin-bottom:32px; }
.cand-steps { display:flex; flex-direction:column; gap:16px; }
.cstep { display:flex; gap:14px; align-items:flex-start; padding:14px 16px; border-radius:10px; background:white; border:1px solid var(--gray-200); transition:all .2s; }
.cstep:hover { border-color:var(--blue); box-shadow:0 4px 16px rgba(26,86,219,.08); }
.cstep-num { width:28px; height:28px; border-radius:50%; background:var(--blue); color:white; display:flex; align-items:center; justify-content:center; font-size:.72rem; font-weight:800; flex-shrink:0; font-family:var(--font-mono); }
.cstep-title { font-size:.88rem; font-weight:700; color:var(--gray-800); margin-bottom:2px; }
.cstep-desc  { font-size:.78rem; color:var(--gray-500); line-height:1.5; }

/* Formulaire */
.cand-form { background:white; border:1px solid var(--gray-200); border-radius:16px; padding:32px; box-shadow:0 8px 40px rgba(0,0,0,.06); }
.cf-title { font-family:var(--font); font-size:1.3rem; font-weight:800; color:var(--gray-900); margin-bottom:4px; }
.cf-sub { font-size:.82rem; color:var(--gray-400); margin-bottom:24px; }
.cf-progress { display:flex; gap:6px; margin-bottom:20px; }
.cf-prog-step { flex:1; height:3px; border-radius:2px; background:var(--gray-200); transition:background .3s; }
.cf-prog-step.active { background:var(--blue); }
.cf-tabs { display:flex; background:var(--gray-100); border-radius:8px; padding:3px; gap:3px; margin-bottom:20px; }
.cf-tab { flex:1; padding:7px; text-align:center; border-radius:6px; cursor:pointer; font-size:.78rem; font-weight:600; color:var(--gray-500); transition:all .18s; border:none; background:none; font-family:var(--font); }
.cf-tab.active { background:white; color:var(--blue); box-shadow:0 1px 6px rgba(0,0,0,.08); }
.cf-step { display:none; }
.cf-step.active { display:block; }
.fg { margin-bottom:14px; }
.fl { display:block; font-size:.72rem; font-weight:700; color:var(--gray-500); text-transform:uppercase; letter-spacing:.5px; margin-bottom:5px; }
.fc { width:100%; background:white; border:1.5px solid var(--gray-200); border-radius:8px; padding:10px 12px; color:var(--gray-900); font-family:var(--font-body); font-size:.86rem; outline:none; transition:all .18s; }
.fc:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(26,86,219,.08); }
.fc::placeholder { color:var(--gray-400); }
select.fc { cursor:pointer; }
textarea.fc { resize:vertical; min-height:80px; }
.fg-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.upload-zone { border:2px dashed var(--gray-200); border-radius:8px; padding:18px; text-align:center; cursor:pointer; transition:all .18s; background:var(--gray-50); position:relative; }
.upload-zone:hover { border-color:var(--blue); background:var(--blue-light); }
.upload-zone input { position:absolute; inset:0; opacity:0; cursor:pointer; }
.upload-title { font-size:.82rem; font-weight:600; color:var(--gray-700); margin-top:6px; }
.upload-title span { color:var(--blue); }
.upload-hint { font-size:.7rem; color:var(--gray-400); margin-top:2px; }
.upload-done { font-size:.75rem; color:var(--green); font-weight:700; margin-top:4px; display:none; }
.btn-next { width:100%; background:var(--blue); color:white; border:none; border-radius:8px; padding:12px; font-size:.9rem; font-weight:700; cursor:pointer; font-family:var(--font); transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px; margin-top:8px; }
.btn-next:hover { background:var(--blue-dark); }
.btn-back { background:var(--gray-100); color:var(--gray-600); border:none; border-radius:8px; padding:12px 16px; cursor:pointer; font-family:var(--font); font-size:.88rem; font-weight:600; }
.btn-row { display:flex; gap:8px; margin-top:8px; }
.consent-label { display:flex; gap:10px; align-items:flex-start; cursor:pointer; font-size:.8rem; color:var(--gray-600); line-height:1.5; }
.consent-label input { margin-top:2px; accent-color:var(--blue); }
.form-success-box { display:none; text-align:center; padding:24px 0; }
.success-check { width:60px; height:60px; border-radius:50%; background:#dcfce7; color:var(--green); display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:1.6rem; }
.success-title { font-family:var(--font); font-size:1.1rem; font-weight:800; color:var(--gray-900); margin-bottom:8px; }
.success-desc { font-size:.85rem; color:var(--gray-500); line-height:1.6; }
.recap-box { background:var(--gray-50); border:1px solid var(--gray-200); border-radius:8px; padding:16px; margin-bottom:14px; }
.recap-box .rt { font-size:.7rem; font-weight:800; color:var(--gray-400); text-transform:uppercase; letter-spacing:.5px; margin-bottom:10px; }
.recap-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
.rg-item .rl { font-size:.68rem; color:var(--gray-400); }
.rg-item .rv { font-size:.82rem; font-weight:700; color:var(--gray-800); margin-top:1px; }

/* ══ CTA ══ */
.cta-section { padding:100px 80px; background:var(--blue); text-align:center; position:relative; overflow:hidden; }
.cta-section::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
.cta-title { font-family:var(--font); font-size:2.5rem; font-weight:800; color:white; margin-bottom:16px; position:relative; }
.cta-sub { font-size:1rem; color:rgba(255,255,255,.65); margin-bottom:36px; position:relative; max-width:500px; margin-left:auto; margin-right:auto; }
.cta-btns { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; position:relative; }
.btn-cta-white { padding:13px 28px; border-radius:10px; background:white; color:var(--blue); font-family:var(--font); font-size:.92rem; font-weight:800; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:8px; }
.btn-cta-white:hover { background:var(--gray-50); transform:translateY(-2px); }
.btn-cta-ghost { padding:13px 28px; border-radius:10px; border:1.5px solid rgba(255,255,255,.35); color:white; font-family:var(--font); font-size:.92rem; font-weight:600; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:8px; }
.btn-cta-ghost:hover { border-color:white; background:rgba(255,255,255,.1); }

/* ══ FOOTER ══ */
footer { background:var(--navy); padding:60px 80px 28px; border-top:1px solid rgba(255,255,255,.06); }
.footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; margin-bottom:48px; }
.footer-brand .fn { font-family:var(--font); font-size:1.1rem; font-weight:800; color:white; margin-bottom:10px; }
.footer-brand .fd { font-size:.83rem; color:rgba(255,255,255,.3); line-height:1.6; max-width:220px; }
.footer-col-t { font-size:.7rem; font-weight:800; color:rgba(255,255,255,.3); text-transform:uppercase; letter-spacing:1px; margin-bottom:14px; }
.footer-links { list-style:none; display:flex; flex-direction:column; gap:8px; }
.footer-links a { font-size:.83rem; color:rgba(255,255,255,.4); text-decoration:none; transition:color .2s; }
.footer-links a:hover { color:white; }
.footer-bottom { border-top:1px solid rgba(255,255,255,.06); padding-top:22px; display:flex; align-items:center; justify-content:space-between; }
.footer-bottom p { font-size:.78rem; color:rgba(255,255,255,.2); }
.footer-rgpd { display:flex; align-items:center; gap:6px; font-size:.72rem; color:rgba(255,255,255,.2); background:rgba(255,255,255,.04); padding:5px 10px; border-radius:6px; }

/* ══ ANIMATIONS ══ */
.reveal { opacity:0; transform:translateY(20px); transition:all .55s ease; }
.reveal.in { opacity:1; transform:translateY(0); }

/* ══ RESPONSIVE ══ */
@media(max-width:1200px){ .hero-visual{display:none;} .module-block{grid-template-columns:1fr;gap:32px;} .module-block.reverse{direction:ltr;} .kpi-grid{grid-template-columns:repeat(2,1fr);} }
@media(max-width:900px){ .navbar{padding:0 24px;} .nav-links{display:none;} .hero{padding:100px 24px 60px;} .modules-section,.kpi-section,.cand-section,.cta-section{padding:60px 24px;} .cand-layout{grid-template-columns:1fr;} .cand-left{position:static;} .footer-grid{grid-template-columns:1fr 1fr;} footer{padding:40px 24px 24px;} .logos-section{padding:32px 24px;} .logos-row{gap:24px;} .hstat{padding-right:16px;margin-right:16px;} }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <a href="#" class="nav-logo">
    <div class="nav-logo-mark">S</div>
    <div class="nav-logo-name">Societas <span>GRH</span></div>
  </a>
  <div class="nav-links">
    <a href="#modules">Nos modules</a>
    <a href="#indicateurs">Indicateurs</a>
    <a href="#candidature">Recrutement</a>
    <a href="#">À propos</a>
    <a href="#">Contact</a>
  </div>
  <div class="nav-right">
    <a href="/login" class="btn-login">Connexion</a>
    <a href="#candidature" class="btn-demo">
      Postuler <i data-lucide="arrow-right" style="width:14px;height:14px"></i>
    </a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <div class="hero-badge">
      <div class="dot"></div>
      <span>Plateforme SIRH nouvelle génération</span>
    </div>
    <h1 class="hero-title">
      Transformez votre<br>
      <span class="hl">gestion des talents</span><br>
      avec Societas GRH
    </h1>
    <p class="hero-sub">
      Centralisez employés, congés, présences, paie et recrutement
      dans une seule plateforme moderne — avec des indicateurs RH
      précis pour piloter votre entreprise.
    </p>
    <div class="hero-btns">
      <a href="#candidature" class="btn-hero-main">
        <i data-lucide="send" style="width:16px;height:16px"></i>
        Déposer une candidature
      </a>
      <a href="/login" class="btn-hero-outline">
        <i data-lucide="log-in" style="width:16px;height:16px"></i>
        Espace employé
      </a>
    </div>
    <div class="hero-stats">
      <div class="hstat"><div class="val">3<span>+</span></div><div class="lbl">Types de contrats</div></div>
      <div class="hstat"><div class="val">360<span>°</span></div><div class="lbl">Vue RH complète</div></div>
      <div class="hstat"><div class="val">ETP<span>/EMM</span></div><div class="lbl">Indicateurs précis</div></div>
    </div>
  </div>

  <!-- Dashboard mockup -->
  <div class="hero-visual">
    <div class="dash-window">
      <div class="dash-topbar">
        <div class="dash-dot" style="background:#ff5f57"></div>
        <div class="dash-dot" style="background:#ffbd2e"></div>
        <div class="dash-dot" style="background:#28ca41"></div>
        <span class="dash-title">Societas — Tableau de bord RH</span>
      </div>
      <div class="dash-body">
        <div class="dash-row">
          <div class="dash-kpi"><div class="dv">247</div><div class="dl">Employés</div><div class="dt" style="color:#059669">↑ +12</div></div>
          <div class="dash-kpi"><div class="dv">94<span style="font-size:.65rem">%</span></div><div class="dl">Présence</div><div class="dt" style="color:#1a56db">Stable</div></div>
          <div class="dash-kpi"><div class="dv">38</div><div class="dl">Congés</div><div class="dt" style="color:#d97706">En cours</div></div>
          <div class="dash-kpi"><div class="dv">12</div><div class="dl">Candidats</div><div class="dt" style="color:#7c3aed">Nouveaux</div></div>
        </div>
        <div class="dash-chart">
          <div class="dash-chart-head">Présences — 7 jours</div>
          <div class="dash-bars">
            <div class="dash-bar" style="height:45%;background:#dbeafe"></div>
            <div class="dash-bar" style="height:72%;background:#bfdbfe"></div>
            <div class="dash-bar" style="height:58%;background:#dbeafe"></div>
            <div class="dash-bar" style="height:88%;background:#93c5fd"></div>
            <div class="dash-bar" style="height:76%;background:#bfdbfe"></div>
            <div class="dash-bar" style="height:92%;background:#1a56db"></div>
            <div class="dash-bar" style="height:82%;background:#60a5fa"></div>
          </div>
        </div>
        <div class="dash-table-head">
          <span style="flex:2">Employé</span>
          <span style="flex:1.5">Matricule</span>
          <span style="flex:1.5">Département</span>
          <span style="flex:1">Statut</span>
        </div>
        <div class="dash-table-row">
          <div style="flex:2;display:flex;align-items:center"><div class="dash-av" style="background:#6366f1">MD</div>Mamadou D.</div>
          <div style="flex:1.5;font-family:var(--font-mono)">EMP-001</div>
          <div style="flex:1.5">Finance</div>
          <div style="flex:1"><span class="dash-pill" style="background:#dcfce7;color:#16a34a">Actif</span></div>
        </div>
        <div class="dash-table-row">
          <div style="flex:2;display:flex;align-items:center"><div class="dash-av" style="background:#f59e0b">FC</div>Fatou C.</div>
          <div style="flex:1.5;font-family:var(--font-mono)">EMP-002</div>
          <div style="flex:1.5">RH</div>
          <div style="flex:1"><span class="dash-pill" style="background:#fef3c7;color:#d97706">Congé</span></div>
        </div>
        <div class="dash-table-row">
          <div style="flex:2;display:flex;align-items:center"><div class="dash-av" style="background:#22c55e">AN</div>Astou N.</div>
          <div style="flex:1.5;font-family:var(--font-mono)">EMP-003</div>
          <div style="flex:1.5">Tech</div>
          <div style="flex:1"><span class="dash-pill" style="background:#dcfce7;color:#16a34a">Actif</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LOGOS -->
<div class="logos-section">
  <div class="logos-title">Ils nous font confiance</div>
  <div class="logos-row">
    <div class="logo-item">SAHEL GROUP</div>
    <div class="logo-item">WEST AFRICA TECH</div>
    <div class="logo-item">DAKAR SERVICES</div>
    <div class="logo-item">TRANSPORT SÉNÉGAL</div>
    <div class="logo-item">SEN GROUPE </div>
  </div>
</div>

<!-- MODULES -->
<section class="modules-section" id="modules">
  <div class="reveal">
    <div class="sec-label"><i data-lucide="layout-grid" style="width:12px;height:12px"></i> Nos modules</div>
    <h2 class="sec-title">Une suite complète<br>pour votre département RH</h2>
    <p class="sec-sub">Découvrez nos modules intégrés, conçus pour transformer votre gestion des ressources humaines.</p>
  </div>

  <!-- Module 1 — Employés -->
  <div class="module-block reveal">
    <div class="module-info">
      <div class="module-tag"><i data-lucide="users" style="width:12px;height:12px"></i> Workspace RH</div>
      <h3 class="module-title">Centralisez l'ensemble<br>de vos données employés</h3>
      <p class="module-desc">Gérez les fiches employés, contrats, structures et historiques depuis une interface unifiée. Filtres avancés, actions rapides et vue tableau.</p>
      <ul class="module-features">
        <li>Fiches employés complètes (CDI, CDD, Intérim)</li>
        <li>Gestion des structures et organigramme</li>
        <li>Historique des modifications</li>
        <li>Actions rapides : ajout, modification, archivage</li>
      </ul>
    </div>
    <div class="module-visual">
      <div class="mv-bar">
        <div class="mv-dot" style="background:#ff5f57"></div>
        <div class="mv-dot" style="background:#ffbd2e"></div>
        <div class="mv-dot" style="background:#28ca41"></div>
        <span class="mv-label">Societas Workspace · Employés</span>
      </div>
      <div class="mv-body">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
          <div style="font-family:var(--font);font-weight:800;font-size:1rem;color:var(--gray-900)">Employés <span style="font-size:.7rem;background:var(--blue-light);color:var(--blue);padding:2px 8px;border-radius:10px;font-weight:700;margin-left:4px">247</span></div>
          <div style="display:flex;gap:6px">
            <button style="font-size:.7rem;padding:5px 10px;border:1px solid var(--gray-200);border-radius:6px;background:white;cursor:pointer;font-weight:600;color:var(--gray-600)">+ Ajouter</button>
          </div>
        </div>
        <table class="mock-table">
          <thead><tr><th>Nom</th><th>Matricule</th><th>Structure</th><th>Statut</th></tr></thead>
          <tbody>
            <tr><td><span class="mt-av" style="background:#6366f1">MD</span>Mamadou Bâ</td><td style="font-family:var(--font-mono)">EMP-001</td><td>Administration</td><td><span class="mt-badge actif">Actif</span></td></tr>
            <tr><td><span class="mt-av" style="background:#f59e0b">FC</span>Mame Fatou C.</td><td style="font-family:var(--font-mono)">EMP-002</td><td>Finance</td><td><span class="mt-badge actif">Actif</span></td></tr>
            <tr><td><span class="mt-av" style="background:#ef4444">FD</span>Fatima Diagne</td><td style="font-family:var(--font-mono)">EMP-003</td><td>Commercial</td><td><span class="mt-badge orange">Congé</span></td></tr>
            <tr><td><span class="mt-av" style="background:#22c55e">EI</span>Etienne Imagu</td><td style="font-family:var(--font-mono)">EMP-004</td><td>Product</td><td><span class="mt-badge rouge">Mis à pied</span></td></tr>
            <tr><td><span class="mt-av" style="background:#8b5cf6">MH</span>Maristou H.</td><td style="font-family:var(--font-mono)">EMP-005</td><td>Product</td><td><span class="mt-badge actif">Actif</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Module 2 — Paie -->
  <div class="module-block reverse reveal">
    <div class="module-info">
      <div class="module-tag"><i data-lucide="credit-card" style="width:12px;height:12px"></i> Payroll</div>
      <h3 class="module-title">Gérez votre paie<br>en toute conformité</h3>
      <p class="module-desc">Génération automatique des bulletins de paie, calcul des cotisations, historique complet. Chaque employé accède à ses fiches depuis son espace.</p>
      <ul class="module-features">
        <li>Bulletins de paie générés automatiquement</li>
        <li>Calcul des éléments de rémunération</li>
        <li>Conventions collectives intégrées</li>
        <li>Consultation sécurisée par l'employé</li>
      </ul>
    </div>
    <div class="module-visual">
      <div class="mv-bar">
        <div class="mv-dot" style="background:#ff5f57"></div>
        <div class="mv-dot" style="background:#ffbd2e"></div>
        <div class="mv-dot" style="background:#28ca41"></div>
        <span class="mv-label">Societas Payroll · Tableau de bord</span>
      </div>
      <div class="paie-mock">
        <div class="paie-header">
          <div style="font-size:.7rem;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Tableau de bord paie — Mars 2025</div>
          <div class="paie-amounts">
            <div class="pa-item"><div class="pav">1 500 000</div><div class="pal">Masse salariale brute (XOF)</div></div>
            <div class="pa-item"><div class="pav">1 000 000</div><div class="pal">Masse salariale nette</div></div>
            <div class="pa-item"><div class="pav">6 097</div><div class="pal">Coût moyen / employé</div></div>
          </div>
        </div>
        <div class="paie-table">
          <div style="font-size:.65rem;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Évolution salariale</div>
          <div style="display:flex;align-items:flex-end;gap:4px;height:52px">
            <div style="flex:1;background:#dbeafe;border-radius:3px 3px 0 0;height:60%"></div>
            <div style="flex:1;background:#bfdbfe;border-radius:3px 3px 0 0;height:70%"></div>
            <div style="flex:1;background:#93c5fd;border-radius:3px 3px 0 0;height:55%"></div>
            <div style="flex:1;background:#60a5fa;border-radius:3px 3px 0 0;height:80%"></div>
            <div style="flex:1;background:#3b82f6;border-radius:3px 3px 0 0;height:75%"></div>
            <div style="flex:1;background:#1a56db;border-radius:3px 3px 0 0;height:95%"></div>
          </div>
          <div style="display:flex;justify-content:space-between;font-size:.6rem;color:var(--gray-400);margin-top:4px;padding-bottom:12px">
            <span>Oct</span><span>Nov</span><span>Déc</span><span>Jan</span><span>Fév</span><span>Mar</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Module 3 — Congés -->
  <div class="module-block reveal">
    <div class="module-info">
      <div class="module-tag"><i data-lucide="calendar-days" style="width:12px;height:12px"></i> Workflow Congés</div>
      <h3 class="module-title">Automatisez la gestion<br>des congés et absences</h3>
      <p class="module-desc">Demandes en ligne, validation hiérarchique, soldes automatiques. Calendrier partagé pour visualiser les absences de toute l'équipe.</p>
      <ul class="module-features">
        <li>Demandes de congés en ligne</li>
        <li>Circuit de validation personnalisable</li>
        <li>Calendrier partagé par département</li>
        <li>Suivi des absences et justificatifs</li>
      </ul>
    </div>
    <div class="module-visual">
      <div class="mv-bar">
        <div class="mv-dot" style="background:#ff5f57"></div>
        <div class="mv-dot" style="background:#ffbd2e"></div>
        <div class="mv-dot" style="background:#28ca41"></div>
        <span class="mv-label">Societas Workflow · Congés</span>
      </div>
      <div class="conge-mock">
        <div class="cal-header">
          <div class="cal-month">Avril 2025</div>
          <div style="display:flex;gap:6px">
            <button style="padding:4px 10px;font-size:.72rem;border:1px solid var(--gray-200);border-radius:6px;background:white;cursor:pointer;font-weight:600;color:var(--blue)">Calendrier</button>
            <button style="padding:4px 10px;font-size:.72rem;border:1px solid var(--gray-200);border-radius:6px;background:white;cursor:pointer;font-weight:600;color:var(--gray-500)">Validation</button>
          </div>
        </div>
        <div class="cal-grid-mock">
          <div class="cal-days-head">
            <span>L</span><span>M</span><span>M</span><span>J</span><span>V</span><span>S</span><span>D</span>
          </div>
          <div class="cal-grid-days">
            <div class="cday other">31</div>
            <div class="cday">1</div><div class="cday">2</div><div class="cday">3</div><div class="cday">4</div><div class="cday">5</div><div class="cday">6</div>
            <div class="cday">7</div><div class="cday">8</div><div class="cday today">9</div><div class="cday">10</div><div class="cday">11</div><div class="cday">12</div><div class="cday">13</div>
            <div class="cday">14</div><div class="cday">15</div><div class="cday">16</div><div class="cday conge">17</div><div class="cday conge">18</div><div class="cday">19</div><div class="cday">20</div>
            <div class="cday">21</div><div class="cday">22</div><div class="cday absence">23</div><div class="cday">24</div><div class="cday">25</div><div class="cday">26</div><div class="cday">27</div>
            <div class="cday">28</div><div class="cday">29</div><div class="cday">30</div>
          </div>
          <div style="display:flex;gap:12px;margin-top:10px;font-size:.68rem;color:var(--gray-500)">
            <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:#fce7f3;display:inline-block"></span>Congé</span>
            <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:#fee2e2;display:inline-block"></span>Absence</span>
            <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:var(--blue);display:inline-block"></span>Aujourd'hui</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KPI -->
<section class="kpi-section" id="indicateurs">
  <div class="reveal">
    <div class="sec-label"><i data-lucide="trending-up" style="width:12px;height:12px"></i> Indicateurs RH</div>
    <h2 class="sec-title" style="color:white">Pilotez avec des<br>métriques précises</h2>
    <p class="sec-sub">Societas calcule automatiquement les indicateurs essentiels pour une gestion RH rigoureuse et conforme.</p>
  </div>
  <div class="kpi-grid reveal">
    <div class="kpi-card">
      <div class="kpi-icon" style="background:rgba(26,86,219,.15)"><i data-lucide="users" style="width:20px;height:20px;stroke:#60a5fa"></i></div>
      <div class="kpi-name">ETP</div>
      <div class="kpi-formula">Heures réelles / Heures théoriques</div>
      <div class="kpi-def">Équivalent Temps Plein — mesure la main d'œuvre disponible en unités de temps complet.</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-icon" style="background:rgba(245,158,11,.15)"><i data-lucide="calendar" style="width:20px;height:20px;stroke:#fcd34d"></i></div>
      <div class="kpi-name">EMM</div>
      <div class="kpi-formula">(Eff. début + Eff. fin) / 2</div>
      <div class="kpi-def">Effectif Moyen Mensuel — nombre moyen d'employés sur le mois, base des ratios RH.</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-icon" style="background:rgba(5,150,105,.15)"><i data-lucide="bar-chart-2" style="width:20px;height:20px;stroke:#34d399"></i></div>
      <div class="kpi-name">EMA</div>
      <div class="kpi-formula">Σ Effectifs mensuels / 12</div>
      <div class="kpi-def">Effectif Moyen Annuel — vision annuelle de la masse salariale pour la planification.</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-icon" style="background:rgba(239,68,68,.12)"><i data-lucide="percent" style="width:20px;height:20px;stroke:#fca5a5"></i></div>
      <div class="kpi-name">Taux d'absentéisme</div>
      <div class="kpi-formula">(Abs. / H. théoriques) × 100</div>
      <div class="kpi-def">Mesure l'impact des absences sur la productivité pour anticiper et prévenir.</div>
    </div>
  </div>
</section>

<!-- CANDIDATURE -->
<section class="cand-section" id="candidature">
  <div class="cand-layout">
    <div class="cand-left reveal">
      <div class="sec-label"><i data-lucide="briefcase" style="width:12px;height:12px"></i> Recrutement</div>
      <h2 class="cand-title">Déposez votre<br>candidature</h2>
      <p class="cand-desc">Aucun compte requis. Votre dossier est transmis directement au Responsable RH ou au Directeur Général.</p>
      <div class="cand-steps">
        <div class="cstep"><div class="cstep-num">01</div><div><div class="cstep-title">Remplissez vos informations</div><div class="cstep-desc">Identité, poste visé et type de contrat souhaité.</div></div></div>
        <div class="cstep"><div class="cstep-num">02</div><div><div class="cstep-title">Joignez vos documents</div><div class="cstep-desc">CV, lettre de motivation et lettre de recommandation.</div></div></div>
        <div class="cstep"><div class="cstep-num">03</div><div><div class="cstep-title">Envoyez votre dossier</div><div class="cstep-desc">Transmis directement au RH ou DG selon le poste.</div></div></div>
        <div class="cstep"><div class="cstep-num">04</div><div><div class="cstep-title">Suivi de candidature</div><div class="cstep-desc">Vous serez contacté si votre profil correspond.</div></div></div>
      </div>
    </div>

    <div class="cand-form reveal">
      <div class="cf-title">Postuler maintenant</div>
      <div class="cf-sub">Transmis directement au Responsable RH</div>
      <div class="cf-progress">
        <div class="cf-prog-step active" id="p1"></div>
        <div class="cf-prog-step" id="p2"></div>
        <div class="cf-prog-step" id="p3"></div>
      </div>
      <div class="cf-tabs">
        <button class="cf-tab active" onclick="goCfStep(1)">Informations</button>
        <button class="cf-tab" onclick="goCfStep(2)">Documents</button>
        <button class="cf-tab" onclick="goCfStep(3)">Confirmation</button>
      </div>

      <!-- Step 1 -->
      <div class="cf-step active" id="cfs-1">
        <div class="fg-2">
          <div class="fg"><label class="fl">Prénom *</label><input type="text" class="fc" id="c-prenom" placeholder="votre prénom"></div>
          <div class="fg"><label class="fl">Nom *</label><input type="text" class="fc" id="c-nom" placeholder="votre nom"></div>
        </div>
        <div class="fg"><label class="fl">Email *</label><input type="email" class="fc" id="c-email" placeholder="votre@email.com"></div>
        <div class="fg"><label class="fl">Téléphone</label><input type="tel" class="fc" id="c-tel" placeholder="+221 77 000 00 00"></div>
        <div class="fg-2">
          <div class="fg"><label class="fl">Poste visé *</label>
            <select class="fc" id="c-poste">
              <option value="">— Sélectionner —</option>
              <option>Comptable</option><option>Développeur Web</option>
              <option>Responsable Marketing</option><option>Assistant RH</option>
              <option>Commercial</option><option>Chef de projet</option><option>Assistant en contrôle de gestion</option>
            </select>
          </div>
          <div class="fg"><label class="fl">Type de contrat *</label>
            <select class="fc" id="c-contrat">
              <option value="">— Sélectionner —</option>
              <option>CDI</option><option>CDD</option><option>Stage</option>
              <option>Intérim</option><option>Freelance</option>
            </select>
          </div>
        </div>
        <div class="fg"><label class="fl">Expérience</label>
          <select class="fc" id="c-exp">
            <option>Moins d'1 an</option><option>1 à 3 ans</option>
            <option>3 à 5 ans</option><option>Plus de 5 ans</option>
          </select>
        </div>
        <button class="btn-next" onclick="goCfStep(2)">Suivant <i data-lucide="arrow-right" style="width:15px;height:15px"></i></button>
      </div>

      <!-- Step 2 -->
      <div class="cf-step" id="cfs-2">
        <div class="fg">
          <label class="fl">CV *</label>
          <div class="upload-zone" id="uz-cv">
            <input type="file" accept=".pdf,.doc,.docx" onchange="handleUp(this,'cv-done','uz-cv')">
            <i data-lucide="file-up" style="width:26px;height:26px;stroke:var(--blue);margin:0 auto 6px;display:block"></i>
            <div class="upload-title"><span>Cliquez</span> ou glissez votre CV</div>
            <div class="upload-hint">PDF, DOC — max 5MB</div>
            <div class="upload-done" id="cv-done"></div>
          </div>
        </div>
        <div class="fg">
          <label class="fl">Lettre de motivation *</label>
          <div class="upload-zone" id="uz-lm">
            <input type="file" accept=".pdf,.doc,.docx" onchange="handleUp(this,'lm-done','uz-lm')">
            <i data-lucide="file-text" style="width:26px;height:26px;stroke:var(--blue);margin:0 auto 6px;display:block"></i>
            <div class="upload-title"><span>Cliquez</span> pour votre lettre</div>
            <div class="upload-hint">PDF, DOC — max 5MB</div>
            <div class="upload-done" id="lm-done"></div>
          </div>
        </div>
        <div class="fg">
          <label class="fl">Lettre de recommandation <span style="font-weight:400;font-size:.7rem;text-transform:none;letter-spacing:0;color:var(--gray-400)">(optionnel)</span></label>
          <div class="upload-zone" id="uz-rec">
            <input type="file" accept=".pdf,.doc,.docx" onchange="handleUp(this,'rec-done','uz-rec')">
            <i data-lucide="award" style="width:26px;height:26px;stroke:var(--blue);margin:0 auto 6px;display:block"></i>
            <div class="upload-title"><span>Cliquez</span> si disponible</div>
            <div class="upload-hint">PDF, DOC — max 5MB</div>
            <div class="upload-done" id="rec-done"></div>
          </div>
        </div>
        <div class="btn-row">
          <button class="btn-back" onclick="goCfStep(1)"><i data-lucide="arrow-left" style="width:14px;height:14px"></i></button>
          <button class="btn-next" style="flex:1" onclick="goCfStep(3)">Suivant <i data-lucide="arrow-right" style="width:15px;height:15px"></i></button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="cf-step" id="cfs-3">
        <div class="recap-box" id="recap-box">
          <div class="rt">Récapitulatif</div>
          <div class="recap-grid" id="recap-content"></div>
        </div>
        <div class="fg">
          <label class="fl">Message <span style="font-weight:400;font-size:.7rem;text-transform:none;letter-spacing:0;color:var(--gray-400)">(optionnel)</span></label>
          <textarea class="fc" id="c-msg" rows="3" placeholder="Disponibilité, prétentions salariales..."></textarea>
        </div>
        <div class="fg">
          <label class="consent-label">
            <input type="checkbox" id="c-consent">
            J'accepte que mes données soient traitées dans le cadre de ma candidature (RGPD).
          </label>
        </div>
        <div class="btn-row">
          <button class="btn-back" onclick="goCfStep(2)"><i data-lucide="arrow-left" style="width:14px;height:14px"></i></button>
          <button class="btn-next" id="btn-send" style="flex:1" onclick="sendCand()">
            <i data-lucide="send" style="width:15px;height:15px"></i> Envoyer ma candidature
          </button>
        </div>
      </div>

      <!-- Succès -->
      <div class="form-success-box" id="cand-success">
        <div class="success-check">✅</div>
        <div class="success-title">Candidature envoyée !</div>
        <div class="success-desc">Votre dossier a été transmis au Responsable RH. Un email de confirmation vous sera envoyé.</div>
        <button class="btn-next" style="margin-top:16px" onclick="resetCand()">Nouvelle candidature</button>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <h2 class="cta-title">Prêt à moderniser votre<br>gestion RH ?</h2>
  <p class="cta-sub">Rejoignez Societas GRH et transformez votre département RH en centre de valeur stratégique.</p>
  <div class="cta-btns">
    <a href="/login" class="btn-cta-white"><i data-lucide="log-in" style="width:16px;height:16px"></i> Accéder à la plateforme</a>
    <a href="#candidature" class="btn-cta-ghost"><i data-lucide="send" style="width:16px;height:16px"></i> Déposer une candidature</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
        <div class="nav-logo-mark" style="background:var(--blue)">S</div>
        <div class="nav-logo-name" style="color:white;font-family:var(--font);font-weight:700">Societas <span style="color:#60a5fa">GRH</span></div>
      </div>
      <p class="fd">Plateforme complète de gestion RH — employés, présences, congés, paie et recrutement.</p>
    </div>
    <div>
      <div class="footer-col-t">Plateforme</div>
      <ul class="footer-links">
        <li><a href="#modules">Nos modules</a></li>
        <li><a href="#indicateurs">Indicateurs RH</a></li>
        <li><a href="/login">Connexion</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-t">Recrutement</div>
      <ul class="footer-links">
        <li><a href="#candidature">Déposer un CV</a></li>
        <li><a href="#candidature">Lettre de motivation</a></li>
        <li><a href="#candidature">Recommandation</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-t">Contact</div>
      <ul class="footer-links">
        <li><a href="#">rh@societas-grh.sn</a></li>
        <li><a href="#">+221 77 000 00 00</a></li>
        <li><a href="#">THIES, Sénégal</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2026 Societas GRH — Tous droits réservés</p>
    <div class="footer-rgpd"><i data-lucide="lock" style="width:11px;height:11px"></i> Données sécurisées · RGPD conforme</div>
  </div>
</footer>

<script>
// Navbar scroll
window.addEventListener('scroll',()=>document.getElementById('navbar').classList.toggle('scrolled',scrollY>30));

// Reveal on scroll
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting)x.target.classList.add('in');}),{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

// Formulaire multi-étapes
let cfStep=1;
function goCfStep(n){
  document.getElementById('cfs-'+cfStep).classList.remove('active');
  document.querySelectorAll('.cf-tab').forEach((t,i)=>t.classList.toggle('active',i===n-1));
  [1,2,3].forEach(i=>document.getElementById('p'+i).classList.toggle('active',i<=n));
  cfStep=n;
  document.getElementById('cfs-'+n).classList.add('active');
  if(n===3) buildRecap();
  lucide.createIcons();
}

function handleUp(input,doneId,zoneId){
  const f=input.files[0]; if(!f)return;
  const done=document.getElementById(doneId);
  done.textContent='✅ '+f.name; done.style.display='block';
  document.getElementById(zoneId).style.borderColor='var(--blue)';
  lucide.createIcons();
}

function buildRecap(){
  const p=document.getElementById('c-prenom').value||'—';
  const n=document.getElementById('c-nom').value||'—';
  const e=document.getElementById('c-email').value||'—';
  const po=document.getElementById('c-poste').value||'—';
  const c=document.getElementById('c-contrat').value||'—';
  const cvOk=document.getElementById('cv-done').style.display==='block';
  const lmOk=document.getElementById('lm-done').style.display==='block';
  document.getElementById('recap-content').innerHTML=`
    <div class="rg-item"><div class="rl">Nom complet</div><div class="rv">${p} ${n}</div></div>
    <div class="rg-item"><div class="rl">Email</div><div class="rv">${e}</div></div>
    <div class="rg-item"><div class="rl">Poste visé</div><div class="rv" style="color:var(--blue)">${po}</div></div>
    <div class="rg-item"><div class="rl">Contrat</div><div class="rv">${c}</div></div>
    <div class="rg-item"><div class="rl">CV</div><div class="rv">${cvOk?'✅ Joint':'❌ Manquant'}</div></div>
    <div class="rg-item"><div class="rl">LM</div><div class="rv">${lmOk?'✅ Joint':'❌ Manquante'}</div></div>`;
}

function sendCand(){
  const p=document.getElementById('c-prenom').value.trim();
  const e=document.getElementById('c-email').value.trim();
  const po=document.getElementById('c-poste').value;
  const co=document.getElementById('c-contrat').value;
  const consent=document.getElementById('c-consent').checked;
  if(!p||!e){alert('Veuillez remplir le prénom et l\'email.');goCfStep(1);return;}
  if(!po||!co){alert('Sélectionnez le poste et le type de contrat.');goCfStep(1);return;}
  if(!consent){alert('Veuillez accepter la politique de données.');return;}
  const btn=document.getElementById('btn-send');
  btn.disabled=true; btn.textContent='Envoi en cours...';
  setTimeout(()=>{
    document.getElementById('cfs-3').style.display='none';
    document.querySelector('.cf-progress').style.display='none';
    document.querySelector('.cf-tabs').style.display='none';
    document.getElementById('cand-success').style.display='block';
  },1500);
}

function resetCand(){
  cfStep=1;
  ['cfs-1','cfs-2','cfs-3'].forEach(id=>{const el=document.getElementById(id);el.classList.remove('active');el.style.display='';});
  document.getElementById('cfs-1').classList.add('active');
  document.querySelector('.cf-progress').style.display='';
  document.querySelector('.cf-tabs').style.display='';
  document.getElementById('cand-success').style.display='none';
  ['c-prenom','c-nom','c-email','c-tel','c-msg'].forEach(id=>document.getElementById(id).value='');
  ['c-poste','c-contrat'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('c-consent').checked=false;
  ['cv-done','lm-done','rec-done'].forEach(id=>{const el=document.getElementById(id);el.textContent='';el.style.display='none';});
  [1,2,3].forEach(i=>document.getElementById('p'+i).classList.toggle('active',i===1));
  document.querySelectorAll('.cf-tab').forEach((t,i)=>t.classList.toggle('active',i===0));
  const btn=document.getElementById('btn-send');
  btn.disabled=false;
  btn.innerHTML='<i data-lucide="send" style="width:15px;height:15px"></i> Envoyer ma candidature';
  lucide.createIcons();
}

document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());
</script>
</body>
</html>
