<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Societas GRH — Mon Espace</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root{--font:'Inter',sans-serif;--mono:'JetBrains Mono',monospace;--r:6px;--r-lg:10px;--transition:.15s ease;}
[data-theme="dark"]{--bg:#0e1117;--bg2:#13161f;--surface:#1a1f2e;--s2:#20253a;--s3:#272d42;--border:rgba(255,255,255,.07);--text:#e8ecf4;--text2:#8b93a8;--text3:#4a5268;--blue:#4f7cf7;--blue-bg:rgba(79,124,247,.12);--blue-bd:rgba(79,124,247,.3);--green:#22c55e;--green-bg:rgba(34,197,94,.12);--orange:#f59e0b;--orange-bg:rgba(245,158,11,.12);--red:#ef4444;--red-bg:rgba(239,68,68,.12);--purple:#a855f7;--purple-bg:rgba(168,85,247,.12);--shadow:0 8px 24px rgba(0,0,0,.5);}
[data-theme="light"]{--bg:#f1f5f9;--bg2:#ffffff;--surface:#ffffff;--s2:#f8fafc;--s3:#f1f5f9;--border:rgba(0,0,0,.08);--text:#0f172a;--text2:#64748b;--text3:#94a3b8;--blue:#2563eb;--blue-bg:rgba(37,99,235,.08);--blue-bd:rgba(37,99,235,.25);--green:#16a34a;--green-bg:rgba(22,163,74,.08);--orange:#d97706;--orange-bg:rgba(217,119,6,.08);--red:#dc2626;--red-bg:rgba(220,38,38,.08);--purple:#7c3aed;--purple-bg:rgba(124,58,237,.08);--shadow:0 4px 16px rgba(0,0,0,.08);}
*{margin:0;padding:0;box-sizing:border-box;}
html{font-size:13px;}
body{font-family:var(--font);background:var(--bg);color:var(--text);min-height:100vh;}
.topbar{height:52px;background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 20px;gap:12px;position:sticky;top:0;z-index:100;}
.tb-logo{font-weight:800;font-size:.9rem;color:var(--blue);}
.tb-role{font-size:.7rem;font-weight:700;background:var(--purple-bg);color:var(--purple);padding:2px 8px;border-radius:8px;}
.tb-right{display:flex;align-items:center;gap:8px;margin-left:auto;}
.tb-pav{width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;color:white;}
.content{padding:24px;max-width:1100px;margin:0 auto;}
.pg-title{font-size:1.2rem;font-weight:700;margin-bottom:4px;}
.pg-sub{font-size:.76rem;color:var(--text2);margin-bottom:20px;}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;}
.stat-ic{width:34px;height:34px;border-radius:var(--r);display:flex;align-items:center;justify-content:center;margin-bottom:8px;}
.stat-val{font-size:1.4rem;font-weight:800;font-family:var(--mono);}
.stat-lbl{font-size:.68rem;color:var(--text2);}
.g2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;margin-bottom:14px;}
.card-head{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;border-bottom:1px solid var(--border);}
.card-title{font-weight:700;font-size:.82rem;display:flex;align-items:center;gap:6px;}
.card-body{padding:14px;}
.tw{overflow-x:auto;}
.dt{width:100%;border-collapse:collapse;}
.dt th{text-align:left;padding:8px 12px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--text3);background:var(--bg2);border-bottom:1px solid var(--border);}
.dt td{padding:9px 12px;font-size:.78rem;color:var(--text2);border-bottom:1px solid rgba(255,255,255,.04);}
.badge{display:inline-flex;padding:2px 8px;border-radius:4px;font-size:.66rem;font-weight:700;}
.bg{background:var(--green-bg);color:var(--green);}
.br{background:var(--red-bg);color:var(--red);}
.bo{background:var(--orange-bg);color:var(--orange);}
.bb{background:var(--blue-bg);color:var(--blue);}
.btn{display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:var(--r);font-size:.76rem;font-weight:600;cursor:pointer;border:none;font-family:var(--font);}
.btn-primary{background:var(--blue);color:white;}
.btn-ghost{background:var(--s2);border:1px solid var(--border);color:var(--text2);}
.btn-sm{padding:4px 9px;font-size:.7rem;}
.fl{font-size:.66rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text2);display:block;margin-bottom:4px;}
.fc{background:var(--s2);border:1px solid var(--border);border-radius:var(--r);padding:7px 10px;color:var(--text);font-family:var(--font);font-size:.78rem;outline:none;width:100%;margin-bottom:10px;}
.fc:focus{border-color:var(--blue);}
.fg2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);backdrop-filter:blur(4px);z-index:700;display:none;align-items:center;justify-content:center;}
.overlay.open{display:flex;}
.modal{background:var(--surface);border:1px solid var(--border);border-radius:12px;width:90%;max-width:480px;padding:0;}
.modal-head{display:flex;align-items:center;justify-content:space-between;padding:13px 16px;border-bottom:1px solid var(--border);}
.modal-title{font-weight:700;font-size:.86rem;}
.modal-body{padding:16px;}
.modal-foot{display:flex;justify-content:flex-end;gap:6px;padding:11px 16px;border-top:1px solid var(--border);}
.modal-close{width:24px;height:24px;border-radius:5px;background:var(--s2);border:1px solid var(--border);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;}
.profil-header{display:flex;align-items:center;gap:16px;padding:20px;background:var(--blue-bg);border-radius:var(--r-lg);margin-bottom:16px;border:1px solid var(--blue-bd);}
.profil-av{width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;color:white;flex-shrink:0;}
.toast{position:fixed;bottom:16px;right:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:8px 13px;box-shadow:var(--shadow);z-index:9999;font-size:.78rem;font-weight:600;display:none;align-items:center;gap:6px;}
.toast.show{display:flex;}
.toast.success{border-left:3px solid var(--green);color:var(--green);}
.toast.error{border-left:3px solid var(--red);color:var(--red);}
@media(max-width:768px){.stats-grid{grid-template-columns:1fr 1fr;}.g2{grid-template-columns:1fr;}.fg2{grid-template-columns:1fr;}}
</style>
</head>
<body>
@php
$u    = Auth::user();
$init = strtoupper(substr($u->name ?? 'EM', 0, 2));
@endphp

