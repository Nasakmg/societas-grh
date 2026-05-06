<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Societas GRH — Manager</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root{--font:'Inter',sans-serif;--mono:'JetBrains Mono',monospace;--r:6px;--r-lg:10px;--transition:.15s ease;}
[data-theme="dark"]{--bg:#0e1117;--bg2:#13161f;--surface:#1a1f2e;--s2:#20253a;--s3:#272d42;--border:rgba(255,255,255,.07);--text:#e8ecf4;--text2:#8b93a8;--text3:#4a5268;--blue:#4f7cf7;--blue-bg:rgba(79,124,247,.12);--blue-bd:rgba(79,124,247,.3);--green:#22c55e;--green-bg:rgba(34,197,94,.12);--orange:#f59e0b;--orange-bg:rgba(245,158,11,.12);--red:#ef4444;--red-bg:rgba(239,68,68,.12);--purple:#a855f7;--purple-bg:rgba(168,85,247,.12);--shadow:0 8px 24px rgba(0,0,0,.5);}
[data-theme="light"]{--bg:#f1f5f9;--bg2:#ffffff;--surface:#ffffff;--s2:#f8fafc;--s3:#f1f5f9;--border:rgba(0,0,0,.08);--text:#0f172a;--text2:#64748b;--text3:#94a3b8;--blue:#2563eb;--blue-bg:rgba(37,99,235,.08);--blue-bd:rgba(37,99,235,.25);--green:#16a34a;--green-bg:rgba(22,163,74,.08);--orange:#d97706;--orange-bg:rgba(217,119,6,.08);--red:#dc2626;--red-bg:rgba(220,38,38,.08);--purple:#7c3aed;--purple-bg:rgba(124,58,237,.08);--shadow:0 4px 16px rgba(0,0,0,.08);}
*{margin:0;padding:0;box-sizing:border-box;}
html{font-size:13px;}
body{font-family:var(--font);background:var(--bg);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased;}
.topbar{height:52px;background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 20px;gap:12px;position:sticky;top:0;z-index:100;}
.tb-logo{font-weight:800;font-size:.9rem;color:var(--blue);}
.tb-role{font-size:.7rem;font-weight:700;background:var(--orange-bg);color:var(--orange);padding:2px 8px;border-radius:8px;}
.tb-right{display:flex;align-items:center;gap:8px;margin-left:auto;}
.tb-btn{width:30px;height:30px;border-radius:var(--r);background:var(--surface);border:1px solid var(--border);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;}
.tb-pav{width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--orange),var(--red));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;}
.content{padding:24px;max-width:1200px;margin:0 auto;}
.pg-title{font-size:1.2rem;font-weight:700;margin-bottom:4px;}
.pg-sub{font-size:.76rem;color:var(--text2);margin-bottom:20px;}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;}
.stat-ic{width:34px;height:34px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;margin-bottom:8px;}
.stat-val{font-size:1.4rem;font-weight:800;font-family:var(--mono);}
.stat-lbl{font-size:.68rem;color:var(--text2);}
.g2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;}
.card-head{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;border-bottom:1px solid var(--border);}
.card-title{font-weight:700;font-size:.82rem;display:flex;align-items:center;gap:6px;}
.card-body{padding:14px;}
.tw{overflow-x:auto;}
.dt{width:100%;border-collapse:collapse;}
.dt th{text-align:left;padding:8px 12px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--text3);background:var(--bg2);border-bottom:1px solid var(--border);}
.dt td{padding:9px 12px;font-size:.78rem;color:var(--text2);border-bottom:1px solid rgba(255,255,255,.04);}
.dt tr:last-child td{border-bottom:none;}
.dt tr:hover td{background:rgba(255,255,255,.015);}
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:4px;font-size:.66rem;font-weight:700;}
.bg{background:var(--green-bg);color:var(--green);}
.br{background:var(--red-bg);color:var(--red);}
.bo{background:var(--orange-bg);color:var(--orange);}
.bb{background:var(--blue-bg);color:var(--blue);}
.cg-card{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:var(--r);background:var(--s2);border:1px solid var(--border);margin-bottom:6px;}
.cg-av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;flex-shrink:0;}
.cg-info{flex:1;}
.cg-name{font-weight:600;font-size:.78rem;}
.cg-det{font-size:.68rem;color:var(--text2);margin-top:1px;}
.cg-acts{display:flex;gap:4px;}
.btn{display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:var(--r);font-size:.76rem;font-weight:600;cursor:pointer;border:none;font-family:var(--font);}
.btn-success{background:var(--green);color:white;}
.btn-danger{background:var(--red);color:white;}
.btn-sm{padding:4px 9px;font-size:.7rem;}
.btn-ghost{background:var(--s2);border:1px solid var(--border);color:var(--text2);}
.nc{display:flex;align-items:center;gap:8px;}
.nav-av{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.6rem;color:white;flex-shrink:0;}
.nc-n{font-weight:600;font-size:.78rem;color:var(--text);}
.toast{position:fixed;bottom:16px;right:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:8px 13px;box-shadow:var(--shadow);z-index:9999;font-size:.78rem;font-weight:600;display:none;align-items:center;gap:6px;}
.toast.show{display:flex;}
.toast.success{border-left:3px solid var(--green);color:var(--green);}
.toast.error{border-left:3px solid var(--red);color:var(--red);}
@media(max-width:768px){.stats-grid{grid-template-columns:1fr 1fr;}.g2{grid-template-columns:1fr;}}
</style>
</head>
<body>
@php
$u    = Auth::user();
$init = strtoupper(substr($u->name ?? 'MG', 0, 2));
@endphp

