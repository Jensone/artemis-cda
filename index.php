<?php 
require __DIR__ . '/classes/Book.php';
use Artemis\Book;
$result = Book::getAllBooks();
var_dump($result);
die();


include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero.php';

include __DIR__ . '/templates/last.php';

include __DIR__ . '/templates/footer.php';