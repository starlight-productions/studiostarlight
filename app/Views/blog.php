<h2 class="text-2xl font-serif mb-6">Latest Posts</h2>

<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
<?php foreach ($posts as $p): ?>
  <article class="border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
    <?php if ($p['image']): ?>
      <a href="<?= $p['link'] ?>" target="_blank" rel="noopener">
        <img src="<?= $p['image'] ?>" alt="" class="w-full h-48 object-cover">
      </a>
    <?php endif; ?>
    <div class="p-4">
      <h3 class="font-rounded text-lg mb-2">
        <a href="<?= $p['link'] ?>" target="_blank" rel="noopener"
           class="hover:text-vintageRed"><?= $p['title'] ?></a>
      </h3>
      <p class="text-sm text-mutedBlue"><?= date('M j, Y', strtotime($p['date'])) ?>
         • <?= ucfirst($p['author']) ?></p>
      <p class="mt-2 text-sm"><?= $p['excerpt'] ?></p>
    </div>
  </article>
<?php endforeach; ?>
</div>
