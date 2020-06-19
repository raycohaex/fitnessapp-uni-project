<?php

declare(strict_types=1);

namespace app\applicatie;

use app\DAL\ExerciseformDataLayer;
use app\DAL\IExerciseDataLayer;

class ExerciseModel implements IExerciseModel
{
    private IExerciseDataLayer $exerciseDAL;
    private string $name;
    private string $description;
    private int $repetitions;
    private int $sets;
    private int $id;

    public function __construct(
        IExerciseDataLayer $dal,
        string $name,
        string $description,
        int $reps = null,
        int $sets = null,
        $id = null
    ) {
        $this->exerciseDAL = $dal;
        $this->name = $name;
        $this->description = $description;
        if ($id !== null) {
            $this->id = $id + 0;
        }
        if ($reps !== null) {
            $this->repetitions = $reps;
        }
        if ($sets !== null) {
            $this->sets = $sets;
        }
    }

    // return methods
    public function getExerciseName()
    {
        return $this->name;
    }

    public function getExerciseDescription()
    {
        return $this->description;
    }

    public function getExerciseId()
    {
        return $this->id;
    }

    public function getExerciseRepetitions()
    {
        return $this->repetitions;
    }

    public function getExerciseSets()
    {
        return $this->sets;
    }


    public function addExercise(int $exerciseFormJoinID = 0): int
    {
        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'repetitions' => $this->repetitions,
                'sets' => $this->sets
            ];

            $result = $this->exerciseDAL->addExercise($data);

            if ($exerciseFormJoinID !== 0) {
                $exerciseformBLL = new ExerciseformBLL(new ExerciseformDataLayer());
                $exerciseformBLL->joinExerciseWithExerciseform($exerciseFormJoinID, $result);
            }

            return $result;
        } catch (Exception $e) {
            return 0;
        }
    }


    public function validateExercise(): array
    {
        if (empty($this->name)) {
            $validationData['nameErr'] = 'Geef een naam op';
        } else {
            $validationData['nameErr'] = '';
        }

        if (empty($this->description)) {
            $validationData['descriptionErr'] = 'Geef een beschrijving op';
        } else {
            $validationData['descriptionErr'] = '';
        }

        if (empty($this->name) || empty($this->description)) {
            $validationData['valid'] = false;
        } else {
            $validationData['valid'] = true;
        }

        return $validationData;
    }

    public function patchExercise(int $exerciseFormJoinID = 0): bool
    {
        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'repetitions' => $this->repetitions,
                'sets' => $this->sets,
                'id' => $this->id
            ];
            $this->exerciseDAL->patchExercise($data);
            if ($exerciseFormJoinID !== 0) {
                $exerciseformBLL = new ExerciseformBLL(new ExerciseformDataLayer());
                $exerciseformBLL->patchExerciseWithExerciseform($exerciseFormJoinID, $this->id);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}