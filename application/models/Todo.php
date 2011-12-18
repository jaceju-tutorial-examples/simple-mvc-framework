<?php

class Todo
{
    /**
     *
     * @var PDO
     */
    protected static $_pdo = null;

    /**
     *
     * @param PDO $pdo
     */
    public static function setDb(PDO $pdo)
    {
        self::$_pdo = $pdo;
    }

    /**
     *
     * @return array
     */
    public function fetchAll()
    {
        $query = 'SELECT * FROM todo';
        $stmt = self::$_pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $task
     * @return int
     */
    public function add($task)
    {
        $query = 'INSERT INTO todo (task) '
               . 'VALUES (?)';

        self::$_pdo->prepare($query)
                   ->execute(array($task));
        return self::$_pdo->lastInsertId();
    }

    /**
     *
     * @param int $id
     * @return bool
     */
    public function done($id)
    {
        $query = 'UPDATE todo SET done = \'y\' '
               . 'WHERE id = ?';
        $stmt = self::$_pdo->prepare($query);
        $stmt->execute(array($id));
        return $stmt->rowCount();
    }
}