<div class="topbar">
    <span class="tb-logo">S</span>
    <span style="font-weight:700;font-size:.88rem;">Societas GRH</span>
    <span class="tb-role">Mon Espace</span>
    <div class="tb-right">
        <button class="btn btn-ghost btn-sm" onclick="toggleTheme()">
            <i data-lucide="sun" style="width:11px;height:11px" id="theme-icon"></i>
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

    @if($employe)
    <!-- PROFIL HEADER -->
    <div class="profil-header">
        <div class="profil-av">{{ $init }}</div>
        <div>
            <div style="font-size:1rem;font-weight:800">{{ $employe->prenom }} {{ $employe->nom }}</div>
            <div style="font-size:.76rem;color:var(--text2);margin-top:2px">
                {{ $employe->poste?->nom ?? '—' }} · {{ $employe->structure?->nom ?? '—' }}
            </div>
            <div style="display:flex;gap:6px;margin-top:6px">
                <span class="badge bb">{{ $employe->contrat }}</span>
                <span class="badge bg">{{ $employe->statut }}</span>
                <span style="font-size:.68rem;color:var(--text3);font-family:var(--mono)">
                    {{ $employe->matricule ?? '—' }}
                </span>
            </div>
        </div>
        <div style="margin-left:auto">
            <button class="btn btn-primary btn-sm" onclick="openModal('modal-cg')">
                <i data-lucide="plus" style="width:11px;height:11px"></i> Demander un congé
            </button>
        </div>
    </div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--green-bg)">
                <i data-lucide="calendar-check" style="width:15px;height:15px;stroke:var(--green)"></i>
            </div>
            <div class="stat-val">{{ $stats['conges_restants'] }}</div>
            <div class="stat-lbl">Jours de congé restants</div>
        </div>
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--orange-bg)">
                <i data-lucide="clock" style="width:15px;height:15px;stroke:var(--orange)"></i>
            </div>
            <div class="stat-val">{{ $stats['conges_en_attente'] }}</div>
            <div class="stat-lbl">Demandes en attente</div>
        </div>
        <div class="stat-card">
            <div class="stat-ic" style="background:var(--blue-bg)">
                <i data-lucide="check" style="width:15px;height:15px;stroke:var(--blue)"></i>
            </div>

        <div class="stat-card">
            <div class="stat-ic" style="background:var(--red-bg)">
                <i data-lucide="x" style="width:15px;height:15px;stroke:var(--red)"></i>
            </div>
            <div class="stat-val">{{ $stats['absences'] }}</div>
            <div class="stat-lbl">Absences ce mois</div>
        </div>
    </div>

    <div class="g2">
        <!-- MES CONGÉS -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="calendar-days" style="width:13px;height:13px;stroke:var(--orange)"></i>
                    Mes congés
                </span>
                <button class="btn btn-primary btn-sm" onclick="openModal('modal-cg')">
                    <i data-lucide="plus" style="width:10px;height:10px"></i> Nouveau
                </button>
            </div>
            <div class="tw">
                <table class="dt">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Période</th>
                            <th>Jours</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($conges as $cg)
                        <tr>
                            <td style="font-size:.74rem">{{ $cg->type }}</td>
                            <td style="font-family:var(--mono);font-size:.7rem">
                                {{ \Carbon\Carbon::parse($cg->date_debut)->format('d/m') }}
                                → {{ \Carbon\Carbon::parse($cg->date_fin)->format('d/m/Y') }}
                            </td>
                            <td style="font-family:var(--mono);font-size:.74rem">{{ $cg->nb_jours }}j</td>
                            <td>
                                <span class="badge {{ $cg->statut === 'Approuvé' ? 'bg' : ($cg->statut === 'Refusé' ? 'br' : 'bo') }}">
                                    {{ $cg->statut }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--text3);padding:16px">
                                Aucun congé pour le moment
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MES PRÉSENCES DU MOIS -->
        <div class="card">
            <div class="card-head">
                <span class="card-title">
                    <i data-lucide="clock" style="width:13px;height:13px;stroke:var(--blue)"></i>
                    Présences — {{ now()->isoFormat('MMMM YYYY') }}
                </span>
            </div>
            <div class="tw">
                <table class="dt">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Arrivée</th>
                            <th>Départ</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presences->take(10) as $p)
                        <tr>
                            <td style="font-family:var(--mono);font-size:.7rem">
                                {{ \Carbon\Carbon::parse($p->date)->format('d/m/Y') }}
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
                                Aucune présence enregistrée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MES FICHES DE PAIE -->
    <div class="card">
        <div class="card-head">
            <span class="card-title">
                <i data-lucide="file-text" style="width:13px;height:13px;stroke:var(--green)"></i>
                Mes bulletins de paie
            </span>
        </div>
        <div class="tw">
            <table class="dt">
                <thead>
                    <tr>
                        <th>Période</th>
                        <th>Salaire brut</th>
                        <th>Cotisations</th>
                        <th>Net à payer</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fiches_paie as $fp)
                    <tr>
                        <td style="font-weight:600;font-size:.76rem">{{ $fp->periode }}</td>
                        <td style="font-family:var(--mono);font-size:.74rem">
                            {{ number_format($fp->salaire_brut, 0, ',', ' ') }} XOF
                        </td>
                        <td style="font-family:var(--mono);font-size:.74rem;color:var(--red)">
                            -{{ number_format($fp->cnss_employe + $fp->ipres_employe, 0, ',', ' ') }} XOF
                        </td>
                        <td style="font-family:var(--mono);font-size:.74rem;font-weight:800;color:var(--green)">
                            {{ number_format($fp->salaire_net, 0, ',', ' ') }} XOF
                        </td>
                        <td><span class="badge bg">{{ $fp->statut }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:var(--text3);padding:16px">
                            Aucun bulletin disponible
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL DEMANDE CONGÉ -->
<div class="overlay" id="modal-cg">
    <div class="modal">
        <div class="modal-head">
            <span class="modal-title">Nouvelle demande de congé</span>
            <button class="modal-close" onclick="closeModal('modal-cg')">
                <i data-lucide="x" style="width:11px;height:11px"></i>
            </button>
        </div>
        <div class="modal-body">
            <label class="fl">Type de congé</label>
            <select class="fc" id="cg-type">
                <option>Congé annuel</option>
                <option>Congé maladie</option>
                <option>Congé maternité</option>
                <option>Congé sans solde</option>
                <option>RTT</option>
            </select>
            <div class="fg2">
                <div>
                    <label class="fl">Date début *</label>
                    <input class="fc" type="date" id="cg-deb">
                </div>
                <div>
                    <label class="fl">Date fin *</label>
                    <input class="fc" type="date" id="cg-fin">
                </div>
            </div>
            <label class="fl">Motif</label>
            <textarea class="fc" id="cg-motif" rows="2" placeholder="Optionnel..."></textarea>
        </div>
        <div class="modal-foot">
            <button class="btn btn-ghost btn-sm" onclick="closeModal('modal-cg')">Annuler</button>
            <button class="btn btn-primary btn-sm" onclick="submitConge()">
                <i data-lucide="send" style="width:11px;height:11px"></i> Soumettre
            </button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function openModal(id)  { document.getElementById(id).classList.add('open'); lucide.createIcons(); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.overlay').forEach(o =>
    o.addEventListener('click', e => { if(e.target === o) o.classList.remove('open'); })
);

function showToast(m, t='success') {
    const el = document.getElementById('toast');
    el.textContent = m;
    el.className = 'toast show ' + t;
    clearTimeout(el._t);
    el._t = setTimeout(() => el.classList.remove('show'), 3000);
}

function submitConge() {
    const deb   = document.getElementById('cg-deb').value;
    const fin   = document.getElementById('cg-fin').value;
    const type  = document.getElementById('cg-type').value;
    const motif = document.getElementById('cg-motif').value;

    if (!deb || !fin) { showToast('Dates requises', 'error'); return; }

    fetch('/employe/conges', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ type, date_debut: deb, date_fin: fin, motif })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeModal('modal-cg');
            showToast('Demande soumise ! En attente de validation ✅');
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(() => showToast('Erreur réseau', 'error'));
}

let currentTheme = localStorage.getItem('sc-theme') || 'dark';
function toggleTheme() {
    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', currentTheme);
    localStorage.setItem('sc-theme', currentTheme);
    const icon = document.getElementById('theme-icon');
    if (icon) icon.setAttribute('data-lucide', currentTheme === 'dark' ? 'sun' : 'moon');
    lucide.createIcons();
}
document.documentElement.setAttribute('data-theme', currentTheme);

document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>
</body>
</html>
