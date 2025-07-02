<?php
/**
 * Global layout template.
 * $title   – Page <title>
 * $content – Main HTML content
 */
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($title) ?> | Studio Starlight</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body class="min-h-screen bg-parchment text-moss dark:bg-[#0f1115] dark:text-parchment">

  <!-- Navbar -->
  <header class="bg-parchment/80 backdrop-blur dark:bg-[#0f1115]/80 sticky top-0 z-50 shadow-sm">
    <div class="max-w-6xl mx-auto flex items-center justify-between p-4">
      <a href="/" class="font-serif text-2xl">Studio&nbsp;Starlight</a>

      <!-- Desktop links -->
      <nav class="hidden md:flex gap-6 font-rounded">
        <?php
          $links = [
            '/'        => 'Home',
            '/blog'    => 'Blog',
            '/gallery' => 'Gallery',
            '/shop'    => 'Shop',
            '/about'   => 'About',
          ];
          foreach ($links as $url => $label) {
            $active = ($_SERVER['REQUEST_URI'] === $url) ? 'underline underline-offset-4' : '';
            echo "<a href=\"$url\" class=\"$active hover:text-vintageRed\">$label</a>";
          }
        ?>
      </nav>

      <!-- Light / Dark toggle -->
      <button id="themeToggle" class="ml-6 md:ml-0 p-2 rounded hover:bg-moss/10 dark:hover:bg-parchment/10" aria-label="Toggle dark mode">
        <svg id="themeIcon" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"></svg>
      </button>

      <!-- Mobile menu button (optional future) -->
    </div>
  </header>

  <main class="max-w-6xl mx-auto p-6">
    <?= $content ?>
  </main>

  <script>
  // --- Light/Dark toggle ---
  const root = document.documentElement;
  const stored = localStorage.theme;
  if (stored === 'dark') root.classList.add('dark');

  const icon = document.getElementById('themeIcon');
  const updateIcon = () => {
    icon.innerHTML = root.classList.contains('dark')
      ? '<path d="M17.657 16.243A8 8 0 0 1 7.757 6.343 8.001 8.001 0 1 0 17.657 16.243z"/>'
      : '<path d="M12 18a6 6 0 110-12 6 6 0 010 12zm0 4v-2m0-16V2m8 10h2M2 12H0m15.536 6.536l1.414 1.414M4.05 4.05L2.636 2.636m0 18.728l1.414-1.414M19.95 4.05l1.414-1.414"/>';
  };
  updateIcon();

  document.getElementById('themeToggle').onclick = () => {
    root.classList.toggle('dark');
    localStorage.theme = root.classList.contains('dark') ? 'dark' : 'light';
    updateIcon();
  };
  </script>
</body>
</html>
