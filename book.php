<?php 

// ICI ON RECUPERE LE LIVRE 
namespace Artemis;

require_once __DIR__ . '/src/entity/Book.php';

use Artemis\Book;

$book = Book::getOneBook(210);

include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero-book.php';

?>

<p class="text-xl font-medium">
    <?= !empty($book['BookDescription']) ? $book['BookDescription'] : 'Undefined' ?>
</p>
<p class="text-xl font-medium">
    <?= !empty($book['BookTitle']) ? $book['BookTitle'] : 'Undefined' ?>
</p>
<p class="text-xl font-medium">
    <?= !empty($book['PublisherName']) ? $book['PublisherName'] : 'Undefined' ?>
</p>
<p class="text-xl font-medium">
    <?= !empty($book['BookIsbn']) ? $book['BookIsbn'] : 'Undefined' ?>
</p>
<p class="text-xl font-medium">
    <?= !empty($book['AuthorName']) ? $book['AuthorName'] : 'Undefined' ?>
</p>


<?php 

include __DIR__ . '/templates/footer.php';