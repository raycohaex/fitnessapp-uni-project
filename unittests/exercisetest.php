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
        $stub = $this->createMock(\app\DAL\ExerciseDataLayer::class);
        $ex = new ExerciseModel($stub, 'Benchpress', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertTrue($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyTitle(): void
    {
        // arrange
        $stub = $this->createMock(\app\DAL\ExerciseDataLayer::class);
        $ex = new ExerciseModel($stub,'', 'Beschrijving');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyDescription(): void
    {
        // arrange
        $stub = $this->createMock(\app\DAL\ExerciseDataLayer::class);
        $ex = new ExerciseModel($stub, 'Benchpress', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }

    public function testCreateExerciseAndValidateEmptyAllFields(): void
    {
        // arrange
        $stub = $this->createMock(\app\DAL\ExerciseDataLayer::class);
        $ex = new ExerciseModel($stub, '', '');

        //act
        $result = $ex->validateExercise();

        //assert
        $this->assertFalse($result['valid']);
    }

    public function testThatAddReturntypeIsIntFromAddingExercise()
    {
        // validate that return type after adding an exercise is an int.
        // Int returned will be 0 since it doesnt contain a database row
        // arrange
        $stub = $this->createMock(\app\DAL\ExerciseDataLayer::class);

        //act
        $exercise = new ExerciseModel($stub, 'benchpress', 'blablabla', 5, 5);
        $result = $exercise->addExercise();

        //assert
        $this->assertIsInt($result);
    }
}
