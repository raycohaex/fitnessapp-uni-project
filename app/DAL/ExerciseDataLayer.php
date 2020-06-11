<?php
declare(strict_types=1);

namespace app\DAL;
use app\lib\Database;

class ExerciseDataLayer extends Database implements IExerciseDataLayer
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
        $this->db->query('SELECT `id`, `name`, `description`, `repetitions`, `sets` FROM exercises');
        return $this->db->resultSet();
    }


    public function getExerciseById($id) : object
    {
        $this->db->query('SELECT `id`, `name`, `description`, `repetitions`, `sets` FROM `exercises` WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }


    public function addExercise($data) : int
    {
        $this->db->query('INSERT INTO `exercises` (`name`, `description`, `repetitions`, `sets`) VALUES (:name, :description, :repetitions, :sets)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':repetitions', $data['repetitions']);
        $this->db->bind(':sets', $data['sets']);

        if ($this->db->execute()) {
            if(is_numeric($this->db->lastInsertId())){
                return $this->db->lastInsertId() + 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public function patchExercise($data) : bool
    {
        $this->db->query('UPDATE `exercises` SET name=:name, description=:description, repetitions=:repetitions, sets=:sets WHERE id=:id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':repetitions', $data['repetitions']);
        $this->db->bind(':sets', $data['sets']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}