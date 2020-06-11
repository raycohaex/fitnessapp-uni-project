<?php
interface IExerciseDataLayer
{
    public function getExercises();
    public function getExerciseById($id);
    public function addExercise($data);
    public function patchExercise($data);
}