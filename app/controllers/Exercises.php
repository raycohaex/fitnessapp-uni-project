<?php
declare(strict_types=1);

class Exercises extends Controller
{
    public array $data;
    private object $exercise;
    private object $exercises;

    public function __construct()
    {
        $this->exerciseModel = $this->model('Exercise');
    }


    public function index(): void
    {
        $exercises = $this->exerciseModel->getExercises();
        $data = [
            'exercises' => $exercises
        ];
        $this->view('exercises/index', $data);
    }


    public function show($id): void
    {
        $exercise = $this->exerciseModel->getExerciseById($id);
        $data = [
            'exercise' => $exercise
        ];
        $this->view('exercises/show', $data);
    }


    public function add(): void
    {
        $data = [
            'name' => '',
            'description' => ''
        ];

        $this->view('exercises/add', $data);
    }


    public function edit($id): void
    {
        $exercise = $this->exerciseModel->getExerciseById($id);
        $data = [
            'id' => $id,
            'name' => $exercise->name,
            'description' => $exercise->description
        ];

        $this->view('exercises/edit', $data);
    }


    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'name_err' => '',
                'description_err' => ''
            ];

            if (empty($data['name'])) {
                $data['name_err'] = 'Geef een naam op';
            }

            if (empty($data['description'])) {
                $data['description_err'] = 'Geef een beschrijving op';
            }

            if (empty($data['name_err']) && empty($data['description_err'])) {
                //success
                if ($this->exerciseModel->addExercise($data)) {
                    redirect('exercises');
                } else {
                    die('error pagina');
                }
            } else {
                $this->view('exercises/add', $data);
            }
        }
    }


    public function patch($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'name_err' => '',
                'description_err' => ''
            ];

            if (empty($data['name'])) {
                $data['name_err'] = 'Geef een naam op';
            }

            if (empty($data['description'])) {
                $data['description_err'] = 'Geef een beschrijving op';
            }

            if (empty($data['name_err']) && empty($data['description_err'])) {
                //success
                if ($this->exerciseModel->patchExercise($data)) {
                    redirect('exercises');
                } else {
                    die('error pagina');
                }
            } else {
                $this->view('exercises/edit', $data);
            }
        }
    }
}
