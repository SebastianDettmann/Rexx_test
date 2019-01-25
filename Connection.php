<?php

class Connection
{
    public static function make($conf)
    {
        try {
            return new PDO(
                $conf['connection'] . ';dbname=' . $conf['db'],
                $conf['user'],
                $conf['password'],
                $conf['options']);
        } catch (PDOException $e) {
            echo 'Fehler: ' . htmlspecialchars($e->getMessage());
        }
    }
}