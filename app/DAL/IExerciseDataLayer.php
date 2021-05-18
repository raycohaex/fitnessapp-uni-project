<?php
namespace app\DAL;

interface IExerciseDataLayer
{
    public function getExercises();
    public function getExerciseById(int $id);
    public function addExercise(array $data);
    public function patchExercise(array $data);
}