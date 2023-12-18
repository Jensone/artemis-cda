<?php

namespace Artemis;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/controller/Database.php';
require_once __DIR__ . '/src/entity/Book.php';

use OpenAI;
use Artemis\Book;
use Artemis\Database;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');

$authors = Database::getAll('Author');
$publishers = Database::getAll('Publisher');

$title = '';
$description = '';
$author_id = '';
$publisher_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        Book::addBook(
            $_POST['title'],
            $_POST['description'],
            $_POST['isbn'],
            $_POST['author'],
            $_POST['publisher']
        );

        header('Location: index.php');
        
    } elseif (isset($_POST['api'])) {
        $title = $_POST['title'];
        $author_id = $_POST['author'];
        $publisher_id = $_POST['publisher'];
        foreach ($authors as $author) {
            if ($author['id'] == $_POST['author']) {
                $author = $author['name'];
                break;
            }
        }
        foreach ($publishers as $publisher) {
            if ($publisher['id'] == $_POST['publisher']) {
                $publisher = $publisher['name'];
                break;
            }
        }

        // var_dump($title, $author_name, $publisher_name, $author_id, $publisher_id);
        // die();
        $client = OpenAI::client($_ENV['OPENAI_SK']);

        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'assistant', 'content' => 'Tu es un assistant pour une bibliothèque, ton rôle consiste à rédiger des textes de description pour des livres à partir du titre, de l\'auteur et de la maison d\'édition. Rédige la description pour ce livre : ' . $title . ', écrit par ' . $author . ' à citer et publié par ' . $publisher . 'à citer.'],
            ],
        ]);

        $description = $result->choices[0]->message->content;
    }
}



include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero.php';

?>

<div class="container px-4 mb-6 mx-auto">
    <form action="" method="POST">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Formulaire d'ajout d'un nouveau livre</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Remplissez les champs ci-dessous pour ajouter un nouveau livre</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titre du livre</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= !empty($title) ? $title : '' ?>" required/>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="isbn" class="block text-sm font-medium leading-6 text-gray-900">ISBN</label>
                        <div class="mt-2">
                            <input type="text" name="isbn" id="isbn" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" type="text" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= !empty($description) ? $description : '' ?></textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Auteur(e)</label>
                        <div class="mt-2">
                            <select type="text" name="author" id="author" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <?php
                                if (!empty($author_id)) {
                                    foreach ($authors as $author) {
                                        if ($author['id'] == $author_id) {
                                            echo '<option value="' . $author['id'] . '">' . $author['name'] . '</option>';
                                            break;
                                        }
                                    }
                                } else {
                                    foreach ($authors as $author) {
                                        echo '<option value="' . $author['id'] . '">' . $author['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="publisher" class="block text-sm font-medium leading-6 text-gray-900">Maison d'édition</label>
                        <div class="mt-2">
                            <select type="text" name="publisher" id="publisher" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <?php
                                if (!empty($publisher_id)) {
                                    foreach ($publishers as $publisher) {
                                        if ($publisher['id'] == $publisher_id) {
                                            echo '<option value="' . $publisher['id'] . '">' . $publisher['name'] . '</option>';
                                            break;
                                        }
                                    }
                                } else {
                                    foreach ($publishers as $publisher) {
                                        echo '<option value="' . $publisher['id'] . '">' . $publisher['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <input type="submit" name="api" class="rounded-md bg-transparent-600 px-3 py-2 text-xs font-semibold text-black hover:text-white border hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="Rédaction par IA 🦾" />
            <input type="submit" name="save" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="Enregistrer" />
        </div>
    </form>
</div>

<!-- <script>
    // Récupérer les éléments du DOM : Titre en live, auteur, maison d'édition
    let title = document.querySelector('#title')
    title.addEventListener('keyup', function() {
        console.log(title.value)
    })
    let author = document.querySelector('#author')
    let authors = document.querySelectorAll('#author option')
    let publisher = document.querySelector('#publisher')
    author.addEventListener("change", () => {
        console.log(event)
    })
</script> -->

<?php

// include __DIR__ . '/templates/_partials/modal_ai.php';

include __DIR__ . '/templates/footer.php';
