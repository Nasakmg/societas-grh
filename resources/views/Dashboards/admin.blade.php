<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Societas GRH — Administration</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
/* ══ TOKENS ══ */
:root{
  --font:'Inter',sans-serif;
  --mono:'JetBrains Mono',monospace;
  --icon-w:52px;
  --menu-w:224px;
  --topbar-h:52px;
  --r:6px;--r-lg:10px;--r-xl:14px;
  --transition:.15s ease;
}
/* DARK */
[data-theme="dark"]{
  --bg:#0e1117;--bg2:#13161f;
  --surface:#1a1f2e;--s2:#20253a;--s3:#272d42;
  --border:rgba(255,255,255,.07);--border2:rgba(255,255,255,.04);
  --text:#e8ecf4;--text2:#8b93a8;--text3:#4a5268;
  --blue:#4f7cf7;--blue-bg:rgba(79,124,247,.12);--blue-bd:rgba(79,124,247,.3);
  --green:#22c55e;--green-bg:rgba(34,197,94,.12);
  --orange:#f59e0b;--orange-bg:rgba(245,158,11,.12);
  --red:#ef4444;--red-bg:rgba(239,68,68,.12);
  --purple:#a855f7;--purple-bg:rgba(168,85,247,.12);
  --cyan:#06b6d4;
  --shadow:0 8px 24px rgba(0,0,0,.5);
}
/* LIGHT */
[data-theme="light"]{
  --bg:#f1f5f9;--bg2:#ffffff;
  --surface:#ffffff;--s2:#f8fafc;--s3:#f1f5f9;
  --border:rgba(0,0,0,.08);--border2:rgba(0,0,0,.04);
  --text:#0f172a;--text2:#64748b;--text3:#94a3b8;
  --blue:#2563eb;--blue-bg:rgba(37,99,235,.08);--blue-bd:rgba(37,99,235,.25);
  --green:#16a34a;--green-bg:rgba(22,163,74,.08);
  --orange:#d97706;--orange-bg:rgba(217,119,6,.08);
  --red:#dc2626;--red-bg:rgba(220,38,38,.08);
  --purple:#7c3aed;--purple-bg:rgba(124,58,237,.08);
  --cyan:#0891b2;
  --shadow:0 4px 16px rgba(0,0,0,.08);
}

*{margin:0;padding:0;box-sizing:border-box;}
html{font-size:13px;}
body{font-family:var(--font);background:var(--bg);color:var(--text);min-height:100vh;display:flex;-webkit-font-smoothing:antialiased;transition:background var(--transition),color var(--transition);}

/* ══ ICON BAR ══ */
.icon-bar{
  width:var(--icon-w);min-height:100vh;
  background:var(--bg2);border-right:1px solid var(--border);
  display:flex;flex-direction:column;align-items:center;
  position:fixed;left:0;top:0;bottom:0;z-index:300;padding:10px 0;
}
.ib-logo{width:30px;height:30px;border-radius:7px;background:var(--blue);color:white;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.82rem;margin-bottom:14px;flex-shrink:0;}
.ib-group{display:flex;flex-direction:column;align-items:center;gap:3px;width:100%;flex:1;}
.ib-item{width:38px;height:38px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text3);transition:all var(--transition);position:relative;}
.ib-item:hover{background:var(--s2);color:var(--text2);}
.ib-item.active{background:var(--blue-bg);color:var(--blue);}
.ib-item svg{width:17px;height:17px;}
.ib-tip{position:absolute;left:calc(100% + 8px);top:50%;transform:translateY(-50%);background:var(--s3);border:1px solid var(--border);border-radius:var(--r);padding:4px 9px;font-size:.72rem;font-weight:600;color:var(--text);white-space:nowrap;pointer-events:none;opacity:0;z-index:500;transition:opacity .1s;}
.ib-item:hover .ib-tip{opacity:1;}
.ib-sep{width:28px;height:1px;background:var(--border);margin:5px 0;}
.ib-bottom{display:flex;flex-direction:column;align-items:center;gap:4px;padding-bottom:4px;}
.ib-av{width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.64rem;color:white;cursor:pointer;}

/* ══ MENU BAR ══ */
.menu-bar{
  width:var(--menu-w);min-height:100vh;
  background:var(--bg2);border-right:1px solid var(--border);
  display:flex;flex-direction:column;
  position:fixed;left:var(--icon-w);top:0;bottom:0;z-index:200;
  overflow-y:auto;overflow-x:hidden;transition:width var(--transition);
}
.menu-bar.collapsed{width:0;overflow:hidden;}
.menu-bar::-webkit-scrollbar{width:3px;}
.menu-bar::-webkit-scrollbar-thumb{background:var(--border);}

.mb-head{display:flex;align-items:center;justify-content:space-between;padding:0 14px;height:var(--topbar-h);border-bottom:1px solid var(--border);flex-shrink:0;min-width:var(--menu-w);}
.mb-title{display:flex;align-items:center;gap:8px;font-weight:700;font-size:.88rem;white-space:nowrap;}
.mb-icon{width:22px;height:22px;border-radius:5px;display:flex;align-items:center;justify-content:center;}
.mb-toggle{width:22px;height:22px;border-radius:4px;background:var(--s2);border:none;color:var(--text3);cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;}

.mb-nav{flex:1;padding:8px 0;min-width:var(--menu-w);}
.mb-sec{display:flex;align-items:center;justify-content:space-between;padding:10px 14px 4px;font-size:.62rem;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text3);cursor:pointer;user-select:none;}
.mb-sec:hover{color:var(--text2);}
.mb-sec .arr{transition:transform .2s;}
.mb-sec .arr.open{transform:rotate(180deg);}

.mb-item{display:flex;align-items:center;gap:9px;padding:7px 14px;border-radius:var(--r);margin:1px 6px;cursor:pointer;color:var(--text2);font-size:.8rem;font-weight:500;transition:all var(--transition);white-space:nowrap;}
.mb-item:hover{background:var(--s2);color:var(--text);}
.mb-item.active{background:var(--blue-bg);color:var(--blue);}
.mb-item svg{width:14px;height:14px;flex-shrink:0;}
.mb-item .lbl{flex:1;}
.mb-badge{font-size:.58rem;font-weight:800;padding:2px 5px;border-radius:8px;background:var(--blue);color:white;flex-shrink:0;}
.mb-badge.r{background:var(--red);}
.mb-badge.o{background:var(--orange);}
.mb-badge.g{background:var(--green);}

.mb-qa{display:flex;align-items:center;gap:9px;padding:6px 14px;border-radius:var(--r);margin:1px 6px;cursor:pointer;font-size:.78rem;font-weight:600;transition:all var(--transition);white-space:nowrap;}
.mb-qa:hover{background:var(--s2);}
.qa-ic{width:22px;height:22px;border-radius:5px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.qa-ic svg{width:12px;height:12px;}

.mb-footer{padding:8px 6px;border-top:1px solid var(--border);flex-shrink:0;min-width:var(--menu-w);}
.mb-logout{display:flex;align-items:center;gap:9px;padding:7px 14px;border-radius:var(--r);cursor:pointer;color:var(--text2);font-size:.8rem;font-weight:500;transition:all var(--transition);background:none;border:none;width:100%;font-family:var(--font);text-align:left;}
.mb-logout:hover{background:var(--red-bg);color:var(--red);}

/* ══ MAIN ══ */
.main-wrap{flex:1;margin-left:calc(var(--icon-w) + var(--menu-w));display:flex;flex-direction:column;min-height:100vh;transition:margin-left var(--transition);}
.main-wrap.menu-collapsed{margin-left:var(--icon-w);}

/* ══ TOPBAR ══ */
.topbar{height:var(--topbar-h);background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 18px;gap:10px;position:sticky;top:0;z-index:100;flex-shrink:0;}
.tb-bc{flex:1;display:flex;align-items:center;gap:5px;font-size:.76rem;color:var(--text3);}
.tb-bc span{cursor:pointer;transition:color var(--transition);}
.tb-bc span:hover{color:var(--text2);}
.tb-bc .cur{color:var(--text);font-weight:600;}
.tb-bc .sep{color:var(--text3);pointer-events:none;}
.tb-search{display:flex;align-items:center;gap:7px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:6px 11px;width:210px;transition:all var(--transition);}
.tb-search:focus-within{border-color:var(--blue);width:250px;}
.tb-search input{background:none;border:none;outline:none;color:var(--text);font-size:.78rem;width:100%;font-family:var(--font);}
.tb-search input::placeholder{color:var(--text3);}
.tb-right{display:flex;align-items:center;gap:6px;}
.tb-btn{width:30px;height:30px;border-radius:var(--r);background:var(--surface);border:1px solid var(--border);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--transition);position:relative;}
.tb-btn:hover{border-color:var(--blue);color:var(--blue);}
.tb-nb{position:absolute;top:-3px;right:-3px;width:14px;height:14px;border-radius:50%;background:var(--red);color:white;font-size:.55rem;font-weight:800;display:flex;align-items:center;justify-content:center;border:2px solid var(--bg2);}
.tb-prof{display:flex;align-items:center;gap:7px;padding:3px 10px 3px 3px;border-radius:18px;background:var(--surface);border:1px solid var(--border);cursor:pointer;transition:all var(--transition);position:relative;}
.tb-prof:hover{border-color:var(--blue);}
.tb-pav{width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.6rem;color:white;}
.tb-pname{font-size:.76rem;font-weight:600;}

/* Dropdown */
.dropdown{position:absolute;top:calc(100% + 6px);right:0;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--shadow);z-index:600;display:none;min-width:160px;padding:4px;}
.dropdown.open{display:block;}
.dd-item{display:flex;align-items:center;gap:8px;padding:6px 10px;border-radius:var(--r);cursor:pointer;font-size:.78rem;color:var(--text2);transition:all var(--transition);}
.dd-item:hover{background:var(--s2);color:var(--text);}
.dd-item.danger:hover{color:var(--red);background:var(--red-bg);}
.dd-sep{border-top:1px solid var(--border);margin:3px 0;}

/* Notif */
.notif-panel{position:absolute;top:calc(100% + 6px);right:0;width:290px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--shadow);z-index:600;display:none;overflow:hidden;}
.notif-panel.open{display:block;}
.np-head{display:flex;align-items:center;justify-content:space-between;padding:9px 13px;border-bottom:1px solid var(--border);}
.np-t{font-weight:700;font-size:.8rem;}
.np-clear{font-size:.68rem;color:var(--blue);cursor:pointer;font-weight:600;}
.np-item{display:flex;gap:9px;padding:8px 13px;border-bottom:1px solid var(--border2);cursor:pointer;transition:background var(--transition);}
.np-item:hover{background:var(--s2);}
.np-item.unread{background:var(--blue-bg);}
.np-ico{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;}
.np-title{font-size:.74rem;font-weight:700;color:var(--text);}
.np-sub{font-size:.66rem;color:var(--text2);margin-top:1px;}
.np-time{font-size:.6rem;color:var(--text3);margin-top:2px;}

/* ══ CONTENT ══ */
.content{flex:1;padding:20px;overflow-y:auto;}
.page{display:none;animation:pgIn .18s ease;}
.page.active{display:block;}
@keyframes pgIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}

/* Page header */
.pg-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px;gap:12px;flex-wrap:wrap;}
.pg-hl .pg-title{font-size:1.25rem;font-weight:700;letter-spacing:-.2px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.pg-count{font-size:.68rem;font-weight:800;background:var(--blue-bg);color:var(--blue);padding:2px 8px;border-radius:10px;border:1px solid var(--blue-bd);}
.pg-sub{font-size:.76rem;color:var(--text2);margin-top:4px;line-height:1.5;max-width:600px;}
.pg-tabs{display:flex;gap:4px;margin-bottom:16px;}
.pg-tab{padding:5px 14px;border-radius:var(--r);font-size:.78rem;font-weight:600;cursor:pointer;color:var(--text2);border:1px solid transparent;transition:all var(--transition);background:none;}
.pg-tab.active{background:var(--blue-bg);color:var(--blue);border-color:var(--blue-bd);}
.pg-tab:hover:not(.active){background:var(--s2);color:var(--text);}

/* ══ STATS ══ */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px;}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;transition:all var(--transition);}
.stat-card:hover{border-color:var(--blue-bd);}
.stat-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.stat-ic{width:34px;height:34px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;}
.stat-ic svg{width:15px;height:15px;}
.stat-ch{font-size:.64rem;font-weight:700;padding:2px 6px;border-radius:8px;display:flex;align-items:center;gap:2px;}
.stat-ch.up{background:var(--green-bg);color:var(--green);}
.stat-ch.down{background:var(--red-bg);color:var(--red);}
.stat-ch.neu{background:var(--s2);color:var(--text2);}
.stat-val{font-size:1.4rem;font-weight:800;font-family:var(--mono);line-height:1;margin-bottom:2px;}
.stat-lbl{font-size:.68rem;color:var(--text2);}

/* ══ CARD ══ */
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;}
.card-head{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;border-bottom:1px solid var(--border);}
.card-title{font-weight:700;font-size:.82rem;display:flex;align-items:center;gap:6px;}
.card-body{padding:14px;}

/* ══ TABLE TOOLBAR ══ */
.tbar{display:flex;align-items:center;justify-content:space-between;padding:9px 13px;border-bottom:1px solid var(--border);gap:8px;flex-wrap:wrap;}
.tbar-l{display:flex;align-items:center;gap:6px;flex-wrap:wrap;}
.tbar-r{display:flex;align-items:center;gap:5px;}
.t-search{display:flex;align-items:center;gap:6px;background:var(--s2);border:1px solid var(--border);border-radius:var(--r);padding:5px 10px;width:165px;transition:all var(--transition);}
.t-search:focus-within{border-color:var(--blue);width:195px;}
.t-search input{background:none;border:none;outline:none;color:var(--text);font-size:.76rem;width:100%;font-family:var(--font);}
.t-search input::placeholder{color:var(--text3);}
.t-filter{display:flex;align-items:center;gap:4px;padding:5px 9px;border-radius:var(--r);background:var(--s2);border:1px solid var(--border);color:var(--text2);font-size:.74rem;font-weight:500;cursor:pointer;transition:all var(--transition);font-family:var(--font);}
.t-filter:hover{border-color:var(--blue);color:var(--blue);}
.t-filter svg{width:11px;height:11px;}
.tool-btn{width:28px;height:28px;border-radius:var(--r);background:var(--s2);border:1px solid var(--border);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--transition);}
.tool-btn:hover{border-color:var(--blue);color:var(--blue);}
.view-tgl{display:flex;gap:2px;background:var(--s2);border:1px solid var(--border);border-radius:var(--r);padding:2px;}
.vt-btn{width:24px;height:24px;border-radius:4px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text3);transition:all var(--transition);}
.vt-btn.active{background:var(--s3);color:var(--text);}

