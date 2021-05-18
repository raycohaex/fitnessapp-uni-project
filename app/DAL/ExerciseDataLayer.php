<?php

declare(strict_types=1);

namespace app\DAL;

use app\lib\Database;
use PDOException;

class ExerciseDataLayer extends Database implements IExerciseDataLayer
{
    private Database $db;

    public function __construct()
    {
        try {
            $this->db = new Database();
        } catch (PDOException $e) {
            throw new PDOException('Kan niet verbinden met de database');
        }
    }


    public function getExercises(): array
    {
        /* return an array of all exercises */
        try {
            $this->db->query('SELECT `id`, `name`, `description`, `repetitions`, `sets` FROM exercises');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            throw new PDOException('Kan geen records vinden');
        }
    }


    public function getExerciseById(int $id): object
    {
        /* return an object of an exercise based on ID */
        try {
            $this->db->query(
                'SELECT `id`, `name`, `description`, `repetitions`, `sets` FROM `exercises` WHERE id = :id'
            );
            $this->db->bind(':id', $id);
            $result = $this->db->single();

            if ($result === false) {
                throw new PDOException('Kan geen records vinden');
            }

            return $result;
        } catch (PDOException $e) {
            throw new PDOException('Kan geen records vinden: ' . $e->getMessage());
        }
    }


    public function addExercise(array $data): int
    {
        /* Add an exercise and return the added row id as int */
        $this->db->query(
            'INSERT INTO `exercises` (`name`, `description`, `repetitions`, `sets`) VALUES (:name, :description, :repetitions, :sets)'
        );

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':repetitions', $data['repetitions']);
        $this->db->bind(':sets', $data['sets']);

        if ($this->db->execute()) {
            if (is_numeric($this->db->lastInsertId())) {
                return $this->db->lastInsertId() + 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public function patchExercise(array $data): bool
    {
        /* edit an exercise return a true or false */
        $this->db->query(
            'UPDATE `exercises` SET name=:name, description=:description, repetitions=:repetitions, sets=:sets WHERE id=:id'
        );

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