<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; }
  .header { background: #1e3a5f; color: white; padding: 20px 24px; margin-bottom: 20px; }
  .header h1 { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
  .header p { font-size: 11px; opacity: .8; }
  .header .periode { float: right; text-align: right; }
  .meta { display: flex; gap: 12px; margin-bottom: 16px; padding: 0 24px; }
  .meta-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px; flex: 1; }
  .meta-label { font-size: 9px; text-transform: uppercase; letter-spacing: .5px; color: #94a3b8; margin-bottom: 3px; }
  .meta-val { font-size: 14px; font-weight: 800; color: #1e293b; }
  .meta-val.green { color: #16a34a; }
  .meta-val.red { color: #dc2626; }
  table { width: 100%; border-collapse: collapse; margin: 0 24px; width: calc(100% - 48px); }
  thead tr { background: #1e3a5f; color: white; }
  thead th { padding: 8px 10px; text-align: left; font-size: 9px; text-transform: uppercase; letter-spacing: .5px; font-weight: 700; }
  tbody tr:nth-child(even) { background: #f8fafc; }
  tbody tr:hover { background: #eff6ff; }
  tbody td { padding: 7px 10px; font-size: 10px; border-bottom: 1px solid #e2e8f0; }
  .num { text-align: right; font-family: monospace; }
  tfoot tr { background: #1e293b; color: white; font-weight: 800; }
  tfoot td { padding: 9px 10px; font-size: 11px; }
  .footer { margin-top: 24px; padding: 12px 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 9px; color: #94a3b8; }
  .badge { display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 9px; font-weight: 700; }
  .badge-cdi { background: #dcfce7; color: #16a34a; }
  .badge-cdd { background: #dbeafe; color: #2563eb; }
  .badge-int { background: #fef3c7; color: #d97706; }
  .badge-stg { background: #f3e8ff; color: #7c3aed; }
  .sigs { display: flex; justify-content: space-between; margin: 30px 24px 0; }
  .sig-box { text-align: center; width: 180px; }
  .sig-line { border-top: 1px solid #cbd5e1; padding-top: 6px; font-size: 10px; color: #64748b; margin-top: 40px; }
</style>
</head>
<body>

<div class="header">
  <div class="periode">
    <div style="font-size:13px;font-weight:800">{{ $periode }}</div>
    <div style="font-size:10px;opacity:.7">Généré le {{ now()->format('d/m/Y à H:i') }}</div>
  </div>
  <h1>SOCIETAS GRH</h1>
  <p>Rapport de Paie — {{ $periode }}</p>
  <p style="margin-top:2px">123 Avenue Bourguiba, Dakar, Sénégal · NINEA: 12345678901</p>
  <div style="clear:both"></div>
</div>

<div class="meta">
  <div class="meta-box">
    <div class="meta-label">Total employés</div>
    <div class="meta-val">{{ $employes->count() }}</div>
  </div>
  <div class="meta-box">
    <div class="meta-label">Masse salariale brute</div>
    <div class="meta-val">{{ number_format($masse_salariale,0,',',' ') }} XOF</div>
  </div>
  <div class="meta-box">
    <div class="meta-label">Total cotisations salariales</div>
    <div class="meta-val red">{{ number_format($cnss_total + $ipres_total,0,',',' ') }} XOF</div>
  </div>
  <div class="meta-box">
    <div class="meta-label">Total net à payer</div>
    <div class="meta-val green">{{ number_format($net_total,0,',',' ') }} XOF</div>
  </div>
</div>

<table>
  <thead>
    <tr>
      <th>Matricule</th>
      <th>Employé</th>
      <th>Poste</th>
      <th>Structure</th>
      <th>Contrat</th>
      <th class="num">Brut (XOF)</th>
      <th class="num">CNSS 4%</th>
      <th class="num">IPRES 6%</th>
      <th class="num">Net (XOF)</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employes as $e)
    @php
      $b     = $e->salaire_base;
      $cnss  = round($b * 0.04);
      $ipres = round($b * 0.06);
      $net   = $b - $cnss - $ipres;
      $badgeClass = match($e->contrat) {
          'CDI'     => 'badge-cdi',
          'CDD'     => 'badge-cdd',
          'Intérim' => 'badge-int',
          default   => 'badge-stg',
      };
    @endphp
    <tr>
      <td style="font-family:monospace;font-size:9px;color:#64748b">{{ $e->matricule ?? '—' }}</td>
      <td><strong>{{ $e->prenom }} {{ $e->nom }}</strong></td>
      <td>{{ $e->poste?->nom ?? '—' }}</td>
      <td>{{ $e->structure?->nom ?? '—' }}</td>
      <td><span class="badge {{ $badgeClass }}">{{ $e->contrat }}</span></td>
      <td class="num">{{ number_format($b,0,',',' ') }}</td>
      <td class="num" style="color:#dc2626">-{{ number_format($cnss,0,',',' ') }}</td>
      <td class="num" style="color:#dc2626">-{{ number_format($ipres,0,',',' ') }}</td>
      <td class="num" style="color:#16a34a;font-weight:700">{{ number_format($net,0,',',' ') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="5">TOTAUX</td>
      <td class="num">{{ number_format($masse_salariale,0,',',' ') }}</td>
      <td class="num">-{{ number_format($cnss_total,0,',',' ') }}</td>
      <td class="num">-{{ number_format($ipres_total,0,',',' ') }}</td>
      <td class="num">{{ number_format($net_total,0,',',' ') }}</td>
    </tr>
  </tfoot>
</table>

<div style="margin: 16px 24px; padding: 12px; background: #fef9c3; border: 1px solid #fde047; border-radius: 6px;">
  <strong style="font-size:10px">Charges patronales :</strong>
  <span style="font-size:10px;margin-left:8px">
    CNSS patronal (7%) : {{ number_format($cnss_patronal,0,',',' ') }} XOF ·
    IPRES patronal (3.6%) : {{ number_format($ipres_patronal,0,',',' ') }} XOF ·
    <strong>Total charges : {{ number_format($cnss_patronal + $ipres_patronal,0,',',' ') }} XOF</strong>
  </span>
</div>

<div class="sigs">
  <div class="sig-box"><div class="sig-line">Le Comptable</div></div>
  <div class="sig-box"><div class="sig-line">Le Directeur RH</div></div>
  <div class="sig-box"><div class="sig-line">La Direction Générale</div></div>
</div>

<div class="footer">
  <span>Document confidentiel — Usage interne uniquement</span>
  <span>Societas GRH · {{ now()->format('d/m/Y') }}</span>
</div>

</body>
</html>
