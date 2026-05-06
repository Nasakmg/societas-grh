<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Societas GRH — Comptabilité</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root{--font:'Inter',sans-serif;--mono:'JetBrains Mono',monospace;--r:6px;--r-lg:10px;--transition:.15s ease;}
[data-theme="dark"]{--bg:#0e1117;--bg2:#13161f;--surface:#1a1f2e;--s2:#20253a;--s3:#272d42;--border:rgba(255,255,255,.07);--text:#e8ecf4;--text2:#8b93a8;--text3:#4a5268;--blue:#4f7cf7;--blue-bg:rgba(79,124,247,.12);--blue-bd:rgba(79,124,247,.3);--green:#22c55e;--green-bg:rgba(34,197,94,.12);--orange:#f59e0b;--orange-bg:rgba(245,158,11,.12);--red:#ef4444;--red-bg:rgba(239,68,68,.12);--purple:#a855f7;--purple-bg:rgba(168,85,247,.12);--shadow:0 8px 24px rgba(0,0,0,.5);}
[data-theme="light"]{--bg:#f1f5f9;--bg2:#ffffff;--surface:#ffffff;--s2:#f8fafc;--s3:#f1f5f9;--border:rgba(0,0,0,.08);--text:#0f172a;--text2:#64748b;--text3:#94a3b8;--blue:#2563eb;--blue-bg:rgba(37,99,235,.08);--blue-bd:rgba(37,99,235,.25);--green:#16a34a;--green-bg:rgba(22,163,74,.08);--orange:#d97706;--orange-bg:rgba(217,119,6,.08);--red:#dc2626;--red-bg:rgba(220,38,38,.08);--purple:#7c3aed;--purple-bg:rgba(124,58,237,.08);--shadow:0 4px 16px rgba(0,0,0,.08);}
*{margin:0;padding:0;box-sizing:border-box;}
html{font-size:13px;}
body{font-family:var(--font);background:var(--bg);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased;transition:background var(--transition),color var(--transition);}
.topbar{height:52px;background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 20px;gap:12px;position:sticky;top:0;z-index:100;}
.tb-logo{width:28px;height:28px;border-radius:6px;background:var(--green);color:white;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.82rem;}
.tb-role{font-size:.7rem;font-weight:700;background:var(--green-bg);color:var(--green);padding:2px 8px;border-radius:8px;}
.tb-right{display:flex;align-items:center;gap:8px;margin-left:auto;}
.tb-pav{width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--green),var(--blue));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;}
.content{padding:24px;max-width:1200px;margin:0 auto;}
.pg-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;gap:12px;flex-wrap:wrap;}
.pg-title{font-size:1.2rem;font-weight:700;margin-bottom:4px;}
.pg-sub{font-size:.76rem;color:var(--text2);}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;transition:all var(--transition);}
.stat-card:hover{border-color:var(--blue-bd);}
.stat-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.stat-ic{width:34px;height:34px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;}
.stat-val{font-size:1.1rem;font-weight:800;font-family:var(--mono);line-height:1;margin-bottom:2px;}
.stat-lbl{font-size:.68rem;color:var(--text2);}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;margin-bottom:14px;}
.card-head{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;border-bottom:1px solid var(--border);}
.card-title{font-weight:700;font-size:.82rem;display:flex;align-items:center;gap:6px;}
.tw{overflow-x:auto;}
.dt{width:100%;border-collapse:collapse;}
.dt th{text-align:left;padding:8px 12px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--text3);background:var(--bg2);border-bottom:1px solid var(--border);white-space:nowrap;}
.dt td{padding:9px 12px;font-size:.78rem;color:var(--text2);border-bottom:1px solid rgba(255,255,255,.04);vertical-align:middle;}
.dt tr:last-child td{border-bottom:none;}
.dt tr:hover td{background:rgba(255,255,255,.015);}
.dt tfoot td{background:var(--s2);font-weight:800;color:var(--text);border-top:2px solid var(--border);}
.badge{display:inline-flex;padding:2px 8px;border-radius:4px;font-size:.66rem;font-weight:700;}
.bg{background:var(--green-bg);color:var(--green);}
.bb{background:var(--blue-bg);color:var(--blue);}
.bo{background:var(--orange-bg);color:var(--orange);}
.bp{background:var(--purple-bg);color:var(--purple);}
.btn{display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:var(--r);font-size:.76rem;font-weight:600;cursor:pointer;border:none;font-family:var(--font);transition:all var(--transition);white-space:nowrap;text-decoration:none;}
.btn-primary{background:var(--blue);color:white;}
.btn-primary:hover{opacity:.9;}
.btn-success{background:var(--green);color:white;}
.btn-success:hover{opacity:.9;}
.btn-ghost{background:var(--s2);border:1px solid var(--border);color:var(--text2);}
.btn-ghost:hover{color:var(--text);border-color:var(--blue-bd);}
.btn-sm{padding:4px 9px;font-size:.7rem;}
.g2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.nc{display:flex;align-items:center;gap:9px;}
.nav-av{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.6rem;color:white;flex-shrink:0;}
.nc-n{font-weight:600;font-size:.78rem;color:var(--text);}
.prog-bar{height:6px;background:var(--s3);border-radius:3px;overflow:hidden;margin-top:4px;}
.prog-fill{height:100%;border-radius:3px;transition:width .5s ease;}
.summary-box{background:var(--s2);border:1px solid var(--border);border-radius:var(--r-lg);padding:16px;}
.summary-row{display:flex;justify-content:space-between;align-items:center;padding:7px 0;border-bottom:1px solid var(--border);}
.summary-row:last-child{border-bottom:none;padding-top:10px;margin-top:4px;}
.summary-row.total{font-weight:800;font-size:.85rem;}
.toast{position:fixed;bottom:16px;right:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:8px 13px;box-shadow:var(--shadow);z-index:9999;font-size:.78rem;font-weight:600;display:none;align-items:center;gap:6px;}
.toast.show{display:flex;}
.toast.success{border-left:3px solid var(--green);color:var(--green);}
.toast.error{border-left:3px solid var(--red);color:var(--red);}
@media(max-width:1100px){.stats-grid{grid-template-columns:repeat(2,1fr);}.g2{grid-template-columns:1fr;}}
@media(max-width:768px){.stats-grid{grid-template-columns:1fr 1fr;}}
</style>
</head>
<body>
@php
$u    = Auth::user();
$init = strtoupper(substr($u->name ?? 'CO', 0, 2));
$EC   = ['#4f7cf7','#059669','#d97706','#a855f7','#ef4444','#06b6d4'];
@endphp

