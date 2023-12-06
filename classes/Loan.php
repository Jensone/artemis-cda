<?php

/**
 * Class Publisher
 * Représentation d'un éditeur dans l'app Artemis
 */

namespace Artemis;

use DateTime;

class Loan
{
    // Properties
    public int $id;
    public int $client_id;
    public int $book_id;
    public DateTime $start_date;
    public DateTime $end_date;
    public bool $returned;

    // Constructor
    public function __construct(
        int $id,
        int $client_id,
        int $book_id,
        DateTime $start_date,
        DateTime $end_date,
        bool $returned
        )
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->book_id = $book_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->returned = $returned;
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

    public function getClientId()
    {
        return $this->client_id;
    }
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getBookId()
    {
        return $this->book_id;
    }
    public function setBookId($book_id)
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getReturned()
    {
        return $this->returned;
    }
    public function setReturned($returned)
    {
        $this->returned = $returned;

        return $this;
    }
}
//Pas de code ici