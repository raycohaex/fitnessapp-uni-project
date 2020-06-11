<?php
namespace app\DAL;

interface IExerciseformDataLayer {
    public function getAllExerciseforms();
    public function getExerciseformsByExerciseId($id);
    public function joinExerciseWithExerciseform($exerciseformID, $exerciseID);
}