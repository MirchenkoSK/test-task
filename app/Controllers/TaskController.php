<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class TaskController {

    public function index()
    {
        $page = 1;
        $sort = 'ASC';
        $order = 'name';
        
        // Проблема в том, что если передать неправильное значение, возникнет ошибка.
        // Но если жать просто на кнопки, все работает.
        // Я хотел сделать полноценный Request класс, который обрабатывал бы запрос,
        // но моя энергия была на исходе. Оставляю этот гавнокод. =(
        if (isset($_SERVER['QUERY_STRING'])) {
            $query = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($query as $arg) {
                $argument = explode('=', $arg);
                if ($argument[0] == 'page') {
                    $page = $argument[1];
                } elseif ($argument[0] == 'sort') {
                    $sort = $argument[1];
                } elseif ($argument[0] == 'order') {
                    $order = $argument[1];
                }
            }
        }

        $count = Task::count();
        $pagination = ($count - ($count % 3)) / 3 + (($count % 3) ? 1 : 0);

        $tasks = Task::get($page, $sort, $order);

        require_once __DIR__.'/../Views/IndexTemplate.php';
        return true;
    }

    public function create()
    {
        // Обработка формы
        if (isset($_POST['submit'])) {

            // Если форма отправлена 
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $text = $_POST['text'];

            $errors = false;

            // Валидация полей
            if (!Task::checkName($name)) {
                $errors[] = 'Имя должно быть больше трех букв в длинну';
            }
            if (!Task::checkEmail($email)) {
                $errors[] = 'Хорошая попытка, но Email вводите правильно';
            }
            if (!Task::checkText($text)) {
                $errors[] = 'Текст тоже должен содержать более трех букв';
            }

            if (!$errors) {
                if (Task::create($name, $email, $text)) {
                    header("Location: /");
                } else {
                    $errors[] = 'Не удалось сохранить задачу';
                }
            }
        }

        require_once __DIR__.'/../Views/CreateTaskTemplate.php';
        return true;
    }

    public function edit($id)
    {
        User::checkLogged();

        if (!$task = Task::find($id)) {
            echo 'Task Not Found';
            exit;
        }

        // Обработка формы
        if (isset($_POST['submit'])) {

            // Если форма отправлена 
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $text = $_POST['text'];

            $errors = false;

            // Валидация полей
            if (!Task::checkName($name)) {
                $errors[] = 'Имя должно быть больше трех букв в длинну';
            }
            if (!Task::checkEmail($email)) {
                $errors[] = 'Хорошая попытка, но Email вводите правильно';
            }
            if (!Task::checkText($email)) {
                $errors[] = 'Текст тоже должен содержать более трех букв';
            }

            if (!$errors) {
                if (Task::update($id, $name, $email, $text)) {
                    header("Location: /");
                } else {
                    $errors[] = 'Не удалось сохранить задачу';
                }
            }
        }

        require_once __DIR__.'/../Views/EditTaskTemplate.php';
        return true;
    }

    public function success($id)
    {
        User::checkLogged();

        if (!$task = Task::find($id)) {
            echo 'Task Not Found';
            exit;
        }
        
        if (Task::success($id)) {
            header("Location: /");
        } else {
            $errors[] = 'Не удалось обновить статус задачи';
        }

        return true;
    }

    public function error()
    {
        echo "Page Not Found";
        return true;
    }

}