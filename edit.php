<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Book.php';
require_once __DIR__ . '/src/entity/Client.php';
require_once __DIR__ . '/src/entity/Loan.php';
require_once __DIR__ . '/src/controller/Database.php';

use Artemis\Book;
use Artemis\Client;
use Artemis\Database;

if (isset($_POST['title'])) {
  $book = new Book(
    $_POST['title'],
    $_POST['description'],
    $_POST['isbn'],
    $_POST['author'],
    $_POST['publisher']
  );
  $book->editBook($_POST['id']);
  header('Location: book.php?id=' . $_POST['id']);
} elseif(isset($_POST['name'])) {
  
  Client::editClient(
    $_POST['id'],
    $_POST['name'],
    $_POST['email'],
    $_POST['deposit']
  );
  header('Location: clients.php');
} elseif (isset($_GET['type'])) {
    if ($_GET['type'] == 'client') {
    $client = Database::getOne('Client', $_GET['id']);
    include __DIR__ . '/templates/header.php';
    include __DIR__ . '/templates/_partials/modal_edit_client.php';
    include __DIR__ . '/templates/footer.php';
  } elseif ($_GET['type'] == 'loan') {
    if ($_GET['action'] == 'returned') {
      Loan::returnLoan($_GET['id']);
    } elseif ($_GET['action'] == 'archived') {
      Loan::archiveLoan($_GET['id']);
    }
    header('Location: loans.php');
  }
}