<div class="topbar">
    <span class="tb-logo">S</span>
    <span style="font-weight:700;font-size:.88rem;">Societas GRH</span>
    <span class="tb-role">Manager</span>
    <div class="tb-right">
        <button class="tb-btn" onclick="toggleTheme()">
            <i data-lucide="sun" style="width:13px;height:13px" id="theme-icon"></i>
        </button>
        <div class="tb-pav">{{ $init }}</div>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm">
                <i data-lucide="log-out" style="width:11px;height:11px"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="content">
    <div class="pg-title">
        Bonjour {{ $u->name }} 👋
    </div>
    <div class="pg-sub">
        Tableau de bord Manager — Gérez votre équipe
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--blue-bg)">
                <i data-lucide="users" style="width:15px;height:15px;stroke:var(--blue)"></i>
            </div>
            <div class="stat-val">{{ $stats['total_equipe'] }}</div>
            <div class="stat-lbl">Mon équipe</div>
        </div>
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--green-bg)">
                <i data-lucide="check-circle" style="width:15px;height:15px;stroke:var(--green)"></i>
            </div>
            <div class="stat-val">{{ $stats['presents'] }}</div>
            <div class="stat-lbl">Présents aujourd'hui</div>
        </div>
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--red-bg)">
                <i data-lucide="x-circle" style="width:15px;height:15px;stroke:var(--red)"></i>
            </div>
            <div class="stat-val">{{ $stats['absents'] }}</div>
            <div class="stat-lbl">Absents</div>
        </div>
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--orange-bg)">
                <i data-lucide="clock" style="width:15px;height:15px;stroke:var(--orange)"></i>
            </div>
            <div class="stat-val">{{ $stats['conges_attente'] }}</div>
            <div class="stat-lbl">Congés en attente</div>
        </div>
    </div>

    <div class="g2">
        <!-- CONGÉS EN ATTENTE -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="clock" style="width:13px;height:13px;stroke:var(--orange)"></i>
                    Congés à valider
                </span>
                <span class="badge bo">{{ $conges_attente->count() }}</span>
            </div>
            <div class="card-body" style="padding:8px 10px">
                @forelse($conges_attente as $cg)
                <div class="cg-card" id="cg-{{ $cg->id }}">
                    <div class="cg-av" style="background:#4f7cf7">
                        {{ strtoupper(substr($cg->employe->prenom,0,1).substr($cg->employe->nom,0,1)) }}
                    </div>
                    <div class="cg-info">
                        <div class="cg-name">{{ $cg->employe->prenom }} {{ $cg->employe->nom }}</div>
                        <div class="cg-det">
                            {{ $cg->type }} · {{ \Carbon\Carbon::parse($cg->date_debut)->format('d/m/Y') }}
                            → {{ \Carbon\Carbon::parse($cg->date_fin)->format('d/m/Y') }}
                            ({{ $cg->nb_jours }} j.)
                        </div>
                    </div>
                    <div class="cg-acts">
                        <button class="btn btn-success btn-sm"
                            onclick="validerConge({{ $cg->id }}, 'Approuvé')">
                            <i data-lucide="check" style="width:10px;height:10px"></i>
                        </button>
                        <button class="btn btn-danger btn-sm"
                            onclick="validerConge({{ $cg->id }}, 'Refusé')">
                            <i data-lucide="x" style="width:10px;height:10px"></i>
                        </button>
                    </div>
                </div>
                @empty
                <p style="text-align:center;color:var(--text3);padding:16px;font-size:.76rem">
                    Aucune demande en attente ✅
                </p>
                @endforelse
            </div>
        </div>

        <!-- MON ÉQUIPE -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="users" style="width:13px;height:13px;stroke:var(--blue)"></i>
                    Mon équipe
                </span>
            </div>
            <div class="tw">
                <table class="dt">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Poste</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipe as $emp)
                        <tr>
                            <td>
                                <div class="nc">
                                    <div class="nav-av" style="background:#4f7cf7">
                                        {{ strtoupper(substr($emp->prenom,0,1).substr($emp->nom,0,1)) }}
                                    </div>
                                    <div>
                                        <div class="nc-n">{{ $emp->prenom }} {{ $emp->nom }}</div>
                                        <div style="font-size:.66rem;color:var(--text3)">{{ $emp->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.74rem">{{ $emp->poste?->nom ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $emp->statut === 'Actif' ? 'bg' : 'bo' }}">
                                    {{ $emp->statut }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:var(--text3);padding:16px">
                                Aucun employé dans votre équipe
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PRÉSENCES AUJOURD'HUI -->
    <div class="card">
        <div class="card-head">
            <span class="card-title">
                <i data-lucide="calendar" style="width:13px;height:13px;stroke:var(--green)"></i>
                Présences aujourd'hui
            </span>
            <span style="font-size:.72rem;color:var(--text2)">
                {{ now()->format('d/m/Y') }}
            </span>
        </div>
        <div class="tw">
            <table class="dt">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presences as $p)
                    <tr>
                        <td>
                            <div class="nc">
                                <div class="nav-av" style="background:#059669">
                                    {{ strtoupper(substr($p->employe->prenom,0,1).substr($p->employe->nom,0,1)) }}
                                </div>
                                <span style="font-weight:600;font-size:.78rem">
                                    {{ $p->employe->prenom }} {{ $p->employe->nom }}
                                </span>
                            </div>
                        </td>
                        <td style="font-family:var(--mono);font-size:.72rem">
                            {{ $p->heure_arrivee ?? '—' }}
                        </td>
                        <td style="font-family:var(--mono);font-size:.72rem">
                            {{ $p->heure_depart ?? '—' }}
                        </td>
                        <td>
                            <span class="badge {{ $p->statut === 'Présent' ? 'bg' : ($p->statut === 'Absent' ? 'br' : 'bo') }}">
                                {{ $p->statut }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--text3);padding:16px">
                            Aucune présence enregistrée aujourd'hui
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showToast(m, t='success') {
    const el = document.getElementById('toast');
    el.textContent = m;
    el.className = 'toast show ' + t;
    clearTimeout(el._t);
    el._t = setTimeout(() => el.classList.remove('show'), 3000);
}

function validerConge(id, statut) {
    fetch(`/manager/conges/${id}/valider`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ statut })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('cg-' + id)?.remove();
            showToast(statut === 'Approuvé' ? 'Congé approuvé ✅' : 'Congé refusé', 'success');
        }
    })
    .catch(() => showToast('Erreur réseau', 'error'));
}

let currentTheme = localStorage.getItem('sc-theme') || 'dark';
function toggleTheme() {
    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', currentTheme);
    localStorage.setItem('sc-theme', currentTheme);
    lucide.createIcons();
}
document.documentElement.setAttribute('data-theme', currentTheme);

document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
});
</script>
</body>
</html>
