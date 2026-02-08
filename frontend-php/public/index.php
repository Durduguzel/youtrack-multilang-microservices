<?php
declare(strict_types=1);

$people = [
  ['key' => 'caner',   'label' => 'Caner',   'file' => 'caner.php'],
  ['key' => 'durdu',   'label' => 'Durdu',   'file' => 'durdu.php'],
  ['key' => 'husniye', 'label' => 'Hüsniye', 'file' => 'husniye/login.php'],
  ['key' => 'mehmet',  'label' => 'Mehmet',  'file' => 'mehmet.php'],
];

function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Team Handover Panel</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; background:#0b0f17; color:#e6edf3; }
    h1 { margin: 0 0 8px 0; font-size: 22px; }
    p { margin: 0 0 18px 0; color:#b6c2cf; }
    .grid { display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; max-width: 760px; }
    a.btn { display:block; text-decoration:none; text-align:center; padding:14px 12px; border-radius:12px;
            border:1px solid #243044; background:#111827; color:#e6edf3; font-weight:600; }
    a.btn:hover { background:#18233a; }
    .note { margin-top: 18px; color:#b6c2cf; font-size: 13px; max-width: 760px; }
    code { background:#0b1220; padding:2px 6px; border-radius:8px; border:1px solid #243044; }
    @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <h1>Team Handover Panel</h1>
  <p>Her kişi kendi sayfasında geliştirme yapacak. Servisler gateway üzerinden çağrılır.</p>

  <div class="grid">
    <?php foreach ($people as $p): ?>
      <a class="btn" href="<?= h($p['file']) ?>"><?= h($p['label']) ?> sayfasına git</a>
    <?php endforeach; ?>
  </div>

  <div class="note">
    API prefix’ler:
    <code>/api/caner</code> <code>/api/durdu</code> <code>/api/husniye</code> <code>/api/mehmet</code><br>
    Test: Her sayfada <strong>Ping</strong> butonuna basarak kendi servisine istek atabilirsiniz.
  </div>
</body>
</html>
