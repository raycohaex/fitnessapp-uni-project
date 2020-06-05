<?php
declare(strict_types=1);

class Exercise
{
    private Database $db;

    public function __construct()
    {
        try {
            $this->db = new Database();
        } catch (PDOException $ex) {
            exit("Fout bij het maken van een database connectie");
        }
    }


    public function getExercises() : array
    {
        $this->db->query('SELECT `id`, `name`, `description` FROM exercises');
        return $this->db->resultSet();
    }


    public function getExerciseById($id) : object
    {
        $this->db->query('SELECT `id`, `name`, `description` FROM `exercises` WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }


    public function addExercise($data) : bool
    {
        $this->db->query('INSERT INTO `exercises` (name) VALUES (:name)');

        $this->db->bind(':name', $data['name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function patchExercise($data) : bool
    {
        $this->db->query('UPDATE `exercises` SET name=:name, description=:description WHERE id=:id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}