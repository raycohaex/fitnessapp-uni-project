<?php

declare(strict_types=1);

namespace app\applicatie;

use app\DAL\IExerciseformDataLayer;
use PDOException;

class ExerciseformBLL implements IExerciseformBLL
{
    private IExerciseformDataLayer $exerciseformDAL;

    public function __construct(IExerciseformDataLayer $dal)
    {
        $this->exerciseformDAL = $dal;
    }

    public function getAllExcerciseforms(): array
    {
        try {
            $result = $this->exerciseformDAL->getAllExerciseforms();
            return [
                'exerciseforms' => $result,
                'error' => null
            ];
        } catch (PDOException $e) {
            return [
                'exerciseforms' => '',
                'error' => [
                    'title' => 'Kan oefeningen niet ophalen',
                    'description' => 'Op dit moment kunnen er geen oefeningen worden opgehaald. Probeer het later opnieuw.'
                ]
            ];
        }
    }

    public function getExerciseformsByExerciseId(int $id): array
    {
        try {
            $result = $this->exerciseformDAL->getExerciseformsByExerciseId($id);
            return [
                'exerciseforms' => $result,
                'error' => null
            ];
        } catch (PDOException $e) {
            return [
                'exerciseforms' => '',
                'error' => [
                    'title' => 'Kan oefeningen niet ophalen',
                    'description' => 'Op dit moment kunnen er geen oefeningen worden opgehaald. Probeer het later opnieuw.'
                ]
            ];
        }
    }

    public function joinExerciseWithExerciseform(int $exerciseFormId, int $exerciseId): void
    {
        $this->exerciseformDAL->joinExerciseWithExerciseform($exerciseFormId, $exerciseId);
    }

    public function patchExerciseWithExerciseform(int $exerciseFormId, int $exerciseId): void
    {
        $this->exerciseformDAL->patchExerciseWithExerciseform($exerciseFormId, $exerciseId);
    }
}