/* ══ DATA TABLE ══ */
.tw{overflow-x:auto;}
.dt{width:100%;border-collapse:collapse;}
.dt th{text-align:left;padding:8px 12px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--text3);background:var(--bg2);border-bottom:1px solid var(--border);white-space:nowrap;}
.dt th .sort{display:inline-flex;align-items:center;gap:2px;cursor:pointer;user-select:none;}
.dt th .sort:hover{color:var(--text2);}
.dt td{padding:9px 12px;font-size:.78rem;color:var(--text2);border-bottom:1px solid var(--border2);vertical-align:middle;}
.dt tr:last-child td{border-bottom:none;}
.dt tr:hover td{background:rgba(255,255,255,.015);color:var(--text);}
.dt tr.sel td{background:var(--blue-bg);}
.cb{width:14px;height:14px;accent-color:var(--blue);cursor:pointer;}

/* Name cell */
.nc{display:flex;align-items:center;gap:9px;}
.nav-av{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;flex-shrink:0;}
.nc-n{font-weight:600;font-size:.8rem;color:var(--text);}
.nc-e{font-size:.66rem;color:var(--text3);margin-top:1px;}

/* Badges */
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:4px;font-size:.66rem;font-weight:700;white-space:nowrap;}
.bg{background:var(--green-bg);color:var(--green);}
.br{background:var(--red-bg);color:var(--red);}
.bo{background:var(--orange-bg);color:var(--orange);}
.bb{background:var(--blue-bg);color:var(--blue);}
.bp{background:var(--purple-bg);color:var(--purple);}
.bgr{background:var(--s2);color:var(--text2);}

/* Row actions */
.ra{display:flex;align-items:center;gap:3px;opacity:0;transition:opacity var(--transition);}
.dt tr:hover .ra{opacity:1;}
.ra-btn{width:24px;height:24px;border-radius:4px;background:none;border:none;color:var(--text3);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--transition);}
.ra-btn:hover{background:var(--s3);color:var(--text);}
.ra-btn.d:hover{color:var(--red);background:var(--red-bg);}

/* ══ BUTTONS ══ */
.btn{display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:var(--r);font-size:.76rem;font-weight:600;cursor:pointer;border:none;font-family:var(--font);transition:all var(--transition);white-space:nowrap;}
.btn svg{width:12px;height:12px;flex-shrink:0;}
.btn-primary{background:var(--blue);color:white;}
.btn-primary:hover{opacity:.9;}
.btn-ghost{background:var(--s2);border:1px solid var(--border);color:var(--text2);}
.btn-ghost:hover{color:var(--text);border-color:var(--blue-bd);}
.btn-success{background:var(--green);color:white;}
.btn-danger{background:var(--red);color:white;}
.btn-sm{padding:4px 9px;font-size:.7rem;}
.btn-icon{padding:5px;width:26px;height:26px;justify-content:center;}

/* ══ FORMS ══ */
.fg2{display:grid;grid-template-columns:1fr 1fr;gap:11px;}
.fg{display:flex;flex-direction:column;gap:4px;}
.fg.full{grid-column:1/-1;}
.fl{font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text2);}
.fc{background:var(--s2);border:1px solid var(--border);border-radius:var(--r);padding:7px 10px;color:var(--text);font-family:var(--font);font-size:.78rem;outline:none;transition:all var(--transition);width:100%;}
.fc:focus{border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-bg);}
.fc::placeholder{color:var(--text3);}
select.fc{cursor:pointer;}
textarea.fc{resize:vertical;min-height:65px;}
.fc:disabled{opacity:.5;cursor:not-allowed;}

/* ══ MODALS ══ */
.overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);backdrop-filter:blur(4px);z-index:700;display:none;align-items:center;justify-content:center;}
.overlay.open{display:flex;}
.modal{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-xl);box-shadow:var(--shadow);width:90%;max-width:520px;max-height:88vh;overflow-y:auto;animation:mIn .18s ease;}
.modal-lg{max-width:680px;}
@keyframes mIn{from{opacity:0;transform:scale(.96)}to{opacity:1;transform:scale(1)}}
.modal-head{display:flex;align-items:center;justify-content:space-between;padding:13px 16px;border-bottom:1px solid var(--border);position:sticky;top:0;background:var(--surface);z-index:1;}
.modal-title{font-weight:700;font-size:.86rem;}
.modal-close{width:24px;height:24px;border-radius:5px;background:var(--s2);border:1px solid var(--border);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--transition);}
.modal-close:hover{background:var(--red-bg);color:var(--red);}
.modal-body{padding:16px;}
.modal-foot{display:flex;justify-content:flex-end;gap:6px;padding:11px 16px;border-top:1px solid var(--border);}

/* ══ CHARTS ══ */
.bar-chart{display:flex;align-items:flex-end;gap:6px;height:110px;}
.bc-col{display:flex;flex-direction:column;align-items:center;gap:4px;flex:1;}
.bc-val{font-size:.62rem;font-weight:700;font-family:var(--mono);color:var(--text3);}
.bc-bar{width:100%;border-radius:4px 4px 0 0;transition:height .5s ease;}
.bc-lbl{font-size:.6rem;color:var(--text3);}
.chart-axis{border-top:1px solid var(--border);}
.prog-bar{height:4px;background:var(--s3);border-radius:2px;overflow:hidden;margin-top:3px;}
.prog-fill{height:100%;border-radius:2px;transition:width .5s ease;}

/* ══ CONGE CARD ══ */
.cg-card{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:var(--r);background:var(--s2);border:1px solid var(--border);margin-bottom:6px;transition:border-color var(--transition);}
.cg-card:hover{border-color:var(--blue-bd);}
.cg-av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;flex-shrink:0;}
.cg-info{flex:1;}
.cg-name{font-weight:600;font-size:.78rem;color:var(--text);}
.cg-det{font-size:.68rem;color:var(--text2);margin-top:1px;}
.cg-acts{display:flex;gap:4px;flex-shrink:0;}

/* ══ KPI ══ */
.kpi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px;}
.kpi-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;transition:all var(--transition);}
.kpi-card:hover{border-color:var(--blue-bd);}
.kpi-ic{width:34px;height:34px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;margin-bottom:9px;}
.kpi-ic svg{width:15px;height:15px;}
.kpi-name{font-size:.68rem;font-weight:700;color:var(--text2);text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px;}
.kpi-formula{font-family:var(--mono);font-size:.62rem;color:var(--blue);background:var(--blue-bg);padding:2px 6px;border-radius:3px;display:inline-block;margin-bottom:7px;}
.kpi-val{font-family:var(--mono);font-size:1.2rem;font-weight:800;color:var(--text);}
.kpi-def{font-size:.68rem;color:var(--text3);line-height:1.5;margin-top:4px;}

/* ══ ORGANIGRAMME ══ */
.org-tree{display:flex;flex-direction:column;align-items:center;gap:20px;}
.org-level{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;}
.org-node{background:var(--s2);border:1px solid var(--border);border-radius:var(--r-lg);padding:12px 16px;text-align:center;min-width:140px;cursor:pointer;transition:all var(--transition);}
.org-node:hover{border-color:var(--blue-bd);background:var(--blue-bg);}
.org-node.root{background:var(--blue-bg);border-color:var(--blue-bd);min-width:180px;}
.org-node .on-av{width:36px;height:36px;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.72rem;color:white;}
.org-node .on-name{font-weight:700;font-size:.8rem;color:var(--text);}
.org-node .on-role{font-size:.7rem;color:var(--text2);margin-top:2px;}
.org-connector{width:2px;height:20px;background:var(--border);margin:0 auto;}
.org-h-line{display:flex;align-items:center;justify-content:center;gap:0;margin-bottom:-10px;}

/* ══ TOAST ══ */
.toast{position:fixed;bottom:16px;right:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:8px 13px;box-shadow:var(--shadow);z-index:9999;font-size:.78rem;font-weight:600;display:none;align-items:center;gap:6px;}
.toast.show{display:flex;animation:su .2s ease;}
.toast.success{border-left:3px solid var(--green);color:var(--green);}
.toast.error{border-left:3px solid var(--red);color:var(--red);}
.toast.info{border-left:3px solid var(--blue);color:var(--blue);}
@keyframes su{from{opacity:0;transform:translateY(5px)}to{opacity:1;transform:translateY(0)}}

