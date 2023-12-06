<?php

/**
 * Class Publisher
 * Représentation d'un éditeur dans l'app Artemis
 */

namespace Artemis;

class Client
{
    // Properties
    public int $id;
    public string $name;
    public string $email;
    public string $deposit;

    // Constructor
    public function __construct(
        int $id, 
        string $name,
        string $email,
        string $deposit
        )
    {
        $this->id = $id;
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
}
//Pas de code ici