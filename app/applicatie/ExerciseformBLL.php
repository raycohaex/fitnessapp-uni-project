<?php
class ExerciseformBLL implements IExerciseformBLL {
    private IExerciseformDataLayer $exerciseformDAL;

    public function __construct(IExerciseformDataLayer $dal)
    {
        $this->exerciseformDAL = $dal;
    }

    public function getAllExcerciseforms() : array
    {
        return $this->exerciseformDAL->getAllExerciseforms();

        // verwerk data voor view
    }

    public function getExerciseformsByExerciseId($id) : array {
        return $this->exerciseformDAL->getExerciseformsByExerciseId($id);
    }

    public function joinExerciseWithExerciseform($exerciseFormId, $exerciseId) : void{
        $this->exerciseformDAL->joinExerciseWithExerciseform($exerciseFormId, $exerciseId);
    }
}