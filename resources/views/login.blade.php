<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Societas GRH — Connexion</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root {
  --blue:#1a56db; --blue-dark:#1341b0; --blue-light:#eff6ff;
  --navy:#0f1f3d; --white:#ffffff;
  --gray-50:#f9fafb; --gray-100:#f3f4f6; --gray-200:#e5e7eb;
  --gray-400:#9ca3af; --gray-500:#6b7280; --gray-700:#374151; --gray-900:#111827;
  --green:#059669; --red:#dc2626;
  --font:'Sora',sans-serif; --font-body:'DM Sans',sans-serif;
}
*{margin:0;padding:0;box-sizing:border-box;}
html{font-size:16px;}
body{font-family:var(--font-body);min-height:100vh;display:flex;-webkit-font-smoothing:antialiased;}

/* LEFT — image */
.left {
  flex:1;
  background:
    linear-gradient(120deg, rgba(15,31,61,.9) 0%, rgba(26,86,219,.5) 100%),
    url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1400&q=80') center/cover no-repeat;
  display:flex; flex-direction:column;
  justify-content:space-between;
  padding:48px;
  position:relative; overflow:hidden;
}
.left::before {
  content:''; position:absolute;
  bottom:-100px; right:-100px;
  width:400px; height:400px;
  border-radius:50%;
  background:rgba(26,86,219,.15);
  filter:blur(60px);
}
.left-logo { display:flex; align-items:center; gap:10px; text-decoration:none; position:relative; z-index:1; }
.left-logo-mark { width:38px; height:38px; background:var(--blue); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-weight:800; font-size:.9rem; font-family:var(--font); }
.left-logo-name { font-family:var(--font); font-weight:700; font-size:1.05rem; color:white; }
.left-logo-name span { color:#93c5fd; }

.left-content { position:relative; z-index:1; }
.left-title {
  font-family:var(--font);
  font-size:2.4rem; font-weight:800;
  color:white; line-height:1.15;
  margin-bottom:16px; letter-spacing:-.3px;
}
.left-title span { color:#93c5fd; }
.left-sub { font-size:.95rem; color:rgba(255,255,255,.55); line-height:1.7; max-width:400px; margin-bottom:36px; }

.left-features { display:flex; flex-direction:column; gap:12px; }
.lf-item { display:flex; align-items:center; gap:12px; }
.lf-check {
  width:28px; height:28px; border-radius:50%;
  background:rgba(26,86,219,.25);
  border:1px solid rgba(26,86,219,.4);
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0;
}
.lf-text { font-size:.85rem; color:rgba(255,255,255,.7); }

.left-footer { position:relative; z-index:1; }
.left-footer a { font-size:.78rem; color:rgba(255,255,255,.35); text-decoration:none; }
.left-footer a:hover { color:rgba(255,255,255,.6); }

/* RIGHT — form */
.right {
  width:480px; flex-shrink:0;
  background:white;
  display:flex; flex-direction:column;
  justify-content:center;
  padding:48px 44px;
  position:relative;
}
.back-link {
  position:absolute; top:24px; right:24px;
  display:flex; align-items:center; gap:6px;
  font-size:.78rem; font-weight:600; color:var(--gray-400);
  text-decoration:none; transition:color .2s;
  background:var(--gray-50); border:1px solid var(--gray-200);
  padding:6px 12px; border-radius:8px;
}
.back-link:hover { color:var(--gray-700); }

.form-head { margin-bottom:28px; }
.form-head h1 { font-family:var(--font); font-size:1.6rem; font-weight:800; color:var(--gray-900); margin-bottom:6px; }
.form-head p { font-size:.86rem; color:var(--gray-500); }

/* Role tabs */
.role-tabs { display:flex; background:var(--gray-100); border-radius:10px; padding:4px; margin-bottom:24px; gap:3px; }
.role-tab {
  flex:1; padding:9px 6px; text-align:center;
  border-radius:7px; cursor:pointer;
  font-size:.76rem; font-weight:600;
  color:var(--gray-500);
  transition:all .18s; border:none; background:none;
  font-family:var(--font);
  display:flex; align-items:center; justify-content:center; gap:5px;
}
.role-tab.active { background:white; color:var(--blue); box-shadow:0 2px 8px rgba(0,0,0,.1); }

/* Alerts */
.alert-err {
  background:#fef2f2; border:1px solid #fecaca;
  border-radius:8px; padding:10px 14px;
  font-size:.82rem; color:var(--red);
  margin-bottom:16px; display:flex; align-items:center; gap:8px;
}
.alert-ok {
  background:#f0fdf4; border:1px solid #bbf7d0;
  border-radius:8px; padding:10px 14px;
  font-size:.82rem; color:var(--green);
  margin-bottom:16px; display:flex; align-items:center; gap:8px;
}

/* Form fields */
.fg { margin-bottom:14px; }
.fl { display:block; font-size:.72rem; font-weight:700; color:var(--gray-500); text-transform:uppercase; letter-spacing:.5px; margin-bottom:5px; }
.fi-wrap { position:relative; }
.fi-icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--gray-400); width:16px; height:16px; }
.fc {
  width:100%; background:var(--gray-50);
  border:1.5px solid var(--gray-200);
  border-radius:10px; padding:11px 14px 11px 40px;
  color:var(--gray-900); font-family:var(--font-body);
  font-size:.88rem; outline:none; transition:all .18s;
}
.fc:focus { border-color:var(--blue); background:white; box-shadow:0 0 0 3px rgba(26,86,219,.08); }
.fc::placeholder { color:var(--gray-400); }
.pw-toggle {
  position:absolute; right:12px; top:50%;
  transform:translateY(-50%);
  background:none; border:none; cursor:pointer;
  color:var(--gray-400); padding:2px;
}
.pw-toggle:hover { color:var(--gray-600); }