/* ══ FICHE PAIE ══ */
.paie-doc{background:white;color:#111;border-radius:var(--r-lg);padding:22px;font-family:var(--font);}
.paie-doc .ph{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;padding-bottom:14px;border-bottom:2px solid #2563eb;}
.paie-doc .cn{font-size:.95rem;font-weight:800;color:#2563eb;}
.paie-doc .ca{font-size:.7rem;color:#64748b;margin-top:3px;line-height:1.5;}
.paie-doc .pt h3{font-size:.86rem;font-weight:800;color:#111;}
.paie-doc .pt p{font-size:.7rem;color:#64748b;margin-top:2px;}
.paie-doc .eg{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px;background:#f8fafc;border-radius:7px;padding:10px;}
.paie-doc .eg .el{font-size:.6rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.4px;}
.paie-doc .eg .ev{font-size:.76rem;font-weight:700;color:#111;margin-top:1px;}
.paie-doc table{width:100%;border-collapse:collapse;margin-bottom:14px;}
.paie-doc table th{text-align:left;padding:6px 8px;font-size:.6rem;font-weight:700;text-transform:uppercase;color:#94a3b8;background:#f3f4f6;border-bottom:1px solid #e2e8f0;}
.paie-doc table td{padding:6px 8px;font-size:.74rem;border-bottom:1px solid #f1f5f9;}
.paie-doc .tots{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;}
.paie-doc .tot{background:#f8fafc;border-radius:7px;padding:10px;text-align:center;}
.paie-doc .tot .tl{font-size:.6rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.4px;}
.paie-doc .tot .tv{font-family:monospace;font-size:.88rem;font-weight:800;color:#111;margin-top:3px;}
.paie-doc .tot.net .tv{color:#16a34a;}
.paie-doc .sigs{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-top:18px;text-align:center;}
.paie-doc .sigs .sl{border-top:1px solid #e2e8f0;padding-top:5px;font-size:.66rem;color:#94a3b8;}

/* ══ GRIDS ══ */
.g2{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;}
.g21{display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:14px;}
.g3{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:14px;}

/* ══ SIMPLE PAGE ══ */
.empty-page{text-align:center;padding:60px 20px;color:var(--text2);}
.empty-page svg{display:block;margin:0 auto 14px;stroke:var(--text3);}
.empty-page h3{font-size:.95rem;font-weight:700;margin-bottom:6px;}
.empty-page p{font-size:.78rem;color:var(--text3);margin-bottom:16px;}

/* ══ RESPONSIVE ══ */
@media(max-width:1100px){.stats-grid{grid-template-columns:repeat(2,1fr);}.kpi-grid{grid-template-columns:1fr 1fr;}.g2,.g21{grid-template-columns:1fr;}}
@media(max-width:768px){.menu-bar{transform:translateX(-100%);}.menu-bar.mobile-open{transform:translateX(0);}.main-wrap{margin-left:var(--icon-w)!important;}.tb-search{display:none;}}
@media print{.icon-bar,.menu-bar,.topbar{display:none!important;}.main-wrap{margin-left:0!important;}.page{display:block!important;}body{background:white!important;color:black!important;}}
</style>
</head>
<body>

@php $u = Auth::user(); $init = strtoupper(substr($u->name ?? 'AD', 0, 2)); @endphp

<!-- ══ ICON BAR ══ -->
<div class="icon-bar">
  <div class="ib-logo">S</div>
  <div class="ib-group">
    <div class="ib-item active" id="ib-workspace" onclick="setModule('workspace',this)">
      <i data-lucide="layout-grid" style="width:17px;height:17px"></i>
      <span class="ib-tip">Workspace</span>
    </div>
    <div class="ib-item" id="ib-payroll" onclick="setModule('payroll',this)">
      <i data-lucide="credit-card" style="width:17px;height:17px"></i>
      <span class="ib-tip">Payroll</span>
    </div>
    <div class="ib-item" id="ib-conges" onclick="setModule('conges',this)">
      <i data-lucide="calendar-days" style="width:17px;height:17px"></i>
      <span class="ib-tip">Congés</span>
    </div>
    <div class="ib-item" id="ib-analytics" onclick="setModule('analytics',this)">
      <i data-lucide="bar-chart-2" style="width:17px;height:17px"></i>
      <span class="ib-tip">Analytics</span>
    </div>
    <div class="ib-item" id="ib-recrutement" onclick="setModule('recrutement',this)">
      <i data-lucide="briefcase" style="width:17px;height:17px"></i>
      <span class="ib-tip">Recrutement</span>
    </div>
  </div>
  <div class="ib-sep"></div>
  <div class="ib-bottom">
    <div class="ib-item" onclick="toggleTheme()">
      <i data-lucide="sun" style="width:17px;height:17px" id="theme-icon-ib"></i>
      <span class="ib-tip" id="theme-tip">Mode clair</span>
    </div>
    <div class="ib-av">{{ $init }}</div>
  </div>
</div>

<!-- ══ MENU BAR ══ -->
<div class="menu-bar" id="menu-bar">

  <!-- WORKSPACE -->
  <div id="sm-workspace">
    <div class="mb-head">
      <div class="mb-title">
        <div class="mb-icon" style="background:var(--blue-bg)"><i data-lucide="layout-grid" style="width:12px;height:12px;stroke:var(--blue)"></i></div>
        Workspace
      </div>
      <button class="mb-toggle" onclick="toggleMenu()"><i data-lucide="chevron-left" style="width:11px;height:11px"></i></button>
    </div>
    <div class="mb-nav">
      <div class="mb-sec">Menu principal <i data-lucide="chevron-down" class="arr open" style="width:10px;height:10px"></i></div>
      <div class="mb-item" id="mn-dashboard" onclick="nav('dashboard',this)">
        <i data-lucide="layout-dashboard" style="width:14px;height:14px"></i><span class="lbl">Dashboard</span>
      </div>
      <div class="mb-item" id="mn-profil" onclick="nav('profil',this)">
        <i data-lucide="user" style="width:14px;height:14px"></i><span class="lbl">Mon Profil</span>
      </div>
      <div class="mb-item" id="mn-historique" onclick="nav('historique',this)">
        <i data-lucide="history" style="width:14px;height:14px"></i><span class="lbl">Historiques</span>
        <span style="width:5px;height:5px;border-radius:50%;background:var(--blue);margin-left:auto;flex-shrink:0;display:block"></span>
      </div>

      <div style="height:1px;background:var(--border);margin:6px 0"></div>

      <div class="mb-sec">Gestion Entreprise <i data-lucide="chevron-down" class="arr open" style="width:10px;height:10px"></i></div>
      <div class="mb-item" id="mn-repertoire" onclick="nav('repertoire',this)">
        <i data-lucide="book-open" style="width:14px;height:14px"></i><span class="lbl">Répertoire</span>
      </div>
      <div class="mb-item" id="mn-infos" onclick="nav('infos',this)">
        <i data-lucide="info" style="width:14px;height:14px"></i><span class="lbl">Infos générales</span>
      </div>
      <div class="mb-item active" id="mn-employes" onclick="nav('employes',this)">
        <i data-lucide="users" style="width:14px;height:14px"></i><span class="lbl">Employés</span>
        <span class="mb-badge" id="emp-badge">0</span>
      </div>
      <div class="mb-item" id="mn-postes" onclick="nav('postes',this)">
        <i data-lucide="briefcase" style="width:14px;height:14px"></i><span class="lbl">Postes</span>
      </div>
      <div class="mb-item" id="mn-structures" onclick="nav('structures',this)">
        <i data-lucide="network" style="width:14px;height:14px"></i><span class="lbl">Structures</span>
      </div>
      <div class="mb-item" id="mn-organigramme" onclick="nav('organigramme',this)">
        <i data-lucide="git-branch" style="width:14px;height:14px"></i><span class="lbl">Organigramme</span>
      </div>
      <div class="mb-item" id="mn-modeles" onclick="nav('modeles',this)">
        <i data-lucide="layout-template" style="width:14px;height:14px"></i><span class="lbl">Modèles</span>
      </div>
      <div class="mb-item" id="mn-configuration" onclick="nav('configuration',this)">
        <i data-lucide="sliders-horizontal" style="width:14px;height:14px"></i><span class="lbl">Configuration</span>
      </div>

      <div style="height:1px;background:var(--border);margin:6px 0"></div>

      <div class="mb-sec">Actions Rapides <i data-lucide="chevron-down" class="arr open" style="width:10px;height:10px"></i></div>
      <div class="mb-qa" onclick="openModal('modal-emp')">
        <div class="qa-ic" style="background:var(--blue-bg)"><i data-lucide="user-plus" style="width:12px;height:12px;stroke:var(--blue)"></i></div>
        <span style="color:var(--blue);font-size:.78rem">Ajout employé</span>
      </div>
      <div class="mb-qa" onclick="openModal('modal-poste')">
        <div class="qa-ic" style="background:var(--purple-bg)"><i data-lucide="plus-circle" style="width:12px;height:12px;stroke:var(--purple)"></i></div>
        <span style="color:var(--purple);font-size:.78rem">Ajout poste</span>
      </div>
      <div class="mb-qa" onclick="openModal('modal-struct')">
        <div class="qa-ic" style="background:var(--green-bg)"><i data-lucide="plus-square" style="width:12px;height:12px;stroke:var(--green)"></i></div>
        <span style="color:var(--green);font-size:.78rem">Ajout structure</span>
      </div>

      <div style="height:1px;background:var(--border);margin:6px 0"></div>

      <div class="mb-sec">Paramètres</div>
      <div class="mb-item" id="mn-parametres" onclick="nav('parametres',this)">
        <i data-lucide="settings" style="width:14px;height:14px"></i><span class="lbl">Modifier le profil</span>
      </div>
    </div>
    <div class="mb-footer">
      <form method="POST" action="{{ route('logout') }}" style="margin:0">
        @csrf
        <button type="submit" class="mb-logout">
          <i data-lucide="log-out" style="width:13px;height:13px"></i> Déconnexion
        </button>
      </form>
    </div>
  </div>

  <!-- PAYROLL -->
  <div id="sm-payroll" style="display:none">
    <div class="mb-head">
      <div class="mb-title"><div class="mb-icon" style="background:var(--green-bg)"><i data-lucide="credit-card" style="width:12px;height:12px;stroke:var(--green)"></i></div>Payroll</div>
      <button class="mb-toggle" onclick="toggleMenu()"><i data-lucide="chevron-left" style="width:11px;height:11px"></i></button>
    </div>
    <div class="mb-nav">
      <div class="mb-item active" id="mn-paie" onclick="nav('paie',this)"><i data-lucide="layout-dashboard" style="width:14px;height:14px"></i><span class="lbl">Tableau de bord</span></div>
      <div class="mb-item" onclick="nav('employes',this)"><i data-lucide="users" style="width:14px;height:14px"></i><span class="lbl">Employés</span></div>
      <div class="mb-item" onclick="nav('paie',this)"><i data-lucide="file-text" style="width:14px;height:14px"></i><span class="lbl">Bulletins de paie</span></div>
      <div class="mb-item" onclick="nav('paie',this)"><i data-lucide="calculator" style="width:14px;height:14px"></i><span class="lbl">Éléments de rémunération</span></div>
      <div class="mb-item" onclick="nav('paie',this)"><i data-lucide="book-open" style="width:14px;height:14px"></i><span class="lbl">Conventions collectives</span></div>
      <div class="mb-item" onclick="nav('paie',this)"><i data-lucide="landmark" style="width:14px;height:14px"></i><span class="lbl">Comptes comptables</span></div>
    </div>
  </div>

  <!-- CONGÉS -->
  <div id="sm-conges" style="display:none">
    <div class="mb-head">
      <div class="mb-title"><div class="mb-icon" style="background:var(--orange-bg)"><i data-lucide="calendar-days" style="width:12px;height:12px;stroke:var(--orange)"></i></div>Congés</div>
      <button class="mb-toggle" onclick="toggleMenu()"><i data-lucide="chevron-left" style="width:11px;height:11px"></i></button>
    </div>
    <div class="mb-nav">
      <div class="mb-item active" id="mn-conges" onclick="nav('conges',this)"><i data-lucide="calendar" style="width:14px;height:14px"></i><span class="lbl">Accueil</span></div>
      <div class="mb-item" onclick="nav('conges',this)"><i data-lucide="calendar-days" style="width:14px;height:14px"></i><span class="lbl">Congé</span><span class="mb-badge o" id="cg-side-badge">0</span></div>
      <div class="mb-item" onclick="nav('conges',this)"><i data-lucide="receipt" style="width:14px;height:14px"></i><span class="lbl">Note de Frais</span></div>
      <div class="mb-item" onclick="nav('conges',this)"><i data-lucide="trending-up" style="width:14px;height:14px"></i><span class="lbl">Avance sur Salaire</span></div>
      <div class="mb-item" onclick="nav('employes',this)"><i data-lucide="users" style="width:14px;height:14px"></i><span class="lbl">Employés</span></div>
      <div class="mb-item" onclick="nav('parametres',this)"><i data-lucide="settings" style="width:14px;height:14px"></i><span class="lbl">Paramètres</span></div>
      <div class="mb-item" onclick="nav('conges',this)"><i data-lucide="git-branch" style="width:14px;height:14px"></i><span class="lbl">Workflow</span></div>
      <div class="mb-item" onclick="nav('parametres',this)"><i data-lucide="shield" style="width:14px;height:14px"></i><span class="lbl">Gestion des accès</span></div>
    </div>
  </div>

  <!-- ANALYTICS -->
  <div id="sm-analytics" style="display:none">
    <div class="mb-head">
      <div class="mb-title"><div class="mb-icon" style="background:rgba(6,182,212,.15)"><i data-lucide="bar-chart-2" style="width:12px;height:12px;stroke:var(--cyan)"></i></div>Analytics</div>
      <button class="mb-toggle" onclick="toggleMenu()"><i data-lucide="chevron-left" style="width:11px;height:11px"></i></button>
    </div>
    <div class="mb-nav">
      <div class="mb-item active" id="mn-indicateurs" onclick="nav('indicateurs',this)"><i data-lucide="trending-up" style="width:14px;height:14px"></i><span class="lbl">Indicateurs RH</span></div>
      <div class="mb-item" onclick="nav('presences',this)"><i data-lucide="clock" style="width:14px;height:14px"></i><span class="lbl">Présences</span></div>
      <div class="mb-item" onclick="nav('indicateurs',this)"><i data-lucide="pie-chart" style="width:14px;height:14px"></i><span class="lbl">Répartition contrats</span></div>
    </div>
  </div>

  <!-- RECRUTEMENT -->
  <div id="sm-recrutement" style="display:none">
    <div class="mb-head">
      <div class="mb-title"><div class="mb-icon" style="background:var(--purple-bg)"><i data-lucide="briefcase" style="width:12px;height:12px;stroke:var(--purple)"></i></div>Recrutement</div>
      <button class="mb-toggle" onclick="toggleMenu()"><i data-lucide="chevron-left" style="width:11px;height:11px"></i></button>
    </div>
    <div class="mb-nav">
      <div class="mb-sec">Gestion et Suivi</div>
      <div class="mb-item active" id="mn-recrutement" onclick="nav('recrutement',this)"><i data-lucide="inbox" style="width:14px;height:14px"></i><span class="lbl">Candidatures</span><span class="mb-badge p" id="cand-side-badge">0</span></div>
      <div class="mb-item" onclick="nav('recrutement',this)"><i data-lucide="filter" style="width:14px;height:14px"></i><span class="lbl">Critères d'évaluation</span></div>
      <div class="mb-sec">Paramétrage</div>
      <div class="mb-item" onclick="nav('recrutement',this)"><i data-lucide="building-2" style="width:14px;height:14px"></i><span class="lbl">Mon organisation</span></div>
      <div class="mb-item" onclick="nav('recrutement',this)"><i data-lucide="mail" style="width:14px;height:14px"></i><span class="lbl">Modèles d'email</span></div>
      <div class="mb-item" onclick="nav('recrutement',this)"><i data-lucide="git-merge" style="width:14px;height:14px"></i><span class="lbl">Pipelines candidatures</span></div>
      <div class="mb-item" onclick="nav('recrutement',this)"><i data-lucide="users" style="width:14px;height:14px"></i><span class="lbl">Gestion des utilisateurs</span></div>
    </div>
  </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main-wrap" id="main-wrap">

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="tb-bc">
      <span id="tb-module" onclick="nav('dashboard',null)">Workspace</span>
      <span class="sep">›</span>
      <span id="tb-section">Gestion entreprise</span>
      <span class="sep">›</span>
      <span class="cur" id="tb-page">Employés</span>
    </div>
    <div class="tb-search">
      <i data-lucide="search" style="width:12px;height:12px;stroke:var(--text3);flex-shrink:0"></i>
      <input type="text" placeholder="Tapez ici votre recherche..." oninput="globalSearch(this.value)">
    </div>
    <div class="tb-right">
      <!-- Notifs -->
      <div style="position:relative">
        <button class="tb-btn" onclick="toggleNotif()">
          <i data-lucide="bell" style="width:13px;height:13px"></i>
          <span class="tb-nb" id="notif-badge">2</span>
        </button>
        <div class="notif-panel" id="notif-panel">
          <div class="np-head"><span class="np-t">Notifications</span><span class="np-clear" onclick="clearNotifs()">Tout lire</span></div>
          <div id="notif-list"></div>
        </div>
      </div>
      <!-- Theme toggle -->
      <button class="tb-btn" onclick="toggleTheme()" title="Changer de thème">
        <i data-lucide="sun" style="width:13px;height:13px" id="theme-icon-tb"></i>
      </button>
      <!-- Profile -->
      <div style="position:relative">
        <div class="tb-prof" onclick="toggleProfile(event)" id="prof-btn">
          <div class="tb-pav">{{ $init }}</div>
          <div class="tb-pname">{{ $u->name ?? 'Admin' }}</div>
          <i data-lucide="chevron-down" style="width:11px;height:11px;stroke:var(--text3)"></i>
        </div>
        <div class="dropdown" id="prof-drop">
          <div class="dd-item" onclick="nav('profil',null)"><i data-lucide="user" style="width:12px;height:12px"></i> Mon profil</div>
          <div class="dd-item" onclick="nav('parametres',null)"><i data-lucide="settings" style="width:12px;height:12px"></i> Paramètres</div>
          <div class="dd-item" onclick="toggleTheme()"><i data-lucide="sun" style="width:12px;height:12px" id="theme-dd-icon"></i> <span id="theme-dd-label">Mode clair</span></div>
          <div class="dd-sep"></div>
          <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="dd-item danger" style="width:100%;background:none;border:none;cursor:pointer;font-family:var(--font);text-align:left;display:flex;align-items:center;gap:8px;padding:6px 10px;border-radius:var(--r);font-size:.78rem;color:var(--text2);">
              <i data-lucide="log-out" style="width:12px;height:12px"></i> Déconnexion
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <!-- ══ PAGES ══ -->
  <div class="content">

    <!-- DASHBOARD -->
    <div class="page active" id="page-dashboard">
      <div class="pg-head">
        <div class="pg-hl">
          <div class="pg-title">Tableau de bord</div>
          <div class="pg-sub">Bonjour {{ $u->name ?? 'Administrateur' }} 👋 — Vue d'ensemble de votre entreprise</div>
        </div>
        <div style="display:flex;gap:7px">
          <button class="btn btn-ghost btn-sm"><i data-lucide="download" style="width:11px;height:11px"></i> Exporter</button>
          <button class="btn btn-primary btn-sm" onclick="openModal('modal-emp')"><i data-lucide="plus" style="width:11px;height:11px"></i> Créer un employé</button>
        </div>
      </div>
      <div class="stats-grid">
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--blue-bg)"><i data-lucide="users" style="width:15px;height:15px;stroke:var(--blue)"></i></div><span class="stat-ch up"><i data-lucide="trending-up" style="width:9px;height:9px"></i>+2</span></div><div class="stat-val" id="s-total">0</div><div class="stat-lbl">Employés actifs</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--green-bg)"><i data-lucide="check-circle" style="width:15px;height:15px;stroke:var(--green)"></i></div><span class="stat-ch up"><i data-lucide="trending-up" style="width:9px;height:9px"></i>Auj.</span></div><div class="stat-val" id="s-presents">0</div><div class="stat-lbl">Présents</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--orange-bg)"><i data-lucide="calendar-days" style="width:15px;height:15px;stroke:var(--orange)"></i></div><span class="stat-ch neu">En cours</span></div><div class="stat-val" id="s-conges">0</div><div class="stat-lbl">Congés approuvés</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--purple-bg)"><i data-lucide="inbox" style="width:15px;height:15px;stroke:var(--purple)"></i></div><span class="stat-ch up"><i data-lucide="trending-up" style="width:9px;height:9px"></i>Récent</span></div><div class="stat-val" id="s-cand">0</div><div class="stat-lbl">Candidatures</div></div>
      </div>
      <div class="g21">
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="bar-chart-2" style="width:13px;height:13px;stroke:var(--blue)"></i>Présences — 7 jours</span></div><div class="card-body"><div class="bar-chart" id="dash-chart"></div><div class="chart-axis"></div></div></div>
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="pie-chart" style="width:13px;height:13px;stroke:var(--cyan)"></i>Contrats</span></div><div class="card-body" id="contrats-chart"></div></div>
      </div>
      <div class="g2">
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="clock" style="width:13px;height:13px;stroke:var(--orange)"></i>Congés en attente</span><span class="badge bo" id="cg-dash-badge">0</span></div><div class="card-body" style="padding:8px 10px" id="cg-dash-list"></div></div>
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="inbox" style="width:13px;height:13px;stroke:var(--purple)"></i>Candidatures récentes</span><button class="btn btn-ghost btn-sm" onclick="nav('recrutement',null)">Voir tout →</button></div><div><table class="dt"><thead><tr><th>Candidat</th><th>Poste</th><th>Date</th><th>Statut</th></tr></thead><tbody id="cand-dash-tb"></tbody></table></div></div>
      </div>
    </div>

    <!-- EMPLOYÉS -->
    <div class="page" id="page-employes">
      <div class="pg-head">
        <div class="pg-hl">
          <div class="pg-title">Employés <span class="pg-count" id="emp-pg-count">0</span></div>
          <div class="pg-sub">Consultez la liste complète des employés de votre entreprise. Utilisez les filtres pour trouver rapidement une personne.</div>
        </div>
        <div style="display:flex;gap:7px">
          <button class="btn btn-ghost btn-sm"><i data-lucide="upload" style="width:11px;height:11px"></i> Ajout en masse</button>
          <button class="btn btn-primary" onclick="openModal('modal-emp')"><i data-lucide="plus" style="width:12px;height:12px"></i> Créer un employé</button>
        </div>
      </div>
      <div class="pg-tabs">
        <button class="pg-tab active" id="tab-employes">Employés</button>
        <button class="pg-tab" id="tab-sanctions">Sanctions</button>
      </div>
      <div class="card">
        <div class="tbar">
          <div class="tbar-l">
            <div class="t-search"><i data-lucide="search" style="width:11px;height:11px;stroke:var(--text3)"></i><input type="text" placeholder="Rechercher ici" oninput="filterEmp(this.value)"></div>
            <button class="t-filter"><i data-lucide="briefcase" style="width:11px;height:11px"></i>Poste<i data-lucide="chevron-down" style="width:10px;height:10px"></i></button>
            <button class="t-filter"><i data-lucide="network" style="width:11px;height:11px"></i>Structure<i data-lucide="chevron-down" style="width:10px;height:10px"></i></button>
            <button class="t-filter"><i data-lucide="activity" style="width:11px;height:11px"></i>Statut<i data-lucide="chevron-down" style="width:10px;height:10px"></i></button>
          </div>
          <div class="tbar-r">
            <button class="tool-btn" title="Calendrier"><i data-lucide="calendar" style="width:12px;height:12px"></i></button>
            <button class="tool-btn" title="Supprimer sélection" onclick="delSelected()"><i data-lucide="trash-2" style="width:12px;height:12px"></i></button>
            <div class="view-tgl">
              <div class="vt-btn active"><i data-lucide="list" style="width:12px;height:12px"></i></div>
              <div class="vt-btn"><i data-lucide="layout-grid" style="width:12px;height:12px"></i></div>
            </div>
            <span style="font-size:.72rem;color:var(--text2);display:flex;align-items:center;gap:3px;cursor:pointer">Vue tableau<i data-lucide="chevron-down" style="width:10px;height:10px"></i></span>
          </div>
        </div>
        <div class="tw">
          <table class="dt">
            <thead>
              <tr>
                <th style="width:30px"><input type="checkbox" class="cb" id="cb-all" onchange="toggleAll(this)"></th>
                <th><span class="sort">Nom <i data-lucide="chevrons-up-down" style="width:9px;height:9px"></i></span></th>
                <th><span class="sort">Matricule <i data-lucide="chevrons-up-down" style="width:9px;height:9px"></i></span></th>
                <th><span class="sort">Durée de suspension <i data-lucide="chevrons-up-down" style="width:9px;height:9px"></i></span></th>
                <th><span class="sort">Email <i data-lucide="chevrons-up-down" style="width:9px;height:9px"></i></span></th>
                <th><span class="sort">Structure <i data-lucide="chevrons-up-down" style="width:9px;height:9px"></i></span></th>
                <th>Statut</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="emp-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- PRÉSENCES -->
    <div class="page" id="page-presences">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Présences & Absences</div><div class="pg-sub">Suivi quotidien des présences de votre équipe</div></div>
        <div style="display:flex;gap:7px">
          <input type="date" class="fc" id="pres-date" style="width:148px" onchange="renderPresences()">
          <button class="btn btn-primary" onclick="openModal('modal-pres')"><i data-lucide="plus" style="width:11px;height:11px"></i> Enregistrer</button>
        </div>
      </div>
      <div class="stats-grid">
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--green-bg)"><i data-lucide="check" style="width:15px;height:15px;stroke:var(--green)"></i></div></div><div class="stat-val" id="p-p">0</div><div class="stat-lbl">Présents</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--red-bg)"><i data-lucide="x" style="width:15px;height:15px;stroke:var(--red)"></i></div></div><div class="stat-val" id="p-a">0</div><div class="stat-lbl">Absents</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--orange-bg)"><i data-lucide="calendar" style="width:15px;height:15px;stroke:var(--orange)"></i></div></div><div class="stat-val" id="p-c">0</div><div class="stat-lbl">En congé</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--purple-bg)"><i data-lucide="clock" style="width:15px;height:15px;stroke:var(--purple)"></i></div></div><div class="stat-val" id="p-r">0</div><div class="stat-lbl">Retards</div></div>
      </div>
      <div class="card">
        <div class="tw">
          <table class="dt">
            <thead><tr><th><input type="checkbox" class="cb"></th><th>Employé</th><th>Date</th><th>Arrivée</th><th>Départ</th><th>Heures</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody id="pres-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- CONGÉS -->
    <div class="page" id="page-conges">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Gestion des Congés</div><div class="pg-sub">Demandes, validation et calendrier des absences</div></div>
        <div style="display:flex;gap:7px"><button class="btn btn-primary" onclick="openModal('modal-cg')"><i data-lucide="plus" style="width:11px;height:11px"></i> Nouvelle demande</button></div>
      </div>
      <div class="g2">
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="clock" style="width:13px;height:13px;stroke:var(--orange)"></i>En attente de validation</span><span class="badge bo" id="cg-att-count">0</span></div><div class="card-body" style="padding:8px 10px" id="cg-att-list"></div></div>
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="history" style="width:13px;height:13px;stroke:var(--green)"></i>Historique</span></div><div><table class="dt"><thead><tr><th>Employé</th><th>Période</th><th>Type</th><th>Statut</th></tr></thead><tbody id="cg-hist"></tbody></table></div></div>
      </div>
    </div>

    <!-- PAIE -->
    <div class="page" id="page-paie">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Gestion de la Paie</div><div class="pg-sub">Bulletins de salaire et éléments de rémunération</div></div>
        <div style="display:flex;gap:7px">
          <select class="fc" style="width:148px"><option>Avril 2025</option><option>Mars 2025</option><option>Février 2025</option></select>
          <button class="btn btn-primary"><i data-lucide="zap" style="width:11px;height:11px"></i> Générer bulletins</button>
        </div>
      </div>
      <div class="card">
        <div class="tw">
          <table class="dt">
            <thead><tr><th><input type="checkbox" class="cb"></th><th>Employé</th><th>Poste</th><th>Salaire brut</th><th>Cotisations</th><th>Net à payer</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody id="paie-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- INDICATEURS -->
    <div class="page" id="page-indicateurs">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Indicateurs RH</div><div class="pg-sub">ETP, EMM, EMA, taux d'absentéisme et de présence</div></div></div>
      <div class="kpi-grid">
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--blue-bg)"><i data-lucide="users" style="width:15px;height:15px;stroke:var(--blue)"></i></div><div class="kpi-name">ETP — Équivalent Temps Plein</div><div class="kpi-formula">H. réelles / H. théoriques</div><div class="kpi-val" id="kpi-etp">—</div><div class="kpi-def">Mesure la main d'œuvre disponible en unités de temps complet.</div></div>
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--orange-bg)"><i data-lucide="calendar" style="width:15px;height:15px;stroke:var(--orange)"></i></div><div class="kpi-name">EMM — Effectif Moyen Mensuel</div><div class="kpi-formula">(Eff. début + Eff. fin) / 2</div><div class="kpi-val" id="kpi-emm">—</div><div class="kpi-def">Base de calcul des ratios RH sur le mois.</div></div>
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--green-bg)"><i data-lucide="bar-chart" style="width:15px;height:15px;stroke:var(--green)"></i></div><div class="kpi-name">EMA — Effectif Moyen Annuel</div><div class="kpi-formula">Σ EMM / 12</div><div class="kpi-val" id="kpi-ema">—</div><div class="kpi-def">Vision annuelle pour la planification budgétaire.</div></div>
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--red-bg)"><i data-lucide="percent" style="width:15px;height:15px;stroke:var(--red)"></i></div><div class="kpi-name">Taux d'absentéisme</div><div class="kpi-formula">(Abs. / H. théo.) × 100</div><div class="kpi-val" id="kpi-abs">—</div><div class="kpi-def">Impact des absences sur la productivité.</div></div>
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--purple-bg)"><i data-lucide="trending-up" style="width:15px;height:15px;stroke:var(--purple)"></i></div><div class="kpi-name">Taux de présence</div><div class="kpi-formula">(Présents / Effectif) × 100</div><div class="kpi-val" id="kpi-pres">—</div><div class="kpi-def">% d'employés présents sur la période.</div></div>
        <div class="kpi-card"><div class="kpi-ic" style="background:var(--orange-bg)"><i data-lucide="refresh-cw" style="width:15px;height:15px;stroke:var(--orange)"></i></div><div class="kpi-name">Taux de turnover</div><div class="kpi-formula">(Départs / EMM) × 100</div><div class="kpi-val" id="kpi-turn">2.4%</div><div class="kpi-def">Rotation du personnel sur la période.</div></div>
      </div>
      <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="bar-chart-2" style="width:13px;height:13px;stroke:var(--blue)"></i>Évolution mensuelle des effectifs</span></div><div class="card-body"><div class="bar-chart" id="eff-chart"></div><div class="chart-axis"></div></div></div>
    </div>

    <!-- RECRUTEMENT -->
    <div class="page" id="page-recrutement">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Candidatures <span class="pg-count" id="cand-pg-count">0</span></div><div class="pg-sub">Candidatures reçues via le portail public de recrutement</div></div>
      </div>
      <div class="stats-grid">
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--blue-bg)"><i data-lucide="inbox" style="width:15px;height:15px;stroke:var(--blue)"></i></div><span class="stat-ch neu">Total</span></div><div class="stat-val" id="sc-total">0</div><div class="stat-lbl">Candidatures</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--orange-bg)"><i data-lucide="clock" style="width:15px;height:15px;stroke:var(--orange)"></i></div><span class="stat-ch neu">Cours</span></div><div class="stat-val" id="sc-cours">0</div><div class="stat-lbl">En analyse</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--green-bg)"><i data-lucide="check-circle" style="width:15px;height:15px;stroke:var(--green)"></i></div><span class="stat-ch up">OK</span></div><div class="stat-val" id="sc-ret">0</div><div class="stat-lbl">Retenues</div></div>
        <div class="stat-card"><div class="stat-top"><div class="stat-ic" style="background:var(--red-bg)"><i data-lucide="x-circle" style="width:15px;height:15px;stroke:var(--red)"></i></div><span class="stat-ch down">KO</span></div><div class="stat-val" id="sc-ref">0</div><div class="stat-lbl">Refusées</div></div>
      </div>
      <div class="card">
        <div class="tw">
          <table class="dt">
            <thead><tr><th><input type="checkbox" class="cb"></th><th>Candidat</th><th>Poste visé</th><th>Contrat</th><th>Date</th><th>Documents</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody id="cand-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ORGANIGRAMME -->
    <div class="page" id="page-organigramme">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Organigramme</div><div class="pg-sub">Structure hiérarchique de l'entreprise</div></div></div>
      <div class="card">
        <div class="card-body" style="padding:24px;overflow-x:auto">
          <div class="org-tree" id="org-tree"></div>
        </div>
      </div>
    </div>

    <!-- MON PROFIL -->
    <div class="page" id="page-profil">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Mon Profil</div><div class="pg-sub">Informations personnelles et sécurité du compte</div></div></div>
      <div class="g2">
        <div class="card">
          <div class="card-head"><span class="card-title"><i data-lucide="user" style="width:13px;height:13px;stroke:var(--blue)"></i>Informations personnelles</span></div>
          <div class="card-body">
            <div class="fg2" style="grid-template-columns:1fr">
              <div class="fg"><label class="fl">Nom complet</label><input class="fc" value="{{ $u->name ?? '' }}"></div>
              <div class="fg"><label class="fl">Email</label><input class="fc" type="email" value="{{ $u->email ?? '' }}"></div>
              <div class="fg"><label class="fl">Téléphone</label><input class="fc" placeholder="+221 77 000 00 00"></div>
              <div class="fg"><label class="fl">Rôle</label><input class="fc" value="Administrateur RH" disabled></div>
              <button class="btn btn-primary btn-sm" onclick="showToast('Profil mis à jour !','success')"><i data-lucide="save" style="width:11px;height:11px"></i> Enregistrer</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><span class="card-title"><i data-lucide="shield" style="width:13px;height:13px;stroke:var(--blue)"></i>Sécurité</span></div>
          <div class="card-body">
            <div class="fg2" style="grid-template-columns:1fr">
              <div class="fg"><label class="fl">Mot de passe actuel</label><input class="fc" type="password" placeholder="••••••••"></div>
              <div class="fg"><label class="fl">Nouveau mot de passe</label><input class="fc" type="password" placeholder="••••••••"></div>
              <div class="fg"><label class="fl">Confirmer</label><input class="fc" type="password" placeholder="••••••••"></div>
              <button class="btn btn-primary btn-sm" onclick="showToast('Mot de passe modifié !','success')"><i data-lucide="lock" style="width:11px;height:11px"></i> Changer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PARAMÈTRES -->
    <div class="page" id="page-parametres">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Paramètres</div><div class="pg-sub">Configuration de votre espace Societas GRH</div></div></div>
      <div class="g2">
        <div class="card">
          <div class="card-head"><span class="card-title"><i data-lucide="palette" style="width:13px;height:13px;stroke:var(--blue)"></i>Apparence</span></div>
          <div class="card-body">
            <div class="fg" style="margin-bottom:14px"><label class="fl">Thème de l'interface</label>
              <div style="display:flex;gap:8px;margin-top:6px">
                <button class="btn btn-ghost btn-sm" id="btn-dark" onclick="setTheme('dark')"><i data-lucide="moon" style="width:11px;height:11px"></i> Sombre</button>
                <button class="btn btn-ghost btn-sm" id="btn-light" onclick="setTheme('light')"><i data-lucide="sun" style="width:11px;height:11px"></i> Clair</button>
              </div>
            </div>
            <div class="fg"><label class="fl">Sidebar</label>
              <div style="display:flex;gap:8px;margin-top:6px">
                <button class="btn btn-ghost btn-sm" onclick="setSidebar(false)">Menu complet</button>
                <button class="btn btn-ghost btn-sm" onclick="setSidebar(true)">Menu compact</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><span class="card-title"><i data-lucide="bell" style="width:13px;height:13px;stroke:var(--blue)"></i>Notifications</span></div>
          <div class="card-body">
            <div style="display:flex;flex-direction:column;gap:12px">
              <div style="display:flex;align-items:center;justify-content:space-between"><span style="font-size:.8rem;font-weight:600">Nouvelles candidatures</span><input type="checkbox" class="cb" checked></div>
              <div style="display:flex;align-items:center;justify-content:space-between"><span style="font-size:.8rem;font-weight:600">Demandes de congés</span><input type="checkbox" class="cb" checked></div>
              <div style="display:flex;align-items:center;justify-content:space-between"><span style="font-size:.8rem;font-weight:600">Absences injustifiées</span><input type="checkbox" class="cb" checked></div>
              <button class="btn btn-primary btn-sm" onclick="showToast('Préférences sauvegardées !','success')"><i data-lucide="save" style="width:11px;height:11px"></i> Sauvegarder</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGES SIMPLES AVEC CONTENU -->
    <div class="page" id="page-historique">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Historiques</div><div class="pg-sub">Journal des actions effectuées sur la plateforme</div></div></div>
      <div class="card">
        <div class="tw">
          <table class="dt">
            <thead><tr><th>Date</th><th>Utilisateur</th><th>Action</th><th>Cible</th><th>Détail</th></tr></thead>
            <tbody id="histo-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="page" id="page-repertoire">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Répertoire</div><div class="pg-sub">Annuaire des collaborateurs de l'entreprise</div></div></div>
      <div class="card">
        <div class="tw"><table class="dt"><thead><tr><th>Nom</th><th>Poste</th><th>Structure</th><th>Email</th><th>Téléphone</th></tr></thead><tbody id="rep-tbody"></tbody></table></div>
      </div>
    </div>

    <div class="page" id="page-infos">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Infos générales</div><div class="pg-sub">Informations de l'entreprise</div></div></div>
      <div class="card">
        <div class="card-body">
          <div class="fg2">
            <div class="fg"><label class="fl">Nom de l'entreprise</label><input class="fc" value="Societas GRH SAS" placeholder="Nom entreprise"></div>
            <div class="fg"><label class="fl">NINEA</label><input class="fc" value="12345678901" placeholder="NINEA"></div>
            <div class="fg"><label class="fl">Téléphone</label><input class="fc" value="+221 33 000 00 00" placeholder="Téléphone"></div>
            <div class="fg"><label class="fl">Email RH</label><input class="fc" value="rh@societas-grh.sn" placeholder="Email"></div>
            <div class="fg full"><label class="fl">Adresse</label><input class="fc" value="123 Avenue Bourguiba, Dakar, Sénégal" placeholder="Adresse"></div>
            <div class="fg full" style="justify-self:start"><button class="btn btn-primary btn-sm" onclick="showToast('Infos sauvegardées !','success')"><i data-lucide="save" style="width:11px;height:11px"></i> Enregistrer</button></div>
          </div>
        </div>
      </div>
    </div>

    <div class="page" id="page-postes">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Postes <span class="pg-count" id="postes-count">0</span></div><div class="pg-sub">Gestion des postes de l'entreprise</div></div>
        <button class="btn btn-primary" onclick="openModal('modal-poste')"><i data-lucide="plus" style="width:12px;height:12px"></i> Ajouter un poste</button>
      </div>
      <div class="card"><div class="tw"><table class="dt"><thead><tr><th>Intitulé</th><th>Structure</th><th>Employés</th><th>Actions</th></tr></thead><tbody id="postes-tbody"></tbody></table></div></div>
    </div>

    <div class="page" id="page-structures">
      <div class="pg-head">
        <div class="pg-hl"><div class="pg-title">Structures <span class="pg-count" id="structs-count">0</span></div><div class="pg-sub">Départements et structures de l'entreprise</div></div>
        <button class="btn btn-primary" onclick="openModal('modal-struct')"><i data-lucide="plus" style="width:12px;height:12px"></i> Ajouter une structure</button>
      </div>
      <div class="card"><div class="tw"><table class="dt"><thead><tr><th>Nom</th><th>Responsable</th><th>Effectif</th><th>Actions</th></tr></thead><tbody id="structs-tbody"></tbody></table></div></div>
    </div>

    <div class="page" id="page-modeles">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Modèles</div><div class="pg-sub">Modèles de documents RH</div></div></div>
      <div class="g3">
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--blue)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Contrat CDI</div><div style="font-size:.74rem;color:var(--text2)">Modèle Word</div></div></div>
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--green)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Contrat CDD</div><div style="font-size:.74rem;color:var(--text2)">Modèle Word</div></div></div>
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--orange)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Lettre de mission</div><div style="font-size:.74rem;color:var(--text2)">Modèle Word</div></div></div>
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--purple)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Attestation de travail</div><div style="font-size:.74rem;color:var(--text2)">Modèle Word</div></div></div>
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--red)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Lettre de licenciement</div><div style="font-size:.74rem;color:var(--text2)">Modèle Word</div></div></div>
        <div class="card" style="cursor:pointer" onclick="showToast('Modèle téléchargé','info')"><div class="card-body" style="text-align:center;padding:24px"><i data-lucide="file-text" style="width:28px;height:28px;display:block;margin:0 auto 10px;stroke:var(--cyan)"></i><div style="font-weight:700;font-size:.84rem;margin-bottom:4px">Bulletin de paie</div><div style="font-size:.74rem;color:var(--text2)">Modèle Excel</div></div></div>
      </div>
    </div>

    <div class="page" id="page-configuration">
      <div class="pg-head"><div class="pg-hl"><div class="pg-title">Configuration</div><div class="pg-sub">Paramètres avancés du système</div></div></div>
      <div class="g2">
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="building-2" style="width:13px;height:13px;stroke:var(--blue)"></i>Paramètres RH</span></div><div class="card-body"><div class="fg2" style="grid-template-columns:1fr"><div class="fg"><label class="fl">Jours ouvrables / semaine</label><select class="fc"><option>5 jours (Lun-Ven)</option><option>6 jours (Lun-Sam)</option></select></div><div class="fg"><label class="fl">Heures / jour</label><input class="fc" type="number" value="8"></div><div class="fg"><label class="fl">Congés annuels (jours)</label><input class="fc" type="number" value="30"></div><button class="btn btn-primary btn-sm" onclick="showToast('Configuration sauvegardée !','success')"><i data-lucide="save" style="width:11px;height:11px"></i> Sauvegarder</button></div></div></div>
        <div class="card"><div class="card-head"><span class="card-title"><i data-lucide="percent" style="width:13px;height:13px;stroke:var(--blue)"></i>Cotisations sociales</span></div><div class="card-body"><div class="fg2" style="grid-template-columns:1fr"><div class="fg"><label class="fl">CNSS employé (%)</label><input class="fc" type="number" value="4" step="0.01"></div><div class="fg"><label class="fl">IPRES employé (%)</label><input class="fc" type="number" value="6" step="0.01"></div><div class="fg"><label class="fl">CNSS patronal (%)</label><input class="fc" type="number" value="7" step="0.01"></div><div class="fg"><label class="fl">IPRES patronal (%)</label><input class="fc" type="number" value="3.6" step="0.01"></div><button class="btn btn-primary btn-sm" onclick="showToast('Taux mis à jour !','success')"><i data-lucide="save" style="width:11px;height:11px"></i> Enregistrer</button></div></div></div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main-wrap -->

