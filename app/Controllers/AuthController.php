<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {

    public function login()
    {
        if (!User::isGuest()) {
            header("Location: /");
        }
        // Обработка формы
        if (isset($_POST['submit'])) {

            // Если форма отправлена 
            // Получаем данные из формы
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Валидация полей
            if (!User::checkName($name)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 3-х символов';
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($name, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                // Перенаправляем пользователя на главную 
                header("Location: /");
            }
        }

        // Подключаем вид
        require_once __DIR__.'/../Views/LoginTemplate.php';
        return true;
    }

    public function logout()
    {        
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}