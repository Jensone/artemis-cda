<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Loan.php';

use Artemis\Loan;

$loans = Loan::getAllLoans();

$today = date("Y-m-d");

$inProgress = []; // Le livre est en cours d'emprunt
$endSoon = []; // Le livre a dépassé la date de retour
$isBack = []; // Le livre est rendu à la bibliothèque

for ($i = 0; $i < count($loans); $i++) {
    if ($loans[$i]['LoanStatus'] == 0) {
        ($today <= $loans[$i]['LoanEndDate']) ? array_push($inProgress, $loans[$i]) : array_push($endSoon, $loans[$i]);
    } else {
        array_push($isBack, $loans[$i]);
    }
}

$titles = ["En cours", "Terminé", "Rendu"];
$colors = ["indigo", "orange", "green"];

include __DIR__ . '/templates/header.php';
// include __DIR__ . '/templates/hero-books.php';

?>

<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -m-4">
            <?php
            for ($i = 0; $i < 3; $i++) {
                $title = $titles[$i];
                $color = $colors[$i];
                //On boucle sur les tableau dans le template loans_card.php
                include __DIR__ . '/templates/_partials/loans_column.php';
            }

            ?>
        </div>
    </div>
</section>

<?php

include __DIR__ . '/templates/footer.php';