<!-- ══ MODALS ══ -->

<!-- Employé -->
<div class="overlay" id="modal-emp">
  <div class="modal">
    <div class="modal-head"><span class="modal-title" id="emp-modal-title">Créer un employé</span><button class="modal-close" onclick="closeModal('modal-emp')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body">
      <input type="hidden" id="emp-id">
      <div class="fg2">
        <div class="fg"><label class="fl">Prénom *</label><input class="fc" id="emp-prenom" placeholder="Amadou"></div>
        <div class="fg"><label class="fl">Nom *</label><input class="fc" id="emp-nom" placeholder="Diallo"></div>
        <div class="fg"><label class="fl">Email</label><input class="fc" id="emp-email" type="email"></div>
        <div class="fg"><label class="fl">Téléphone</label><input class="fc" id="emp-tel" placeholder="+221 77 000 00 00"></div>
        <div class="fg"><label class="fl">Poste *</label><input class="fc" id="emp-poste" placeholder="Comptable"></div>
        <div class="fg"><label class="fl">Structure</label><select class="fc" id="emp-dept"><option>Finance</option><option>RH</option><option>Technique</option><option>Commercial</option><option>Direction</option><option>Logistique</option><option>OPS</option><option>Product</option><option>Administration</option></select></div>
        <div class="fg"><label class="fl">Contrat</label><select class="fc" id="emp-contrat"><option>CDI</option><option>CDD</option><option>Intérim</option><option>Stage</option></select></div>
        <div class="fg"><label class="fl">Salaire brut (XOF)</label><input class="fc" id="emp-salaire" type="number" placeholder="500000"></div>
        <div class="fg"><label class="fl">Date d'embauche</label><input class="fc" id="emp-date" type="date"></div>
        <div class="fg"><label class="fl">Statut</label><select class="fc" id="emp-statut"><option>Actif</option><option>Inactif</option><option>Suspendu</option><option>Mis à pied</option><option>Démissionnaire</option><option>En congé</option></select></div>
      </div>
    </div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-emp')">Annuler</button><button class="btn btn-primary btn-sm" onclick="saveEmp()"><i data-lucide="save" style="width:11px;height:11px"></i> Enregistrer</button></div>
  </div>
