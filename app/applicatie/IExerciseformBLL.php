<?php
namespace app\applicatie;

interface IExerciseformBLL {
    public function getAllExcerciseforms();
    public function getExerciseformsByExerciseId(int $id);
    public function joinExerciseWithExerciseform(int $exerciseFormId, int $exerciseId);
    public function patchExerciseWithExerciseform(int $exerciseFormId, int $exerciseId);
}