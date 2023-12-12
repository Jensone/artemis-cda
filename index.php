<?php 


include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero.php';

if (!empty($_GET['message'])) {
    echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Le livre a bien été ajouté</span>.
          </div>
    ';
}

include __DIR__ . '/templates/last.php';

include __DIR__ . '/templates/footer.php';