</div>

<!-- Présence -->
<div class="overlay" id="modal-pres">
  <div class="modal">
    <div class="modal-head"><span class="modal-title">Enregistrer présence</span><button class="modal-close" onclick="closeModal('modal-pres')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body">
      <div class="fg2">
        <div class="fg"><label class="fl">Employé *</label><select class="fc" id="pr-emp"></select></div>
        <div class="fg"><label class="fl">Date *</label><input class="fc" id="pr-date" type="date"></div>
        <div class="fg"><label class="fl">Arrivée</label><input class="fc" id="pr-arr" type="time" value="08:00"></div>
        <div class="fg"><label class="fl">Départ</label><input class="fc" id="pr-dep" type="time" value="17:00"></div>
        <div class="fg"><label class="fl">Statut</label><select class="fc" id="pr-stat"><option>Présent</option><option>Absent</option><option>Retard</option><option>Congé</option></select></div>
        <div class="fg"><label class="fl">Note</label><input class="fc" id="pr-note" placeholder="Optionnel"></div>
      </div>
    </div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-pres')">Annuler</button><button class="btn btn-primary btn-sm" onclick="savePres()"><i data-lucide="save" style="width:11px;height:11px"></i> Enregistrer</button></div>
  </div>
</div>

<!-- Congé -->
<div class="overlay" id="modal-cg">
  <div class="modal">
    <div class="modal-head"><span class="modal-title">Nouvelle demande de congé</span><button class="modal-close" onclick="closeModal('modal-cg')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body">
      <div class="fg2">
        <div class="fg"><label class="fl">Employé *</label><select class="fc" id="cg-emp"></select></div>
        <div class="fg"><label class="fl">Type</label><select class="fc" id="cg-type"><option>Congé annuel</option><option>Congé maladie</option><option>Congé maternité</option><option>Congé sans solde</option><option>RTT</option></select></div>
        <div class="fg"><label class="fl">Date début *</label><input class="fc" id="cg-deb" type="date"></div>
        <div class="fg"><label class="fl">Date fin *</label><input class="fc" id="cg-fin" type="date"></div>
        <div class="fg full"><label class="fl">Motif</label><textarea class="fc" id="cg-motif" rows="2"></textarea></div>
      </div>
    </div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-cg')">Annuler</button><button class="btn btn-primary btn-sm" onclick="saveCg()"><i data-lucide="save" style="width:11px;height:11px"></i> Soumettre</button></div>
  </div>
</div>

<!-- Fiche Paie -->
<div class="overlay" id="modal-paie">
  <div class="modal modal-lg">
    <div class="modal-head"><span class="modal-title">Bulletin de Paie</span><button class="modal-close" onclick="closeModal('modal-paie')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body" id="paie-content"></div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-paie')">Fermer</button><button class="btn btn-primary btn-sm" onclick="printPaie()"><i data-lucide="printer" style="width:11px;height:11px"></i> Imprimer</button></div>
  </div>
</div>

<!-- Poste -->
<div class="overlay" id="modal-poste">
  <div class="modal" style="max-width:420px">
    <div class="modal-head"><span class="modal-title">Nouveau poste</span><button class="modal-close" onclick="closeModal('modal-poste')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body">
      <div class="fg2" style="grid-template-columns:1fr">
        <div class="fg"><label class="fl">Intitulé du poste *</label><input class="fc" id="poste-nom" placeholder="Directeur Financier"></div>
        <div class="fg"><label class="fl">Structure</label><select class="fc" id="poste-dept"><option>Finance</option><option>RH</option><option>Technique</option><option>Commercial</option><option>Direction</option><option>Logistique</option><option>OPS</option><option>Product</option></select></div>
        <div class="fg"><label class="fl">Description</label><textarea class="fc" id="poste-desc" rows="2" placeholder="Description du poste..."></textarea></div>
      </div>
    </div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-poste')">Annuler</button><button class="btn btn-primary btn-sm" onclick="savePoste()"><i data-lucide="save" style="width:11px;height:11px"></i> Créer</button></div>
  </div>
</div>

<!-- Structure -->
<div class="overlay" id="modal-struct">
  <div class="modal" style="max-width:420px">
    <div class="modal-head"><span class="modal-title">Nouvelle structure</span><button class="modal-close" onclick="closeModal('modal-struct')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body">
      <div class="fg2" style="grid-template-columns:1fr">
        <div class="fg"><label class="fl">Nom de la structure *</label><input class="fc" id="struct-nom" placeholder="Département Finance"></div>
        <div class="fg"><label class="fl">Responsable</label><select class="fc" id="struct-resp"></select></div>
      </div>
    </div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-struct')">Annuler</button><button class="btn btn-primary btn-sm" onclick="saveStruct()"><i data-lucide="save" style="width:11px;height:11px"></i> Créer</button></div>
  </div>
</div>

