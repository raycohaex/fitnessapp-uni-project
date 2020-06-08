<?php
class ExerciseDTO {

    private $name;
    private $description;

    function ExerciseDTO(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;
    }

    public function getExerciseName() { return $this->name; }
    public function getExerciseDescription() { return $this->description; }
}