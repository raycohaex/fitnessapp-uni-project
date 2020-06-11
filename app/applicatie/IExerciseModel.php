<?php
Interface IExerciseModel {
    public function getExerciseName();
    public function getExerciseDescription();
    public function getExerciseId();
    public function getExerciseRepetitions();
    public function getExerciseSets();
    public function addExercise();
    public function validateExercise();
    public function patchExercise();
}
