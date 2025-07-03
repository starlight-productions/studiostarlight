<?php
/** -------------------------------------------
 *  blog.php – view file
 *  Expects $posts = [  // each post is an array
 *      'title'   => string,
 *      'link'    => string|URL,
 *      'date'    => Y-m-d or Y-m-d H:i:s,
 *      'author'  => string,
 *      'excerpt' => string,
 *      'image'   => string|URL|null
 *  ];
 * ------------------------------------------ */
$posts = $posts ?? [];   // guarantee a defined variable
?>

<h2 class="text-2xl font-serif mb-6">Latest Posts</h2>

<?php if (empty($posts)): ?>
  <p class="text-mutedBlue italic">No posts yet. Check back soon!</p>
<?php else: ?>
  <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $p): ?>
      <article class="border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
        <?php if (!empty($p['image'])): ?>
          <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" rel="noopener">
            <img src="<?= htmlspecialchars($p['image']) ?>" alt=""
                 class="w-full h-48 object-cover">
          </a>
        <?php endif; ?>

        <div class="p-4">
          <h3 class="font-rounded text-lg mb-2">
            <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" rel="noopener"
               class="hover:text-vintageRed"><?= htmlspecialchars($p['title']) ?></a>
          </h3>

          <p class="text-sm text-mutedBlue">
            <?= isset($p['date']) ? date('M j, Y', strtotime($p['date'])) : '' ?>
            <?= isset($p['author']) ? ' • ' . ucfirst(htmlspecialchars($p['author'])) : '' ?>
          </p>

          <?php if (!empty($p['excerpt'])): ?>
            <p class="mt-2 text-sm"><?= htmlspecialchars($p['excerpt']) ?></p>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
