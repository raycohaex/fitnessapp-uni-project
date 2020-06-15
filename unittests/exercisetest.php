<?php
declare(strict_types=1);

require_once 'app/bootstrap.php';

use PHPUnit\Framework\TestCase;
use app\applicatie\ExerciseModel;

final class ExerciseTest extends TestCase
{
    public function testCreateExerciseAndValidate(): void
    {
        // arrange
        $ex = new ExerciseModel(new \app\DAL\ExerciseDataLayer(), 'Benchpress', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertTrue($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyTitle(): void
    {
        // arrange
        $ex = new ExerciseModel(new \app\DAL\ExerciseDataLayer(),'', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyDescription(): void
    {
        // arrange
        $ex = new ExerciseModel(new \app\DAL\ExerciseDataLayer(), 'Benchpress', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyAllFields(): void
    {
        // arrange
        $ex = new ExerciseModel(new \app\DAL\ExerciseDataLayer(), '', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }


}