/* Options row */
.form-opts {
  display:flex; align-items:center;
  justify-content:space-between; margin-bottom:18px;
}
.remember { display:flex; align-items:center; gap:8px; cursor:pointer; font-size:.82rem; color:var(--gray-600); }
.remember input { accent-color:var(--blue); }
.forgot { font-size:.78rem; color:var(--blue); text-decoration:none; }
.forgot:hover { text-decoration:underline; }

/* Submit */
.btn-submit {
  width:100%; background:var(--blue); color:white;
  border:none; border-radius:10px; padding:13px;
  font-size:.92rem; font-weight:700; cursor:pointer;
  font-family:var(--font); transition:all .2s;
  display:flex; align-items:center; justify-content:center; gap:8px;
}
.btn-submit:hover { background:var(--blue-dark); box-shadow:0 8px 24px rgba(26,86,219,.3); transform:translateY(-1px); }

/* Divider */
.divider { display:flex; align-items:center; gap:10px; margin:18px 0; }
.divider::before,.divider::after { content:''; flex:1; height:1px; background:var(--gray-200); }
.divider span { font-size:.72rem; color:var(--gray-400); }

/* Demo cards */
.demo-grid { display:flex; flex-direction:column; gap:8px; }
.demo-card {
  display:flex; align-items:center; gap:12px;
  padding:10px 14px; border-radius:8px;
  background:var(--gray-50); border:1px solid var(--gray-200);
  cursor:pointer; transition:all .18s;
}
.demo-card:hover { border-color:var(--blue); background:var(--blue-light); }
.demo-av { width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.72rem; font-weight:800; color:white; flex-shrink:0; }
.demo-info .dn { font-size:.82rem; font-weight:700; color:var(--gray-800); }
.demo-info .de { font-size:.72rem; color:var(--gray-400); font-family:monospace; }

/* Register link */
.register-link { text-align:center; margin-top:20px; font-size:.82rem; color:var(--gray-500); }
.register-link a { color:var(--blue); text-decoration:none; font-weight:600; }
.register-link a:hover { text-decoration:underline; }

@media(max-width:800px){ .left{display:none;} .right{width:100%;padding:32px 24px;} }
</style>
</head>
<body>

