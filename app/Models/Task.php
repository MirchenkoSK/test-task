<?php

namespace App\Models;

use App\Components\Database;

class Task
{

    // id, name, email, text, status, created_at, updated_at

	public static function find($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Database::getConnection();
			$result = $db->query('SELECT * FROM tasks WHERE id='.$id);

			$result->setFetchMode(\PDO::FETCH_ASSOC);

			$task = $result->fetch();

			return $task;
		}

	}

    public static function count()
	{
        $db = Database::getConnection();
        $result = $db->query('SELECT COUNT(*) FROM tasks');
        $count = $result->fetch();
        return $count[0];
    }


	public static function get($page, $sort, $order)
    {
		$db = Database::getConnection();

        $offset = ($page - 1) * 3;

		$tasks = [];

		$result = $db->query('SELECT * FROM tasks ORDER BY '.$order.' '.$sort.' LIMIT 3 OFFSET '.$offset);

		$i = 0;
		while($row = $result->fetch()) {
			$tasks[$i]['id'] = $row['id'];
			$tasks[$i]['name'] = $row['name'];
			$tasks[$i]['email'] = $row['email'];
			$tasks[$i]['text'] = $row['text'];
			$tasks[$i]['status'] = $row['status'];
			$tasks[$i]['created_at'] = $row['created_at'];
			$tasks[$i]['updated_at'] = $row['updated_at'];
			$i++;
		}

		return $tasks;
	}

	public static function create($name, $email, $text)
	{
		$db = Database::getConnection();

        $sql = 'INSERT INTO tasks (name, email, text) '
                . 'VALUES (:name, :email, :text)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', htmlspecialchars($name), \PDO::PARAM_STR);
        $result->bindParam(':email', htmlspecialchars($email), \PDO::PARAM_STR);
        $result->bindParam(':text', htmlspecialchars($text), \PDO::PARAM_STR);
        return $result->execute();
	}

	public static function update($id, $name, $email, $text)
	{
		$db = Database::getConnection();

        $sql = 'UPDATE tasks SET name = :name, email = :email, text = :text, updated_at = :updated_at WHERE id = :id';

        $result = $db->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':name', htmlspecialchars($name), \PDO::PARAM_STR);
        $result->bindParam(':email', htmlspecialchars($email), \PDO::PARAM_STR);
        $result->bindParam(':text', htmlspecialchars($text), \PDO::PARAM_STR);
        $result->bindParam(':updated_at', date('Y-m-d H:i:s'), \PDO::PARAM_STR);
        return $result->execute();
	}

	public static function success($id)
	{
		$db = Database::getConnection();

        $sql = 'UPDATE tasks SET status = 1 WHERE id = :id';

        $result = $db->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
        return $result->execute();
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

	/**
     * Проверяет email
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

	/**
     * Проверяет имя: не меньше, чем 3 символа
     */
    public static function checkText($text)
    {
        if (strlen($text) >= 3) {
            return true;
        }
        return false;
    }

}