<?php
namespace app\DAL;

interface IExerciseformDataLayer {
    public function getAllExerciseforms();
    public function getExerciseformsByExerciseId(int $id);
    public function joinExerciseWithExerciseform(int $exerciseformID, int $exerciseID);
    public function patchExerciseWithExerciseform(int $exerciseformID, int $exerciseID);
}