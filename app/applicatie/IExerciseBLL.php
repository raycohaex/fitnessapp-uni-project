<?php
namespace app\applicatie;

interface IExerciseBLL {
    public function getAllExercises();
    public function getSingleExercise(int $id);
}