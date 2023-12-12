<?php

use Artemis\Book;

require_once __DIR__ . '/src/entity/Book.php';

include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero.php';

if (!empty($_GET['id'])) {
    if($_GET['type'] == "book") {
      Book::deleteBook($_GET['id']);
    }
}

include __DIR__ . '/templates/last.php';

include __DIR__ . '/templates/footer.php';