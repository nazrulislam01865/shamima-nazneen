@php
    $statusCode = $statusCode ?? 500;
    $title = $title ?? 'Something went wrong';
    $message = $message ?? 'The page could not be loaded right now. Please try again in a moment.';
    $siteName = $siteSettings->site_name ?? config('app.name', 'Website');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | {{ $siteName }}</title>
    <style>
        :root{color-scheme:light;--bg:#fbf6ec;--card:#fffaf2;--text:#2c1812;--muted:#796c61;--accent:#9f6f2d;--border:#e6d8c4}
        *{box-sizing:border-box}body{margin:0;min-height:100vh;display:grid;place-items:center;padding:24px;background:radial-gradient(circle at top,#fffdf8 0,#fbf6ec 48%,#f4ead9 100%);font-family:Inter,Arial,sans-serif;color:var(--text)}
        .error-card{width:min(620px,100%);padding:34px 28px;border:1px solid var(--border);border-radius:24px;background:var(--card);box-shadow:0 24px 70px rgba(48,30,18,.12);text-align:center}
        .code{display:inline-grid;place-items:center;min-width:72px;height:42px;margin-bottom:18px;border-radius:999px;background:#3b2118;color:#f8dfb2;font-weight:800;letter-spacing:.08em}
        h1{margin:0 0 12px;font-family:Georgia,serif;font-size:clamp(30px,5vw,44px);line-height:1.08}p{margin:0 auto 24px;max-width:470px;color:var(--muted);font-size:16px;line-height:1.65}.btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 18px;border-radius:999px;background:var(--accent);color:#fff;font-weight:800;text-decoration:none}
    </style>
</head>
<body>
    <main class="error-card" role="main">
        <span class="code">{{ $statusCode }}</span>
        <h1>{{ $title }}</h1>
        <p>{{ $message }}</p>
        <a class="btn" href="{{ url('/') }}">Go to homepage</a>
    </main>
</body>
</html>