<!-- Confirm -->
<div class="overlay" id="modal-confirm">
  <div class="modal" style="max-width:340px">
    <div class="modal-head"><span class="modal-title" id="conf-title">Confirmer</span><button class="modal-close" onclick="closeModal('modal-confirm')"><i data-lucide="x" style="width:11px;height:11px"></i></button></div>
    <div class="modal-body"><p style="color:var(--text2);font-size:.8rem" id="conf-msg">Êtes-vous sûr ?</p></div>
    <div class="modal-foot"><button class="btn btn-ghost btn-sm" onclick="closeModal('modal-confirm')">Annuler</button><button class="btn btn-danger btn-sm" id="conf-btn">Confirmer</button></div>
  </div>
</div>

<div class="toast" id="toast"></div>
<div id="print-zone" style="display:none"></div>

<script>
// ══ DONNÉES ══
let employes=[
  {id:1,prenom:'Mamadou',         nom:'Bâ',    email:'mamadou.ba@email.com',     poste:'Dir. Financier',    dept:'Administration',contrat:'CDI',    sal:1500000,date:'2020-01-15',stat:'Actif',        susp:null},
  {id:2,prenom:'Mame Fatou',      nom:'Camara',email:'fatou.camara@email.com',    poste:'Responsable RH',    dept:'Finance',       contrat:'CDI',    sal:800000, date:'2021-03-01',stat:'Actif',        susp:null},
  {id:3,prenom:'Fatima',          nom:'Diagne',email:'fatima.diagne@email.com',   poste:'Commerciale',       dept:'Commercial',    contrat:'CDD',    sal:450000, date:'2023-06-01',stat:'Démissionnaire',susp:null},
  {id:4,prenom:'Etienne',         nom:'Imagu', email:'etienne.ima@email.com',     poste:'Dev Web',           dept:'Product',       contrat:'CDI',    sal:700000, date:'2022-09-01',stat:'Mis à pied',    susp:12},
  {id:5,prenom:'Mame Cheikh Ibra',nom:'Fall',  email:'cheikh.fall@email.com',     poste:'Chef Projet',       dept:'Product',       contrat:'CDI',    sal:900000, date:'2019-07-01',stat:'Actif',        susp:null},
  {id:6,prenom:'Bassirou',        nom:'Gueye', email:'bassirou.gueye@email.com',  poste:'Chef Logistique',   dept:'OPS',           contrat:'CDI',    sal:600000, date:'2019-07-01',stat:'En congé',     susp:3},
  {id:7,prenom:'Mariétou',        nom:'Hann',  email:'marietou.hann@email.com',   poste:'Comptable',         dept:'Product',       contrat:'Intérim',sal:350000, date:'2024-01-01',stat:'Actif',        susp:null},
];
let nextEmpId=8;

let postes=[
  {id:1,nom:'Dir. Financier',     dept:'Administration'},
  {id:2,nom:'Responsable RH',     dept:'Finance'},
  {id:3,nom:'Commerciale',        dept:'Commercial'},
  {id:4,nom:'Dev Web',            dept:'Product'},
  {id:5,nom:'Chef Projet',        dept:'Product'},
];
let nextPosteId=6;

let structures=[
  {id:1,nom:'Administration', resp:1},
  {id:2,nom:'Finance',        resp:2},
  {id:3,nom:'Commercial',     resp:3},
  {id:4,nom:'Product',        resp:5},
  {id:5,nom:'OPS',            resp:6},
];
let nextStructId=6;

let presences=[
  {id:1,empId:1,date:'2025-04-05',arr:'08:00',dep:'17:00',stat:'Présent',note:''},
  {id:2,empId:2,date:'2025-04-05',arr:'08:30',dep:'17:30',stat:'Présent',note:''},
  {id:3,empId:3,date:'2025-04-05',arr:'',     dep:'',     stat:'Absent', note:'Injustifiée'},
  {id:4,empId:4,date:'2025-04-05',arr:'09:00',dep:'18:00',stat:'Retard', note:''},
  {id:5,empId:5,date:'2025-04-05',arr:'08:00',dep:'17:00',stat:'Présent',note:''},
  {id:6,empId:6,date:'2025-04-05',arr:'',     dep:'',     stat:'Congé',  note:'Congé annuel'},
  {id:7,empId:7,date:'2025-04-05',arr:'08:00',dep:'17:00',stat:'Présent',note:''},
];
let nextPresId=8;

let conges=[
  {id:1,empId:2,type:'Congé annuel', deb:'2025-04-10',fin:'2025-04-20',motif:'Vacances',          stat:'En attente'},
  {id:2,empId:3,type:'Congé maladie',deb:'2025-04-07',fin:'2025-04-09',motif:'Certificat médical', stat:'En attente'},
  {id:3,empId:7,type:'RTT',          deb:'2025-04-14',fin:'2025-04-14',motif:'',                   stat:'En attente'},
  {id:4,empId:1,type:'Congé annuel', deb:'2025-03-15',fin:'2025-03-25',motif:'',                   stat:'Approuvé'},
  {id:5,empId:5,type:'Congé maladie',deb:'2025-03-05',fin:'2025-03-07',motif:'',                   stat:'Refusé'},
];
let nextCgId=6;

let candidatures=[
  {id:1,prenom:'Aissatou',nom:'Sow',    poste:'Comptable',      contrat:'CDI', date:'2025-04-01',cv:true, lm:true, rec:false,stat:'Nouveau'},
  {id:2,prenom:'Omar',    nom:'Faye',   poste:'Dev Web',         contrat:'CDI', date:'2025-04-02',cv:true, lm:true, rec:true, stat:'En analyse'},
  {id:3,prenom:'Mame',    nom:'Diop',   poste:'Commerciale',     contrat:'CDD', date:'2025-04-03',cv:true, lm:false,rec:false,stat:'Nouveau'},
  {id:4,prenom:'Ibrahima',nom:'Fall',   poste:'Chef Logistique', contrat:'CDI', date:'2025-04-04',cv:true, lm:true, rec:true, stat:'Retenu'},
];
let nextCandId=5;

let historique=[
  {id:1,date:'2025-04-05 09:12',user:'Admin',action:'Création',cible:'Employé',detail:'Ajout de Mariétou Hann'},
  {id:2,date:'2025-04-04 14:30',user:'Admin',action:'Modification',cible:'Congé',detail:'Approbation congé Mamadou Bâ'},
  {id:3,date:'2025-04-03 11:00',user:'Admin',action:'Création',cible:'Présence',detail:'Pointage du 03/04/2025'},
  {id:4,date:'2025-04-02 16:45',user:'Admin',action:'Connexion',cible:'Système',detail:'Connexion depuis Dakar'},
];

let notifications=[
  {id:1,ico:'📋',bg:'var(--orange-bg)',title:'3 congés en attente',sub:'Validation requise',time:'Il y a 30 min',read:false},
  {id:2,ico:'👤',bg:'var(--blue-bg)',  title:'Nouvelle candidature',sub:'Aissatou Sow — Comptable',time:'Il y a 2h',read:false},
];

// ══ HELPERS ══
const empNom=id=>{const e=employes.find(e=>e.id===id);return e?e.prenom+' '+e.nom:'?';};
const EC=['#4f7cf7','#059669','#d97706','#a855f7','#ef4444','#06b6d4','#be185d','#84cc16'];
const ec=id=>EC[(id-1)%EC.length];
const statB=s=>({Actif:'bg','Mis à pied':'br',Démissionnaire:'bo','En congé':'bb',Inactif:'bgr',Suspendu:'br'}[s]||'bgr');
const presB=s=>({Présent:'bg',Absent:'br',Retard:'bo',Congé:'bb'}[s]||'bgr');
const cgB=s=>({'En attente':'bo',Approuvé:'bg',Refusé:'br'}[s]||'bgr');
const candB=s=>({Nouveau:'bb','En analyse':'bo',Retenu:'bg',Refusé:'br'}[s]||'bgr');
const contB=c=>({CDI:'bg',CDD:'bb',Intérim:'bo',Stage:'bp'}[c]||'bgr');
const fD=d=>new Date(d).toLocaleDateString('fr-FR',{day:'2-digit',month:'short',year:'numeric'});
const dJ=(d1,d2)=>Math.ceil((new Date(d2)-new Date(d1))/864e5)+1;
const calcH=(a,d)=>{const[ah,am]=a.split(':').map(Number);const[dh,dm]=d.split(':').map(Number);const diff=(dh*60+dm)-(ah*60+am);return`${Math.floor(diff/60)}h${String(diff%60).padStart(2,'0')}`;};

function showToast(m,t='success'){const el=document.getElementById('toast');el.textContent=m;el.className='toast show '+t;clearTimeout(el._t);el._t=setTimeout(()=>el.classList.remove('show'),3000);}
function confirmDel(title,msg,cb){document.getElementById('conf-title').textContent=title;document.getElementById('conf-msg').textContent=msg;document.getElementById('conf-btn').onclick=()=>{cb();closeModal('modal-confirm');};openModal('modal-confirm');}

// ══ THEME ══
let currentTheme = localStorage.getItem('sc-theme') || 'dark';
function applyTheme(t){
  currentTheme=t;
  document.documentElement.setAttribute('data-theme',t);
  const isDark=t==='dark';
  const icons=['theme-icon-ib','theme-icon-tb','theme-dd-icon'];
  icons.forEach(id=>{const el=document.getElementById(id);if(el)el.setAttribute('data-lucide',isDark?'sun':'moon');});
  const tip=document.getElementById('theme-tip');if(tip)tip.textContent=isDark?'Mode clair':'Mode sombre';
  const lbl=document.getElementById('theme-dd-label');if(lbl)lbl.textContent=isDark?'Mode clair':'Mode sombre';
  const btnD=document.getElementById('btn-dark');const btnL=document.getElementById('btn-light');
  if(btnD){btnD.className=isDark?'btn btn-primary btn-sm':'btn btn-ghost btn-sm';}
  if(btnL){btnL.className=isDark?'btn btn-ghost btn-sm':'btn btn-primary btn-sm';}
  localStorage.setItem('sc-theme',t);
  lucide.createIcons();
}
function toggleTheme(){applyTheme(currentTheme==='dark'?'light':'dark');}
function setTheme(t){applyTheme(t);}

// ══ MODULE SWITCH ══
const modules={workspace:'sm-workspace',payroll:'sm-payroll',conges:'sm-conges',analytics:'sm-analytics',recrutement:'sm-recrutement'};
const moduleNames={workspace:'Workspace',payroll:'Payroll',conges:'Congés',analytics:'Analytics',recrutement:'Recrutement'};
const moduleSections={workspace:'Gestion entreprise',payroll:'Payroll',conges:'Workflow',analytics:'Analytics',recrutement:'Recrutement'};
const moduleFirstPage={workspace:'employes',payroll:'paie',conges:'conges',analytics:'indicateurs',recrutement:'recrutement'};

function setModule(m,el){
  document.querySelectorAll('.ib-item').forEach(i=>i.classList.remove('active'));
  if(el)el.classList.add('active');
  else document.getElementById('ib-'+m)?.classList.add('active');
  Object.keys(modules).forEach(k=>{const e=document.getElementById(modules[k]);if(e)e.style.display=k===m?'block':'none';});
  document.getElementById('tb-module').textContent=moduleNames[m]||m;
  document.getElementById('tb-section').textContent=moduleSections[m]||m;
  if(moduleFirstPage[m]) nav(moduleFirstPage[m],null);
  lucide.createIcons();
}

// ══ NAVIGATION ══
const pgTitles={dashboard:'Dashboard',employes:'Employés',presences:'Présences',conges:'Congés',paie:'Paie',indicateurs:'Indicateurs RH',recrutement:'Recrutement',profil:'Mon Profil',parametres:'Paramètres',historique:'Historiques',repertoire:'Répertoire',infos:'Infos générales',postes:'Postes',structures:'Structures',organigramme:'Organigramme',modeles:'Modèles',configuration:'Configuration'};
const pgSections={dashboard:'Principal',employes:'Gestion entreprise',presences:'Gestion entreprise',conges:'Workflow',paie:'Payroll',indicateurs:'Analytics',recrutement:'Recrutement',profil:'Menu principal',parametres:'Paramètres',historique:'Menu principal',repertoire:'Gestion entreprise',infos:'Gestion entreprise',postes:'Gestion entreprise',structures:'Gestion entreprise',organigramme:'Gestion entreprise',modeles:'Gestion entreprise',configuration:'Gestion entreprise'};

function nav(name, el){
  // Pages
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.getElementById('page-'+name)?.classList.add('active');
  // Menu items
  document.querySelectorAll('.mb-item').forEach(n=>n.classList.remove('active'));
  if(el && el.classList.contains('mb-item')) el.classList.add('active');
  else {
    const mn=document.getElementById('mn-'+name);
    if(mn) mn.classList.add('active');
  }
  // Breadcrumb
  document.getElementById('tb-page').textContent=pgTitles[name]||name;
  if(pgSections[name]) document.getElementById('tb-section').textContent=pgSections[name];
  // Close mobile menu
  document.getElementById('menu-bar').classList.remove('mobile-open');
  // Render specific pages
  const renders={presences:()=>{document.getElementById('pres-date').value=new Date().toISOString().split('T')[0];renderPresences();},conges:renderConges,paie:renderPaie,indicateurs:renderIndicateurs,recrutement:renderRecrutement,organigramme:renderOrg,historique:renderHisto,repertoire:renderRep,postes:renderPostes,structures:renderStructures};
  if(renders[name]) renders[name]();
  lucide.createIcons();
}

// ══ MODALS ══
function openModal(id){
  document.getElementById(id).classList.add('open');
  if(id==='modal-emp'){resetEmpForm();}
  if(id==='modal-pres'){populateSels();document.getElementById('pr-date').value=new Date().toISOString().split('T')[0];}
  if(id==='modal-cg'){populateSels();const t=new Date().toISOString().split('T')[0];document.getElementById('cg-deb').value=t;document.getElementById('cg-fin').value=t;}
  if(id==='modal-struct'){populateSels();}
  lucide.createIcons();
}
function closeModal(id){document.getElementById(id).classList.remove('open');}
document.querySelectorAll('.overlay').forEach(o=>o.addEventListener('click',e=>{if(e.target===o)o.classList.remove('open');}));
function resetEmpForm(){['emp-id','emp-prenom','emp-nom','emp-email','emp-tel','emp-poste','emp-salaire'].forEach(id=>document.getElementById(id).value='');document.getElementById('emp-date').value=new Date().toISOString().split('T')[0];document.getElementById('emp-modal-title').textContent='Créer un employé';}

