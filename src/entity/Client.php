<?php

/**
 * Class Publisher
 * Représentation d'un éditeur dans l'app Artemis
 */

namespace Artemis;

require_once __DIR__ . '/../controller/Database.php';

use PDO;
use Artemis\Database;

class Client
{
    // Properties
    public int $id;
    public string $name;
    public string $email;
    public string $deposit;

    // Constructor
    public function __construct(
        string $name,
        string $email,
        string $deposit
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->deposit = $deposit;
    }

    // Getters & Setters 
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getDeposit()
    {
        return $this->deposit;
    }
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
        return $this;
    }

    // Methods
    public function addClient()
    {
        // Code
    }
    static public function editClient(int $id, string $name, string $email, bool $deposit)
    {
        $pdo = Database::getPDO();
        $query = "UPDATE Client SET name = :name, email = :email, deposit = :deposit WHERE id = :id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':deposit', $deposit, PDO::PARAM_BOOL);
        $stmt->execute();
    }
}
//Pas de code ici