<?php
class ExerciseModel
{
    private IExerciseDataLayer $exerciseDAL;
    private string $name;
    private string $description;
    private int $repetitions;
    private int $sets;
    private int $id;

    public function __construct(IExerciseDataLayer $dal, string $name, string $description, int $reps = NULL, int $sets = NULL, $id = NULL)
    {
        $this->exerciseDAL = $dal;
        $this->name = $name;
        $this->description = $description;
        if($id !== NULL ) {
            $this->id = $id;
        }
        if($reps !== NULL ) {
            $this->repetitions = $reps;
        }
        if($sets !== NULL ) {
            $this->sets = $sets;
        }
    }

    // return methods
    public function getExerciseName() { return $this->name; }
    public function getExerciseDescription() { return $this->description; }
    public function getExerciseId() { return $this->id; }
    public function getExerciseRepetitions() { return $this->repetitions; }
    public function getExerciseSets() { return $this->sets; }


    public function addExercise() : int
    {
        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'repetitions' => $this->repetitions,
                'sets' => $this->sets
            ];
            return $this->exerciseDAL->addExercise($data);
        }
        catch (Exception $e) {
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

    public function patchExercise() : bool {
        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'repetitions' => $this->repetitions,
                'sets' => $this->sets,
                'id' => $this->id
            ];
            $this->exerciseDAL->patchExercise($data);
            return true;
        }
        catch(Exception $e) {
            return false;
        }

    }
}