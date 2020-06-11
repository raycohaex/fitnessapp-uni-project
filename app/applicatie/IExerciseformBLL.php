<?php
interface IExerciseformBLL {
    public function getAllExcerciseforms();
    public function getExerciseformsByExerciseId($id);
    public function joinExerciseWithExerciseform($exerciseFormId, $exerciseId);
}