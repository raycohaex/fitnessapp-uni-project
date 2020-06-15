<?php
declare(strict_types=1);
namespace app\applicatie;
use app\DAL\IExerciseDataLayer;

class ExerciseBLL extends ExerciseModel implements IExerciseBLL {
    private object $validationData;
    private IExerciseDataLayer $exerciseDAL;

    public function __construct(iExerciseDataLayer $dal)
    {
        $this->exerciseDAL = $dal;
    }


    public function getAllExercises() : array
    {
        try {
            $result = $this->exerciseDAL->getExercises();
            return [
                'exercises'=> $result,
                'error' => NULL
            ];
        } catch (\PDOException $e) {
            return [
                'exercises'=> '',
                'error' => [
                    'title' => 'Kan oefeningen niet ophalen',
                    'description' => 'Op dit moment kunnen er geen oefeningen worden opgehaald. Probeer het later opnieuw.'
                ]
            ];
        }

    }

    public function getSingleExercise($id) : object {
        return $this->exerciseDAL->getExerciseById($id);
    }
}