<?php
declare(strict_types=1);

const NAME = 'Hüsniye';

function h(string $s): string
{
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  // Şimdilik sadece demo kontrol
  if ($email === '' || $password === '') {
    $error = "Email ve şifre zorunlu.";
  } else {
    $ch = curl_init("http://gateway/api/husniye/auth/login");

    $data = json_encode([
      "email" => $email,
      "password" => $password
    ]);

    curl_setopt_array($ch, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
      ],
      CURLOPT_POSTFIELDS => $data
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = $response ? json_decode($response, true) : null;

    if (!($result['ok'] ?? false)) {
      $error = "Login başarısız" . json_encode($result);
    }

  }
}
?>
<!doctype html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h(NAME) ?> - Login</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f7fb;
      color: #1f2933;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      width: 360px;
      background: #ffffff;
      border: 1px solid #d0d7de;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      border-radius: 12px;
      padding: 24px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input {
      width: 70%;
      padding: 12px;
      margin-bottom: 12px;
      border-radius: 10px;
      background: #ffffff;
      color: #111827;
      border: 1px solid #cbd5e1;
    }

    button {
      width: 50%;
      padding: 12px;
      border-radius: 10px;
      border: none;
      background: #2563eb;
      color: white;
      font-weight: 600;
      cursor: pointer;
    }

    button:hover {
      background: #1d4ed8;
    }

    .error {
      background: #3f1d1d;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 12px;
      color: #b91c1c;
      font-size: 14px;
      text-align: center;
    }

    .muted {
      text-align: center;
      margin-top: 14px;
      font-size: 13px;
      color: #6b7280;
    }

    a {
      color: #9ecbff;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <div class="card">
    <h2>Giriş</h2>

    <?php if ($error): ?>
      <div class="error"><?= h($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <div style="text-align: center; margin-top: 10%;">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <div style="margin-top: 5% ;">
          <button type="submit">Giriş Yap</button>
        </div>
      </div>
    </form>

    <div class="muted">
      Hesabın yok mu? <a href="register.php">Kayıt ol</a>
    </div>
  </div>

</body>

</html>