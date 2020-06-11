<?php

declare(strict_types=1);


class Exercises extends Controller
{
    public array $data;
    private object $exercise;
    private ExerciseMethods $exerciseBLL; // moet interface worden

    public function __construct()
    {
        $this->exerciseBLL = new ExerciseMethods(new ExerciseDataLayer());
    }


    public function index(): void
    {
        $exercises = $this->exerciseBLL->getAllExercises();
        $data = [
            'exercises' => $exercises
        ];
        $this->view('exercises/index', $data);
    }


    public function show($id): void
    {
        $exercise = $this->exerciseBLL->getSingleExercise($id);
        $data = [
            'exercise' => $exercise
        ];
        $this->view('exercises/show', $data);
    }


    public function add(): void
    {
        // Routing method that stays in the presentation layer, has no connection to the logic.
        $data = [
            'name' => '',
            'description' => '',
            'repetitions' => '',
            'sets' => ''
        ];

        $this->view('exercises/add', $data);
    }


    public function edit($id): void
    {
        $exercise = $this->exerciseBLL->getSingleExercise($id);
        $data = [
            'id' => $id,
            'name' => $exercise->name,
            'description' => $exercise->description,
            'repetitions' => $exercise->repetitions,
            'sets' => $exercise->sets
        ];

        $this->view('exercises/edit', $data);
    }


    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $repetitions = (is_numeric($_POST['repetitions']) ? (int)$_POST['repetitions'] : 0);
            $sets = (is_numeric($_POST['sets']) ? (int)$_POST['sets'] : 0);

            // Create new object from ExerciseModel
            $newExercise = new ExerciseModel(new ExerciseDataLayer(), $name, $description, $repetitions, $sets);

            // validate ExerciseModel in ExericseBLL
            $validateExercise = $newExercise->validateExercise();

            if ($validateExercise['valid'] == true) {
                $result = $newExercise->addExercise();
                if ($result === true) {
                    redirect('index');
                }
            } else {
                if ($validateExercise['descriptionErr']) {
                    $data['description_err'] = $validateExercise['descriptionErr'];
                }
                if ($validateExercise['nameErr']) {
                    $data['name_err'] = $validateExercise['nameErr'];
                }
                $data['name'] = $newExercise->getExerciseName();
                $data['description'] = $newExercise->getExerciseDescription();

                $this->view('exercises/add', $data);
            }
        }
    }


    public function patch($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $repetitions = (is_numeric($_POST['repetitions']) ? (int)$_POST['repetitions'] : 0);
            $sets = (is_numeric($_POST['sets']) ? (int)$_POST['sets'] : 0);


            $editExercise = new ExerciseModel(new ExerciseDataLayer(), $name, $description, $repetitions, $sets, $id);

            // validate ExerciseModel in ExericseBLL
            $validateExercise = $editExercise->validateExercise();

            if ($validateExercise['valid'] == true) {
                $result = $editExercise->patchExercise();
                if ($result === true) {
                    redirect('index');
                }
            } else {
                if ($validateExercise['descriptionErr']) {
                    $data['description_err'] = $validateExercise['descriptionErr'];
                }
                if ($validateExercise['nameErr']) {
                    $data['name_err'] = $validateExercise['nameErr'];
                }
                $data['name'] = $editExercise->getExerciseName();
                $data['description'] = $editExercise->getExerciseDescription();

                $this->view('exercises/edit', $data);
            }
        }
    }
}