<!-- LEFT -->
<div class="left">
  <a href="{{ url('/') }}" class="left-logo">
    <div class="left-logo-mark">S</div>
    <div class="left-logo-name">Societas <span>RH</span></div>
  </a>

  <div class="left-content">
    <h2 class="left-title">
      Votre espace<br>
      <span>RH personnalisé</span><br>
      vous attend
    </h2>
    <p class="left-sub">
      Accédez à vos fiches de paie, congés, présences
      et documents RH depuis votre espace sécurisé.
    </p>
    <div class="left-features">
      <div class="lf-item">
        <div class="lf-check"><i data-lucide="check" style="width:13px;height:13px;stroke:#60a5fa"></i></div>
        <span class="lf-text">Consultation des fiches de paie</span>
      </div>
      <div class="lf-item">
        <div class="lf-check"><i data-lucide="check" style="width:13px;height:13px;stroke:#60a5fa"></i></div>
        <span class="lf-text">Demandes de congés en ligne</span>
      </div>
      <div class="lf-item">
        <div class="lf-check"><i data-lucide="check" style="width:13px;height:13px;stroke:#60a5fa"></i></div>
        <span class="lf-text">Suivi des présences et absences</span>
      </div>
      <div class="lf-item">
        <div class="lf-check"><i data-lucide="check" style="width:13px;height:13px;stroke:#60a5fa"></i></div>
        <span class="lf-text">Tableau de bord RH complet</span>
      </div>
    </div>
  </div>

  <div class="left-footer">
    <a href="{{ url('/') }}">← Retour à l'accueil</a>
  </div>
</div>

<!-- RIGHT -->
<div class="right">
  <a href="{{ url('/') }}" class="back-link">
    <i data-lucide="home" style="width:13px;height:13px"></i> Accueil
  </a>

  <div class="form-head">
    <h1>Connexion</h1>
    <p>Accédez à votre espace Societas RH</p>
  </div>

  <!-- Role tabs -->
  <div class="role-tabs">
    <button class="role-tab active" id="tab-admin" onclick="setRole('admin')">
      <i data-lucide="shield" style="width:13px;height:13px"></i> Admin
    </button>
    <button class="role-tab" id="tab-manager" onclick="setRole('manager')">
      <i data-lucide="users" style="width:13px;height:13px"></i> Manager
    </button>
    <button class="role-tab" id="tab-employe" onclick="setRole('employe')">
      <i data-lucide="user" style="width:13px;height:13px"></i> Employé
    </button>
  </div>

  @if ($errors->any())
    <div class="alert-err">
      <i data-lucide="alert-circle" style="width:15px;height:15px;flex-shrink:0"></i>
      {{ $errors->first() }}
    </div>
  @endif

  @if (session('status'))
    <div class="alert-ok">
      <i data-lucide="check-circle" style="width:15px;height:15px;flex-shrink:0"></i>
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="hidden" name="role_hint" id="role-hint" value="admin">

    <div class="fg">
      <label class="fl">Adresse email</label>
      <div class="fi-wrap">
        <i data-lucide="mail" class="fi-icon"></i>
        <input type="email" name="email" class="fc" id="email-in"
          placeholder="votre@email.com"
          value="{{ old('email') }}" required autofocus>
      </div>
    </div>

    <div class="fg">
      <label class="fl">Mot de passe</label>
      <div class="fi-wrap">
        <i data-lucide="lock" class="fi-icon"></i>
        <input type="password" name="password" class="fc" id="pw-in"
          placeholder="••••••••" required style="padding-right:42px">
        <button type="button" class="pw-toggle" onclick="togglePw()">
          <i data-lucide="eye" style="width:16px;height:16px" id="pw-icon"></i>
        </button>
      </div>
    </div>

    <div class="form-opts">
      <label class="remember">
        <input type="checkbox" name="remember"> Se souvenir de moi
      </label>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="forgot">Mot de passe oublié ?</a>
      @endif
    </div>

    <button type="submit" class="btn-submit">
      <i data-lucide="log-in" style="width:16px;height:16px"></i>
      Se connecter
    </button>
  </form>

  @if (Route::has('register'))
  <div class="register-link">
    Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte →</a>
  </div>
  @endif
</div>

<script>
function togglePw(){
  const i=document.getElementById('pw-in');
  const ic=document.getElementById('pw-icon');
  i.type=i.type==='password'?'text':'password';
  ic.setAttribute('data-lucide',i.type==='password'?'eye':'eye-off');
  lucide.createIcons();
}
function setRole(r){
  document.querySelectorAll('.role-tab').forEach(t=>t.classList.remove('active'));
  document.getElementById('tab-'+r).classList.add('active');
  document.getElementById('role-hint').value=r;
}
function fill(email,pw,role){
  document.getElementById('email-in').value=email;
  document.getElementById('pw-in').value=pw;
  setRole(role);
}
document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());
</script>
</body>
</html>
