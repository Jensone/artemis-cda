<?php

namespace Artemis;
require_once __DIR__ . '/src/entity/Book.php';
use Artemis\Book;

$books = Book::getAllBooks();

include __DIR__ . '/templates/header.php';

?>

<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -m-4">
            <?php 
                if (!empty($books)) {
                    foreach ($books as $book) {
                        include __DIR__ . '/templates/_partials/book_card.php';
                    }
                } else {
                    echo '<p class="text-center">No books found.</p>';
                }
            ?>
        </div>
    </div>
</section>

<?php

include __DIR__ . '/templates/footer.php';