<!-- TOPBAR -->
<div class="topbar">
    <div class="tb-logo">S</div>
    <span style="font-weight:700;font-size:.88rem">Societas GRH</span>
    <span class="tb-role">Comptabilité</span>
    <div class="tb-right">
        <button class="btn btn-ghost btn-sm" onclick="toggleTheme()">
            <i data-lucide="sun" style="width:11px;height:11px" id="theme-icon"></i>
        </button>
        <div class="tb-pav">{{ $init }}</div>
        <span style="font-size:.8rem;font-weight:600">{{ $u->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm">
                <i data-lucide="log-out" style="width:11px;height:11px"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="content">

    <!-- EN-TÊTE -->
    <div class="pg-head">
        <div>
            <div class="pg-title">
                Tableau de bord Comptable 💼
            </div>
            <div class="pg-sub">
                Masse salariale, cotisations et exports financiers — {{ $periode }}
            </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap">
            <a href="{{ route('comptable.export.pdf') }}" class="btn btn-primary">
                <i data-lucide="file-text" style="width:12px;height:12px"></i>
                Exporter PDF
            </a>
            <a href="{{ route('comptable.export.csv') }}" class="btn btn-success">
                <i data-lucide="download" style="width:12px;height:12px"></i>
                Exporter CSV
            </a>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-ic" style="background:var(--blue-bg)">
                    <i data-lucide="users" style="width:15px;height:15px;stroke:var(--blue)"></i>
                </div>
            </div>
            <div class="stat-val">{{ $stats['total_employes'] }}</div>
            <div class="stat-lbl">Employés actifs</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-ic" style="background:var(--orange-bg)">
                    <i data-lucide="banknote" style="width:15px;height:15px;stroke:var(--orange)"></i>
                </div>
            </div>
            <div class="stat-val" style="font-size:.85rem">
                {{ number_format($stats['masse_salariale'],0,',',' ') }}
            </div>
            <div class="stat-lbl">Masse salariale brute (XOF)</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-ic" style="background:var(--red-bg)">
                    <i data-lucide="percent" style="width:15px;height:15px;stroke:var(--red)"></i>
                </div>
            </div>
            <div class="stat-val" style="font-size:.85rem;color:var(--red)">
                {{ number_format($stats['cotisations_total'],0,',',' ') }}
            </div>
            <div class="stat-lbl">Total cotisations salariales (XOF)</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-ic" style="background:var(--green-bg)">
                    <i data-lucide="check-circle" style="width:15px;height:15px;stroke:var(--green)"></i>
                </div>
            </div>
            <div class="stat-val" style="font-size:.85rem;color:var(--green)">
                {{ number_format($stats['net_total'],0,',',' ') }}
            </div>
            <div class="stat-lbl">Total net à payer (XOF)</div>
        </div>
    </div>

    <div class="g2">
        <!-- RÉCAPITULATIF PAIE -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="calculator" style="width:13px;height:13px;stroke:var(--blue)"></i>
                    Récapitulatif — {{ $periode }}
                </span>
            </div>
            <div style="padding:16px">
                <div class="summary-box">
                    <div class="summary-row">
                        <span style="font-size:.78rem;color:var(--text2)">Masse salariale brute</span>
                        <span style="font-family:var(--mono);font-size:.78rem;font-weight:700">
                            {{ number_format($stats['masse_salariale'],0,',',' ') }} XOF
                        </span>
                    </div>
                    <div class="summary-row">
                        <span style="font-size:.78rem;color:var(--red)">— CNSS salarié (4%)</span>
                        <span style="font-family:var(--mono);font-size:.78rem;color:var(--red)">
                            -{{ number_format(round($stats['masse_salariale']*0.04),0,',',' ') }} XOF
                        </span>
                    </div>
                    <div class="summary-row">
                        <span style="font-size:.78rem;color:var(--red)">— IPRES salarié (6%)</span>
                        <span style="font-family:var(--mono);font-size:.78rem;color:var(--red)">
                            -{{ number_format(round($stats['masse_salariale']*0.06),0,',',' ') }} XOF
                        </span>
                    </div>
                    <div class="summary-row" style="border-top:2px solid var(--border);margin-top:8px">
                        <span style="font-size:.8rem;font-weight:800">Net à payer</span>
                        <span style="font-family:var(--mono);font-size:.88rem;font-weight:800;color:var(--green)">
                            {{ number_format($stats['net_total'],0,',',' ') }} XOF
                        </span>
                    </div>
                    <div style="border-top:1px dashed var(--border);margin-top:12px;padding-top:12px">
                        <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text3);margin-bottom:8px">
                            Charges patronales
                        </div>
                        <div class="summary-row">
                            <span style="font-size:.76rem;color:var(--orange)">CNSS patronal (7%)</span>
                            <span style="font-family:var(--mono);font-size:.76rem;color:var(--orange)">
                                {{ number_format(round($stats['masse_salariale']*0.07),0,',',' ') }} XOF
                            </span>
                        </div>
                        <div class="summary-row">
                            <span style="font-size:.76rem;color:var(--orange)">IPRES patronal (3.6%)</span>
                            <span style="font-family:var(--mono);font-size:.76rem;color:var(--orange)">
                                {{ number_format(round($stats['masse_salariale']*0.036),0,',',' ') }} XOF
                            </span>
                        </div>
                        <div class="summary-row total" style="border-top:1px solid var(--border);margin-top:4px">
                            <span style="color:var(--orange)">Total charges patronales</span>
                            <span style="font-family:var(--mono);color:var(--orange)">
                                {{ number_format(round($stats['masse_salariale']*0.106),0,',',' ') }} XOF
                            </span>
                        </div>
                        <div class="summary-row total">
                            <span>Coût total employeur</span>
                            <span style="font-family:var(--mono);color:var(--text)">
                                {{ number_format(round($stats['masse_salariale']*1.106),0,',',' ') }} XOF
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RÉPARTITION CONTRATS -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="pie-chart" style="width:13px;height:13px;stroke:var(--purple)"></i>
                    Répartition par contrat
                </span>
            </div>
            <div style="padding:16px">
                @php
                $total_emp = $stats['total_employes'] ?: 1;
                $colors    = ['CDI'=>'var(--green)','CDD'=>'var(--blue)','Intérim'=>'var(--orange)','Stage'=>'var(--purple)'];
                @endphp
                @foreach($repartition as $type => $count)
                <div style="margin-bottom:12px">
                    <div style="display:flex;justify-content:space-between;margin-bottom:3px">
                        <span style="font-size:.76rem;font-weight:600">{{ $type }}</span>
                        <span style="font-size:.72rem;font-family:var(--mono);color:var(--text2)">
                            {{ $count }} ({{ round($count/$total_emp*100) }}%)
                        </span>
                    </div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:{{ $count/$total_emp*100 }}%;background:{{ $colors[$type] ?? 'var(--blue)' }}"></div>
                    </div>
                </div>
                @endforeach

                <div style="margin-top:16px;padding-top:14px;border-top:1px solid var(--border)">
                    <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text3);margin-bottom:10px">
                        Salaire moyen par structure
                    </div>
                    @foreach($employes->groupBy(fn($e)=>optional($e->structure)->nom ?? 'N/A') as $struct => $emps)
                    <div style="display:flex;justify-content:space-between;padding:5px 0;border-bottom:1px solid var(--border)">
                        <span style="font-size:.74rem">{{ $struct }}</span>
                        <span style="font-family:var(--mono);font-size:.72rem;color:var(--text2)">
                            {{ number_format($emps->avg('salaire_base'),0,',',' ') }} XOF
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- TABLEAU DÉTAILLÉ -->
    <div class="card">
        <div class="card-head">
            <span class="card-title">
                <i data-lucide="table" style="width:13px;height:13px;stroke:var(--blue)"></i>
                Détail de la paie — {{ $periode }}
                <span style="font-size:.66rem;font-weight:800;background:var(--blue-bg);color:var(--blue);padding:2px 8px;border-radius:10px;border:1px solid var(--blue-bd)">
                    {{ $employes->count() }} employés
                </span>
            </span>
            <div style="display:flex;gap:6px">
                <a href="{{ route('comptable.export.pdf') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="file-text" style="width:11px;height:11px"></i> PDF
                </a>
                <a href="{{ route('comptable.export.csv') }}" class="btn btn-success btn-sm">
                    <i data-lucide="download" style="width:11px;height:11px"></i> CSV
                </a>
            </div>
        </div>
        <div class="tw">
            <table class="dt">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Employé</th>
                        <th>Poste</th>
                        <th>Structure</th>
                        <th>Contrat</th>
                        <th style="text-align:right">Brut (XOF)</th>
                        <th style="text-align:right">CNSS 4%</th>
                        <th style="text-align:right">IPRES 6%</th>
                        <th style="text-align:right">Net (XOF)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employes as $e)
                    @php
                        $b     = $e->salaire_base;
                        $cnss  = round($b * 0.04);
                        $ipres = round($b * 0.06);
                        $net   = $b - $cnss - $ipres;
                        $contratBadge = match($e->contrat) {
                            'CDI'     => 'bg',
                            'CDD'     => 'bb',
                            'Intérim' => 'bo',
                            default   => 'bp',
                        };
                        $color = $EC[$loop->index % count($EC)];
                    @endphp
                    <tr>
                        <td style="font-family:var(--mono);font-size:.7rem;color:var(--text3)">
                            {{ $e->matricule ?? '—' }}
                        </td>
                        <td>
                            <div class="nc">
                                <div class="nav-av" style="background:{{ $color }}">
                                    {{ strtoupper(substr($e->prenom,0,1).substr($e->nom,0,1)) }}
                                </div>
                                <div>
                                    <div class="nc-n">{{ $e->prenom }} {{ $e->nom }}</div>
                                    <div style="font-size:.66rem;color:var(--text3)">{{ $e->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:.74rem">{{ $e->poste?->nom ?? '—' }}</td>
                        <td><span class="badge bb">{{ $e->structure?->nom ?? '—' }}</span></td>
                        <td><span class="badge {{ $contratBadge }}">{{ $e->contrat }}</span></td>
                        <td style="text-align:right;font-family:var(--mono);font-size:.76rem;font-weight:600">
                            {{ number_format($b,0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);font-size:.74rem;color:var(--red)">
                            -{{ number_format($cnss,0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);font-size:.74rem;color:var(--red)">
                            -{{ number_format($ipres,0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);font-size:.76rem;font-weight:800;color:var(--green)">
                            {{ number_format($net,0,',',' ') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="font-size:.76rem">
                            TOTAUX — {{ $employes->count() }} employés
                        </td>
                        <td style="text-align:right;font-family:var(--mono)">
                            {{ number_format($stats['masse_salariale'],0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);color:var(--red)">
                            -{{ number_format(round($stats['masse_salariale']*0.04),0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);color:var(--red)">
                            -{{ number_format(round($stats['masse_salariale']*0.06),0,',',' ') }}
                        </td>
                        <td style="text-align:right;font-family:var(--mono);color:var(--green)">
                            {{ number_format($stats['net_total'],0,',',' ') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<div class="toast" id="toast"></div>

<script>
function showToast(m,t='success'){
    const el=document.getElementById('toast');
    el.textContent=m;
    el.className='toast show '+t;
    clearTimeout(el._t);
    el._t=setTimeout(()=>el.classList.remove('show'),3000);
}

let currentTheme=localStorage.getItem('sc-theme')||'dark';
function toggleTheme(){
    currentTheme=currentTheme==='dark'?'light':'dark';
    document.documentElement.setAttribute('data-theme',currentTheme);
    localStorage.setItem('sc-theme',currentTheme);
    const icon=document.getElementById('theme-icon');
    if(icon)icon.setAttribute('data-lucide',currentTheme==='dark'?'sun':'moon');
    lucide.createIcons();
}
document.documentElement.setAttribute('data-theme',currentTheme);

document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const icon=document.getElementById('theme-icon');
    if(icon)icon.setAttribute('data-lucide',currentTheme==='dark'?'sun':'moon');
    lucide.createIcons();
});
</script>
</body>
</html>
