<?php
declare(strict_types=1);
namespace app\applicatie;
use app\DAL\IExerciseformDataLayer;

class ExerciseformBLL implements IExerciseformBLL {
    private IExerciseformDataLayer $exerciseformDAL;

    public function __construct(IExerciseformDataLayer $dal)
    {
        $this->exerciseformDAL = $dal;
    }

    public function getAllExcerciseforms() : array
    {
        try {
            $result = $this->exerciseformDAL->getAllExerciseforms();
            return [
                'exerciseforms'=> $result,
                'error' => NULL
            ];
        } catch (\PDOException $e) {
            return [
                'exerciseforms'=> '',
                'error' => [
                    'title' => 'Kan oefeningen niet ophalen',
                    'description' => 'Op dit moment kunnen er geen oefeningen worden opgehaald. Probeer het later opnieuw.'
                ]
            ];
        }
    }

    public function getExerciseformsByExerciseId($id) : array {
        return $this->exerciseformDAL->getExerciseformsByExerciseId($id);
    }

    public function joinExerciseWithExerciseform($exerciseFormId, $exerciseId) : void{
        $this->exerciseformDAL->joinExerciseWithExerciseform($exerciseFormId, $exerciseId);
    }
}