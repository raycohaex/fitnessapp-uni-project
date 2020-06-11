<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use app\applicatie;

use app\applicatie\ExerciseModel;

final class ExerciseTest extends TestCase
{
    public function testCreateExerciseAndValidate(): void
    {
        // arrange
        $ex = new ExerciseModel('Benchpress', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertTrue($result);
    }

    public function testCreateExerciseAndValidateEmptyTitle(): void
    {
        // arrange
        $ex = new ExerciseModel('', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result);
    }

    public function testCreateExerciseAndValidateEmptyDescription(): void
    {
        // arrange
        $ex = new ExerciseModel('Benchpress', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result);
    }

    public function testCreateExerciseAndValidateEmptyAllFields(): void
    {
        // arrange
        $ex = new ExerciseModel('', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result);
    }


}

