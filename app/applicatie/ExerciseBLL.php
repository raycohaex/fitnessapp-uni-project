<?php

declare(strict_types=1);

namespace app\applicatie;

use app\DAL\IExerciseDataLayer;
use Exception;
use PDOException;

class ExerciseBLL extends ExerciseModel implements IExerciseBLL
{
    private object $validationData;
    private IExerciseDataLayer $exerciseDAL;

    public function __construct(iExerciseDataLayer $dal)
    {
        try {
            $this->exerciseDAL = $dal;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function getAllExercises(): array
    {
        try {
            $result = $this->exerciseDAL->getExercises();
            return [
                'exercises' => $result,
                'error' => null
            ];
        } catch (PDOException $e) {
            return [
                'exercises' => '',
                'error' => [
                    'title' => 'Kan oefeningen niet ophalen',
                    'description' => 'Op dit moment kunnen er geen oefeningen worden opgehaald. Probeer het later opnieuw.'
                ]
            ];
        }
    }

    public function getSingleExercise(int $id): array
    {
        try {
            $result = $this->exerciseDAL->getExerciseById($id);
            return [
                'exercise' => $result,
                'error' => null
            ];
        } catch (PDOException $e) {
            return [
                'exercise' => '',
                'error' => [
                    'title' => 'Kan oefening niet ophalen',
                    'description' => 'Deze oefening kan niet worden opgehaald of kan niet worden gevonden. Probeer het later opnieuw.'
                ]
            ];
        }
    }
}