// ══ TOGGLE ALL CHECKBOX ══
function toggleAll(cb){document.querySelectorAll('.emp-cb').forEach(c=>c.checked=cb.checked);document.querySelectorAll('#emp-tbody tr').forEach(r=>r.classList.toggle('sel',cb.checked));}
function delSelected(){const sel=[...document.querySelectorAll('.emp-cb:checked')];if(!sel.length){showToast('Sélectionnez des employés','error');return;}confirmDel('Supprimer','Supprimer les employés sélectionnés ?',()=>{const ids=sel.map(c=>parseInt(c.closest('tr').dataset.id));employes=employes.filter(e=>!ids.includes(e.id));renderEmployes();showToast(ids.length+' employé(s) supprimé(s)','info');});}

// ══ EMPLOYÉS ══
function renderEmployes(filter=''){
  const list=employes.filter(e=>(e.prenom+' '+e.nom+' '+e.email+' '+e.dept+' '+e.poste).toLowerCase().includes(filter.toLowerCase()));
  document.getElementById('emp-pg-count').textContent=employes.length;
  document.getElementById('emp-badge').textContent=employes.length;
  document.getElementById('emp-tbody').innerHTML=list.map(e=>`<tr data-id="${e.id}">
    <td><input type="checkbox" class="cb emp-cb"></td>
    <td><div class="nc"><div class="nav-av" style="background:${ec(e.id)}">${e.prenom[0]}${e.nom[0]}</div><div><div class="nc-n">${e.prenom} ${e.nom}</div><div class="nc-e">${e.email}</div></div></div></td>
    <td style="font-family:var(--mono);font-size:.72rem;color:var(--text3)">12344678${e.id}</td>
    <td style="font-family:var(--mono);font-size:.72rem;color:var(--text3)">${e.susp??'—'}</td>
    <td style="font-size:.75rem;color:var(--text2)">${e.email}</td>
    <td style="font-size:.78rem">${e.dept}</td>
    <td><span class="badge ${statB(e.stat)}">${e.stat}</span></td>
    <td><div class="ra">
      <button class="ra-btn" onclick="editEmp(${e.id})" title="Modifier"><i data-lucide="pencil" style="width:11px;height:11px"></i></button>
      <button class="ra-btn" onclick="voirPaie(${e.id})" title="Fiche paie"><i data-lucide="file-text" style="width:11px;height:11px"></i></button>
      <button class="ra-btn d" onclick="delEmp(${e.id})" title="Supprimer"><i data-lucide="trash-2" style="width:11px;height:11px"></i></button>
      <button class="ra-btn" title="Plus"><i data-lucide="more-vertical" style="width:11px;height:11px"></i></button>
    </div></td>
  </tr>`).join('');
  updateStats();
  lucide.createIcons();
}
function filterEmp(v){renderEmployes(v);}
function saveEmp(){
  const id=document.getElementById('emp-id').value;
  const p=document.getElementById('emp-prenom').value.trim();
  const n=document.getElementById('emp-nom').value.trim();
  if(!p||!n){showToast('Prénom et nom requis','error');return;}
  const d={prenom:p,nom:n,email:document.getElementById('emp-email').value,tel:document.getElementById('emp-tel').value,poste:document.getElementById('emp-poste').value,dept:document.getElementById('emp-dept').value,contrat:document.getElementById('emp-contrat').value,sal:parseInt(document.getElementById('emp-salaire').value)||0,date:document.getElementById('emp-date').value,stat:document.getElementById('emp-statut').value,susp:null};
  if(id){const i=employes.findIndex(e=>e.id==id);if(i>=0){employes[i]={...employes[i],...d};showToast('Employé modifié !');}}
  else{employes.push({id:nextEmpId++,...d});showToast('Employé ajouté !');}
  closeModal('modal-emp');renderEmployes();populateSels();
}
function editEmp(id){
  const e=employes.find(e=>e.id===id);if(!e)return;
  document.getElementById('emp-modal-title').textContent='Modifier employé';
  document.getElementById('emp-id').value=e.id;
  document.getElementById('emp-prenom').value=e.prenom;
  document.getElementById('emp-nom').value=e.nom;
  document.getElementById('emp-email').value=e.email;
  document.getElementById('emp-tel').value=e.tel||'';
  document.getElementById('emp-poste').value=e.poste;
  document.getElementById('emp-dept').value=e.dept;
  document.getElementById('emp-contrat').value=e.contrat;
  document.getElementById('emp-salaire').value=e.sal;
  document.getElementById('emp-date').value=e.date;
  document.getElementById('emp-statut').value=e.stat;
  openModal('modal-emp');
}
function delEmp(id){confirmDel('Supprimer employé','Supprimer cet employé définitivement ?',()=>{employes=employes.filter(e=>e.id!==id);renderEmployes();showToast('Employé supprimé.','info');});}

// ══ PRÉSENCES ══
function renderPresences(){
  const date=document.getElementById('pres-date').value||new Date().toISOString().split('T')[0];
  const list=presences.filter(p=>p.date===date);
  document.getElementById('p-p').textContent=list.filter(p=>p.stat==='Présent').length;
  document.getElementById('p-a').textContent=list.filter(p=>p.stat==='Absent').length;
  document.getElementById('p-c').textContent=list.filter(p=>p.stat==='Congé').length;
  document.getElementById('p-r').textContent=list.filter(p=>p.stat==='Retard').length;
  document.getElementById('pres-tbody').innerHTML=list.map(p=>`<tr>
    <td><input type="checkbox" class="cb"></td>
    <td><div class="nc"><div class="nav-av" style="background:${ec(p.empId)};width:24px;height:24px;font-size:.6rem">${empNom(p.empId).split(' ').map(x=>x[0]).join('')}</div><span style="font-weight:600;font-size:.78rem">${empNom(p.empId)}</span></div></td>
    <td style="font-family:var(--mono);font-size:.72rem">${p.date}</td>
    <td style="font-family:var(--mono)">${p.arr||'—'}</td>
    <td style="font-family:var(--mono)">${p.dep||'—'}</td>
    <td style="font-family:var(--mono)">${p.arr&&p.dep?calcH(p.arr,p.dep):'—'}</td>
    <td><span class="badge ${presB(p.stat)}">${p.stat}</span></td>
    <td><div class="ra">
      ${p.stat==='Absent'?`<button class="ra-btn" onclick="justAbs(${p.id})" title="Justifier"><i data-lucide="check" style="width:11px;height:11px"></i></button>`:''}
      <button class="ra-btn d" onclick="delPres(${p.id})"><i data-lucide="trash-2" style="width:11px;height:11px"></i></button>
    </div></td>
  </tr>`).join('');
  lucide.createIcons();
}
function savePres(){
  const empId=parseInt(document.getElementById('pr-emp').value);
  const date=document.getElementById('pr-date').value;
  if(!empId||!date){showToast('Employé et date requis','error');return;}
  presences.push({id:nextPresId++,empId,date,arr:document.getElementById('pr-arr').value,dep:document.getElementById('pr-dep').value,stat:document.getElementById('pr-stat').value,note:document.getElementById('pr-note').value});
  closeModal('modal-pres');renderPresences();showToast('Présence enregistrée !');
}
function justAbs(id){const p=presences.find(p=>p.id===id);if(p){p.stat='Présent';renderPresences();showToast('Absence justifiée ✅');}}
function delPres(id){confirmDel('Supprimer','Supprimer cette entrée ?',()=>{presences=presences.filter(p=>p.id!==id);renderPresences();});}

// ══ CONGÉS ══
function renderConges(){
  const att=conges.filter(c=>c.stat==='En attente');
  const hist=conges.filter(c=>c.stat!=='En attente');
  const attCount=att.length;
  document.getElementById('cg-att-count').textContent=attCount;
  document.getElementById('cg-side-badge').textContent=attCount;
  document.getElementById('cg-att-list').innerHTML=att.map(c=>`<div class="cg-card">
    <div class="cg-av" style="background:${ec(c.empId)}">${empNom(c.empId).split(' ').map(x=>x[0]).join('')}</div>
    <div class="cg-info"><div class="cg-name">${empNom(c.empId)}</div><div class="cg-det">${c.type} · ${fD(c.deb)} → ${fD(c.fin)} (${dJ(c.deb,c.fin)} j.)</div></div>
    <div class="cg-acts">
      <button class="btn btn-success btn-sm" onclick="valCg(${c.id},true)"><i data-lucide="check" style="width:10px;height:10px"></i></button>
      <button class="btn btn-danger btn-sm" onclick="valCg(${c.id},false)"><i data-lucide="x" style="width:10px;height:10px"></i></button>
    </div>
  </div>`).join('')||'<p style="text-align:center;color:var(--text3);padding:12px;font-size:.76rem">Aucune demande en attente ✅</p>';
  document.getElementById('cg-hist').innerHTML=hist.map(c=>`<tr><td style="font-weight:600;font-size:.76rem">${empNom(c.empId)}</td><td style="font-size:.7rem">${fD(c.deb)} → ${fD(c.fin)}</td><td style="font-size:.72rem">${c.type}</td><td><span class="badge ${cgB(c.stat)}">${c.stat}</span></td></tr>`).join('');
  renderCgDash();
  lucide.createIcons();
}
function valCg(id,ok){const c=conges.find(c=>c.id===id);if(c){c.stat=ok?'Approuvé':'Refusé';renderConges();showToast(ok?'Congé approuvé ✅':'Congé refusé','info');}}
function saveCg(){
  const empId=parseInt(document.getElementById('cg-emp').value);
  const deb=document.getElementById('cg-deb').value;
  const fin=document.getElementById('cg-fin').value;
  if(!empId||!deb||!fin){showToast('Champs requis','error');return;}
  conges.push({id:nextCgId++,empId,type:document.getElementById('cg-type').value,deb,fin,motif:document.getElementById('cg-motif').value,stat:'En attente'});
  closeModal('modal-cg');renderConges();showToast('Demande soumise !');
}
function renderCgDash(){
  const att=conges.filter(c=>c.stat==='En attente');
  document.getElementById('cg-dash-badge').textContent=att.length;
  document.getElementById('cg-dash-list').innerHTML=att.slice(0,3).map(c=>`<div class="cg-card" style="padding:7px 9px">
    <div class="cg-av" style="background:${ec(c.empId)};width:26px;height:26px;font-size:.6rem">${empNom(c.empId).split(' ').map(x=>x[0]).join('')}</div>
    <div class="cg-info"><div class="cg-name" style="font-size:.74rem">${empNom(c.empId)}</div><div class="cg-det" style="font-size:.64rem">${c.type} · ${dJ(c.deb,c.fin)} jours</div></div>
    <span class="badge bo" style="font-size:.58rem">En attente</span>
  </div>`).join('')||'<p style="text-align:center;color:var(--text3);padding:10px;font-size:.74rem">Aucune demande</p>';
}

// ══ PAIE ══
function renderPaie(){
  document.getElementById('paie-tbody').innerHTML=employes.map(e=>{
    const b=e.sal,cot=Math.round(b*.1),net=b-cot;
    return`<tr>
      <td><input type="checkbox" class="cb"></td>
      <td><div class="nc"><div class="nav-av" style="background:${ec(e.id)};width:24px;height:24px;font-size:.6rem">${e.prenom[0]}${e.nom[0]}</div><span style="font-weight:600;font-size:.76rem">${e.prenom} ${e.nom}</span></div></td>
      <td style="font-size:.74rem;color:var(--text2)">${e.poste}</td>
      <td style="font-family:var(--mono);font-size:.74rem">${b.toLocaleString()} XOF</td>
      <td style="font-family:var(--mono);font-size:.74rem;color:var(--red)">-${cot.toLocaleString()} XOF</td>
      <td style="font-family:var(--mono);font-size:.74rem;font-weight:800;color:var(--green)">${net.toLocaleString()} XOF</td>
      <td><span class="badge bg">Généré</span></td>
      <td><div class="ra">
        <button class="ra-btn" onclick="voirPaie(${e.id})" title="Voir bulletin"><i data-lucide="eye" style="width:11px;height:11px"></i></button>
        <button class="ra-btn" onclick="voirPaie(${e.id});setTimeout(printPaie,300)" title="Imprimer"><i data-lucide="printer" style="width:11px;height:11px"></i></button>
      </div></td>
    </tr>`;
  }).join('');
  lucide.createIcons();
}
function voirPaie(id){
  const e=employes.find(e=>e.id===id);if(!e)return;
  const b=e.sal,cnss=Math.round(b*.04),ipres=Math.round(b*.06),net=b-cnss-ipres;
  document.getElementById('paie-content').innerHTML=`<div class="paie-doc">
    <div class="ph"><div><div class="cn">SOCIETAS GRH</div><div class="ca">123 Avenue Bourguiba, Dakar, Sénégal<br>NINEA: 12345678901</div></div><div class="pt"><h3>BULLETIN DE PAIE</h3><p>Période : Avril 2025</p></div></div>
    <div class="eg">
      <div><div class="el">Nom complet</div><div class="ev">${e.prenom} ${e.nom}</div></div>
      <div><div class="el">Matricule</div><div class="ev" style="font-family:monospace">12344678${e.id}</div></div>
      <div><div class="el">Poste</div><div class="ev">${e.poste}</div></div>
      <div><div class="el">Structure</div><div class="ev">${e.dept}</div></div>
      <div><div class="el">Contrat</div><div class="ev">${e.contrat}</div></div>
      <div><div class="el">Date embauche</div><div class="ev">${fD(e.date)}</div></div>
    </div>
    <table><thead><tr><th>Libellé</th><th>Base</th><th>Taux</th><th>Montant</th></tr></thead>
    <tbody>
      <tr><td style="font-weight:700">Salaire de base</td><td>${b.toLocaleString()} XOF</td><td>100%</td><td style="font-weight:700">${b.toLocaleString()} XOF</td></tr>
      <tr style="color:#dc2626"><td>Cotisation CNSS (salarié)</td><td>${b.toLocaleString()} XOF</td><td>4%</td><td>- ${cnss.toLocaleString()} XOF</td></tr>
      <tr style="color:#dc2626"><td>Cotisation IPRES (salarié)</td><td>${b.toLocaleString()} XOF</td><td>6%</td><td>- ${ipres.toLocaleString()} XOF</td></tr>
    </tbody></table>
    <div class="tots"><div class="tot"><div class="tl">Salaire brut</div><div class="tv">${b.toLocaleString()} XOF</div></div><div class="tot"><div class="tl">Total cotisations</div><div class="tv" style="color:#dc2626">${(cnss+ipres).toLocaleString()} XOF</div></div><div class="tot net"><div class="tl">Net à payer</div><div class="tv">${net.toLocaleString()} XOF</div></div></div>
    <div class="sigs"><div><div class="sl">Signature Employeur</div></div><div><div class="sl">Signature Employé</div></div></div>
  </div>`;
  openModal('modal-paie');
}
function printPaie(){const pz=document.getElementById('print-zone');pz.style.display='block';pz.innerHTML=document.getElementById('paie-content').innerHTML;window.print();pz.style.display='none';closeModal('modal-paie');}

