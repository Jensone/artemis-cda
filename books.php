<?php 

namespace Artemis;

require_once __DIR__ . '/src/entity/Book.php';

use Artemis\Book;
var_dump(Book::getAllBooks());
die();


include __DIR__ . '/templates/header.php';

?>




<?php 

include __DIR__ . '/templates/footer.php';