<?php
declare(strict_types=1);

namespace app\DAL;
use app\lib\Database;

class ExerciseformDataLayer extends Database implements IExerciseformDataLayer
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

    public function getAllExerciseforms(): array
    {
        $this->db->query('SELECT `id`, `name` FROM `exerciseform`');
        return $this->db->resultSet();
    }


    public function getExerciseformsByExerciseId($id): array
    {
        $this->db->query('
        SELECT ef.name, ef.id FROM exercises e
        LEFT JOIN join_exercises_exerciseform jee ON e.id = jee.exercise_id
        RIGHT JOIN exerciseform ef ON ef.id = jee.exerciseform_id
        where e.id = :id;
        ');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function joinExerciseWithExerciseform($exerciseformID, $exerciseID)
    {
        $this->db->query(
            'INSERT INTO `join_exercises_exerciseform` (`exercise_id`, `exerciseform_id`) VALUES (:exercise, :exerciseform)'
        );
        $this->db->bind(':exercise', $exerciseID);
        $this->db->bind(':exerciseform', $exerciseformID);
        $this->db->execute();
    }
}