// ══ INDICATEURS ══
function renderIndicateurs(){
  const tot=employes.length;
  const today=new Date().toISOString().split('T')[0];
  const pres=presences.filter(p=>p.date===today&&(p.stat==='Présent'||p.stat==='Retard')).length;
  const abs=presences.filter(p=>p.date===today&&p.stat==='Absent').length;
  const hT=tot*8,hR=pres*8;
  document.getElementById('kpi-etp').textContent=(tot?(hR/hT*tot):0).toFixed(1);
  document.getElementById('kpi-emm').textContent=((tot+tot)/2).toFixed(1);
  document.getElementById('kpi-ema').textContent=tot.toFixed(1);
  document.getElementById('kpi-abs').textContent=tot?((abs/tot)*100).toFixed(1)+'%':'0%';
  document.getElementById('kpi-pres').textContent=tot?((pres/tot)*100).toFixed(1)+'%':'0%';
  const months=['Oct','Nov','Déc','Jan','Fév','Mar','Avr'];
  const vals=[4,4,5,5,6,6,tot];const max=Math.max(...vals);
  document.getElementById('eff-chart').innerHTML=months.map((m,i)=>`<div class="bc-col"><div class="bc-val">${vals[i]}</div><div class="bc-bar" style="height:${vals[i]/max*100}px;background:${i===6?'var(--blue)':'var(--blue-bg)'}"></div><div class="bc-lbl" style="${i===6?'color:var(--blue);font-weight:700':''}">${m}</div></div>`).join('');
}

// ══ RECRUTEMENT ══
function renderRecrutement(){
  document.getElementById('cand-pg-count').textContent=candidatures.length;
  document.getElementById('sc-total').textContent=candidatures.length;
  document.getElementById('sc-cours').textContent=candidatures.filter(c=>c.stat==='En analyse').length;
  document.getElementById('sc-ret').textContent=candidatures.filter(c=>c.stat==='Retenu').length;
  document.getElementById('sc-ref').textContent=candidatures.filter(c=>c.stat==='Refusé').length;
  document.getElementById('cand-side-badge').textContent=candidatures.filter(c=>c.stat==='Nouveau').length;
  document.getElementById('cand-tbody').innerHTML=candidatures.map(c=>`<tr>
    <td><input type="checkbox" class="cb"></td>
    <td><div class="nc"><div class="nav-av" style="background:${EC[c.id%EC.length]};width:24px;height:24px;font-size:.6rem">${c.prenom[0]}${c.nom[0]}</div><div><div class="nc-n">${c.prenom} ${c.nom}</div></div></div></td>
    <td style="font-weight:600;font-size:.76rem">${c.poste}</td>
    <td><span class="badge ${contB(c.contrat)}">${c.contrat}</span></td>
    <td style="font-family:var(--mono);font-size:.7rem">${fD(c.date)}</td>
    <td><div style="display:flex;gap:3px">${c.cv?'<span class="badge bg" style="font-size:.58rem">CV</span>':''}${c.lm?'<span class="badge bb" style="font-size:.58rem">LM</span>':''}${c.rec?'<span class="badge bp" style="font-size:.58rem">Rec.</span>':''}</div></td>
    <td><span class="badge ${candB(c.stat)}">${c.stat}</span></td>
    <td><div class="ra">
      <button class="ra-btn" onclick="chCand(${c.id},'Retenu')" title="Retenir"><i data-lucide="check" style="width:11px;height:11px"></i></button>
      <button class="ra-btn d" onclick="chCand(${c.id},'Refusé')" title="Refuser"><i data-lucide="x" style="width:11px;height:11px"></i></button>
    </div></td>
  </tr>`).join('');
  document.getElementById('cand-dash-tb').innerHTML=candidatures.slice(0,3).map(c=>`<tr><td><div class="nc"><div class="nav-av" style="background:${EC[c.id%EC.length]};width:20px;height:20px;font-size:.56rem">${c.prenom[0]}${c.nom[0]}</div><span style="font-weight:600;font-size:.74rem">${c.prenom} ${c.nom}</span></div></td><td style="font-size:.72rem">${c.poste}</td><td style="font-family:var(--mono);font-size:.66rem">${fD(c.date)}</td><td><span class="badge ${candB(c.stat)}" style="font-size:.58rem">${c.stat}</span></td></tr>`).join('');
  lucide.createIcons();
}
function chCand(id,s){const c=candidatures.find(c=>c.id===id);if(c){c.stat=s;renderRecrutement();showToast('Candidature : '+s,'info');}}

// ══ ORGANIGRAMME ══
function renderOrg(){
  const el=document.getElementById('org-tree');if(!el)return;
  const dg=employes.find(e=>e.dept==='Direction')||employes[0];
  const depts=[...new Set(employes.map(e=>e.dept))];
  el.innerHTML=`
    <div class="org-level">
      <div class="org-node root">
        <div class="on-av" style="background:${ec(dg.id)}">${dg.prenom[0]}${dg.nom[0]}</div>
        <div class="on-name">${dg.prenom} ${dg.nom}</div>
        <div class="on-role">${dg.poste} — Direction</div>
      </div>
    </div>
    <div class="org-connector"></div>
    <div class="org-level">
      ${depts.filter(d=>d!=='Direction').map(dept=>{
        const chef=employes.find(e=>e.dept===dept);if(!chef)return'';
        const count=employes.filter(e=>e.dept===dept).length;
        return`<div class="org-node">
          <div class="on-av" style="background:${ec(chef.id)}">${chef.prenom[0]}${chef.nom[0]}</div>
          <div class="on-name">${chef.prenom} ${chef.nom}</div>
          <div class="on-role">${dept}</div>
          <div style="font-size:.62rem;color:var(--text3);margin-top:3px">${count} employé${count>1?'s':''}</div>
        </div>`;
      }).join('')}
    </div>`;
  lucide.createIcons();
}

// ══ HISTORIQUE ══
function renderHisto(){
  const el=document.getElementById('histo-tbody');if(!el)return;
  el.innerHTML=historique.map(h=>`<tr>
    <td style="font-family:var(--mono);font-size:.72rem;color:var(--text3)">${h.date}</td>
    <td style="font-weight:600;font-size:.78rem">${h.user}</td>
    <td><span class="badge bb">${h.action}</span></td>
    <td style="font-size:.76rem">${h.cible}</td>
    <td style="font-size:.74rem;color:var(--text2)">${h.detail}</td>
  </tr>`).join('');
}

// ══ RÉPERTOIRE ══
function renderRep(){
  const el=document.getElementById('rep-tbody');if(!el)return;
  el.innerHTML=employes.map(e=>`<tr>
    <td><div class="nc"><div class="nav-av" style="background:${ec(e.id)};width:24px;height:24px;font-size:.6rem">${e.prenom[0]}${e.nom[0]}</div><span style="font-weight:600;font-size:.78rem">${e.prenom} ${e.nom}</span></div></td>
    <td style="font-size:.76rem">${e.poste}</td>
    <td><span class="badge bb">${e.dept}</span></td>
    <td style="font-size:.74rem;color:var(--text2)">${e.email}</td>
    <td style="font-family:var(--mono);font-size:.72rem;color:var(--text3)">${e.tel||'—'}</td>
  </tr>`).join('');
}

// ══ POSTES ══
function renderPostes(){
  document.getElementById('postes-count').textContent=postes.length;
  document.getElementById('postes-tbody').innerHTML=postes.map(p=>{
    const count=employes.filter(e=>e.poste===p.nom).length;
    return`<tr>
      <td style="font-weight:600;font-size:.8rem">${p.nom}</td>
      <td><span class="badge bb">${p.dept}</span></td>
      <td style="font-family:var(--mono);font-size:.76rem">${count}</td>
      <td><div class="ra">
        <button class="ra-btn d" onclick="delPoste(${p.id})"><i data-lucide="trash-2" style="width:11px;height:11px"></i></button>
      </div></td>
    </tr>`;
  }).join('');
  lucide.createIcons();
}
function savePoste(){
  const nom=document.getElementById('poste-nom').value.trim();
  if(!nom){showToast('Intitulé requis','error');return;}
  postes.push({id:nextPosteId++,nom,dept:document.getElementById('poste-dept').value});
  closeModal('modal-poste');renderPostes();showToast('Poste créé !');
}
function delPoste(id){confirmDel('Supprimer poste','Supprimer ce poste ?',()=>{postes=postes.filter(p=>p.id!==id);renderPostes();showToast('Poste supprimé','info');});}

// ══ STRUCTURES ══
function renderStructures(){
  document.getElementById('structs-count').textContent=structures.length;
  document.getElementById('structs-tbody').innerHTML=structures.map(s=>{
    const count=employes.filter(e=>e.dept===s.nom).length;
    return`<tr>
      <td style="font-weight:600;font-size:.8rem">${s.nom}</td>
      <td style="font-size:.76rem">${empNom(s.resp)}</td>
      <td style="font-family:var(--mono);font-size:.76rem">${count}</td>
      <td><div class="ra">
        <button class="ra-btn d" onclick="delStruct(${s.id})"><i data-lucide="trash-2" style="width:11px;height:11px"></i></button>
      </div></td>
    </tr>`;
  }).join('');
  lucide.createIcons();
}
function saveStruct(){
  const nom=document.getElementById('struct-nom').value.trim();
  if(!nom){showToast('Nom requis','error');return;}
  structures.push({id:nextStructId++,nom,resp:parseInt(document.getElementById('struct-resp').value)||1});
  closeModal('modal-struct');renderStructures();showToast('Structure créée !');
}
function delStruct(id){confirmDel('Supprimer structure','Supprimer cette structure ?',()=>{structures=structures.filter(s=>s.id!==id);renderStructures();showToast('Structure supprimée','info');});}

// ══ STATS ══
function updateStats(){
  const today=new Date().toISOString().split('T')[0];
  document.getElementById('s-total').textContent=employes.filter(e=>e.stat==='Actif').length;
  document.getElementById('s-presents').textContent=presences.filter(p=>p.date===today&&(p.stat==='Présent'||p.stat==='Retard')).length;
  document.getElementById('s-conges').textContent=conges.filter(c=>c.stat==='Approuvé').length;
  document.getElementById('s-cand').textContent=candidatures.length;
}

// ══ CHARTS ══
function renderDashCharts(){
  const days=['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
  const vals=[5,4,6,5,4,1,0];const max=Math.max(...vals)||1;
  document.getElementById('dash-chart').innerHTML=days.map((d,i)=>`<div class="bc-col"><div class="bc-val" style="${i===4?'color:var(--blue)':''}">${vals[i]}</div><div class="bc-bar" style="height:${vals[i]/max*100}px;background:${i===4?'var(--blue)':'var(--blue-bg)'}"></div><div class="bc-lbl" style="${i===4?'color:var(--blue);font-weight:700':''}">${d}</div></div>`).join('');
  const cdi=employes.filter(e=>e.contrat==='CDI').length;
  const cdd=employes.filter(e=>e.contrat==='CDD').length;
  const int=employes.filter(e=>e.contrat==='Intérim').length;
  const tot=employes.length;
  document.getElementById('contrats-chart').innerHTML=[['CDI','var(--green)',cdi],['CDD','var(--blue)',cdd],['Intérim','var(--orange)',int]].map(([l,c,v])=>`<div style="margin-bottom:9px"><div style="display:flex;justify-content:space-between;margin-bottom:2px"><span style="font-size:.74rem;font-weight:600">${l}</span><span style="font-size:.68rem;font-family:var(--mono);color:var(--text2)">${v} (${tot?Math.round(v/tot*100):0}%)</span></div><div class="prog-bar"><div class="prog-fill" style="width:${tot?v/tot*100:0}%;background:${c}"></div></div></div>`).join('');
}

// ══ SELECTS ══
function populateSels(){
  const o='<option value="">— Sélectionner —</option>'+employes.map(e=>`<option value="${e.id}">${e.prenom} ${e.nom}</option>`).join('');
  ['pr-emp','cg-emp','struct-resp'].forEach(id=>{const el=document.getElementById(id);if(el)el.innerHTML=o;});
}

// ══ NOTIFS ══
function renderNotifs(){
  const el=document.getElementById('notif-list');if(!el)return;
  el.innerHTML=notifications.map(n=>`<div class="np-item${n.read?'':' unread'}" onclick="n.read=true;renderNotifs()">
    <div class="np-ico" style="background:${n.bg}">${n.ico}</div>
    <div><div class="np-title">${n.title}</div><div class="np-sub">${n.sub}</div><div class="np-time">${n.time}</div></div>
  </div>`).join('');
  const u=notifications.filter(n=>!n.read).length;
  const b=document.getElementById('notif-badge');b.textContent=u;b.style.display=u?'flex':'none';
}
function toggleNotif(){document.getElementById('notif-panel').classList.toggle('open');}
function clearNotifs(){notifications.forEach(n=>n.read=true);renderNotifs();}

// ══ TOPBAR ══
function toggleProfile(e){if(e)e.stopPropagation();document.getElementById('prof-drop').classList.toggle('open');}
function toggleMenu(){
  const mb=document.getElementById('menu-bar');
  const mw=document.getElementById('main-wrap');
  if(window.innerWidth<=768){mb.classList.toggle('mobile-open');}
  else{mb.classList.toggle('collapsed');mw.classList.toggle('menu-collapsed');localStorage.setItem('sc-menu-col',mb.classList.contains('collapsed'));}
}
function setSidebar(collapse){
  document.getElementById('menu-bar').classList.toggle('collapsed',collapse);
  document.getElementById('main-wrap').classList.toggle('menu-collapsed',collapse);
}
document.addEventListener('click',e=>{
  if(!e.target.closest('#prof-btn'))document.getElementById('prof-drop').classList.remove('open');
  if(!e.target.closest('.notif-panel')&&!e.target.closest('.tb-btn'))document.getElementById('notif-panel').classList.remove('open');
});

// ══ SEARCH ══
function globalSearch(v){
  if(!v)return;
  const f=employes.find(e=>(e.prenom+' '+e.nom).toLowerCase().includes(v.toLowerCase()));
  if(f){nav('employes',null);setTimeout(()=>filterEmp(v),100);}
}

// ══ INIT ══
document.addEventListener('DOMContentLoaded',()=>{
  // Appliquer thème sauvegardé
  applyTheme(localStorage.getItem('sc-theme')||'dark');
  // Restaurer état menu
  if(localStorage.getItem('sc-menu-col')==='true') setSidebar(true);
  // Rendu initial
  renderEmployes();
  populateSels();
  updateStats();
  renderDashCharts();
  renderCgDash();
  renderRecrutement();
  renderNotifs();
  // Page initiale = Employés
  nav('employes', document.getElementById('mn-employes'));
  lucide.createIcons();
  // Auto-refresh notifs
  setInterval(renderNotifs, 30000);
});
</script>
</body>
</html>
