<?php
declare(strict_types=1);

const NAME = 'Caner';
const API_URL = 'http://gateway/api/caner/ping';

function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function http_get(string $url): array {
  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 6,
    CURLOPT_HTTPHEADER => ['Accept: application/json'],
  ]);
  $raw = curl_exec($ch);
  $err = curl_error($ch);
  $code = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
  curl_close($ch);

  if ($raw === false) return ['ok' => false, 'http_code' => 0, 'error' => $err ?: 'curl_failed'];
  return ['ok' => $code >= 200 && $code < 300, 'http_code' => $code, 'raw' => $raw, 'json' => json_decode($raw, true)];
}

$result = null;
if (($_POST['action'] ?? '') === 'ping') {
  $result = http_get(API_URL);
}
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h(NAME) ?> - Sayfa</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; background:#0b0f17; color:#e6edf3; }
    .card { max-width: 860px; background:#111827; border:1px solid #243044; border-radius:12px; padding:16px; }
    a { color:#9ecbff; text-decoration:none; }
    a:hover { text-decoration:underline; }
    button { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #2f3b52; background:#18233a; color:#e6edf3; cursor:pointer; font-weight:600; }
    button:hover { background:#1e2c47; }
    pre { margin-top: 14px; white-space: pre-wrap; word-break: break-word; background:#0b1220; border:1px solid #243044; padding:12px; border-radius:12px; }
    .muted { color:#b6c2cf; font-size: 13px; }
    code { background:#0b1220; padding:2px 6px; border-radius:8px; border:1px solid #243044; }
  </style>
</head>
<body>
  <div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
      <h2 style="margin:0;"><?= h(NAME) ?> - Kişisel Sayfa</h2>
      <a href="index.php">← Ana sayfa</a>
    </div>

    <p class="muted">
      Servis URL: <code><?= h(API_URL) ?></code>
    </p>

    <form method="post">
      <input type="hidden" name="action" value="ping">
      <button type="submit">Servise Ping At (GET /ping)</button>
    </form>

    <pre><?= h($result ? json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 'Henüz istek atılmadı.') ?></pre>
  </div>
</body>
</html>
