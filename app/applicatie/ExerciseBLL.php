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
        return $this->exerciseDAL->getExercises();

        // verwerk data voor view
    }

    public function getSingleExercise($id) : object {
        return $this->exerciseDAL->getExerciseById($id);
    }
}