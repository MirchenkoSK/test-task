<?php

namespace App\Models;

use App\Components\Database;

class User
{

    /**
     * Проверяем существует ли пользователь с заданными $name и $password
     */
    public static function checkUserData($name, $password)
    {
        $db = Database::getConnection();

        $sql = 'SELECT * FROM users WHERE name = :name AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, \PDO::PARAM_INT);
        $result->bindParam(':password', $password, \PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /login");
        exit;
    }

    /**
     * Проверяет является ли пользователь гостем
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяет пароль: не меньше, чем 3 символов
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 3) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 3 символа
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 3) {
            return true;
        }
        return false;
    }

}