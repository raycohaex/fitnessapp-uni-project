<?php

declare(strict_types=1);

namespace app\DAL;

use app\lib\Database;
use PDOException;

class ExerciseformDataLayer extends Database implements IExerciseformDataLayer
{
    private Database $db;

    public function __construct()
    {
        try {
            $this->db = new Database();
        } catch (PDOException $ex) {
            throw new PDOException('Kan niet verbinden met de database');
        }
    }

    public function getAllExerciseforms(): array
    {
        try {
            $this->db->query('SELECT `id`, `name` FROM `exerciseform`');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            throw new PDOException('kan oefeningenvormen niet ophalen uit de database.');
        }
    }


    public function getExerciseformsByExerciseId($id): array
    {
        try {
            $this->db->query(
                '
        SELECT ef.name, ef.id FROM exercises e
        LEFT JOIN join_exercises_exerciseform jee ON e.id = jee.exercise_id
        RIGHT JOIN exerciseform ef ON ef.id = jee.exerciseform_id
        where e.id = :id;
        '
            );
            $this->db->bind(':id', $id);
            return $this->db->resultSet();
        } catch (PDOException $e) {
            throw new PDOException('kan oefeningvorm niet ophalen uit de database.');
        }
    }

    public function joinExerciseWithExerciseform($exerciseformID, $exerciseID)
    {
        try {
            $this->db->query(
                'INSERT INTO `join_exercises_exerciseform` (`exercise_id`, `exerciseform_id`) VALUES (:exercise, :exerciseform)'
            );
            $this->db->bind(':exercise', $exerciseID);
            $this->db->bind(':exerciseform', $exerciseformID);
            $this->db->execute();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}