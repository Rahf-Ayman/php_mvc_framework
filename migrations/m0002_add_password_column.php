<?php

use McQueen\phpmvc\Application;

class m0002_add_password_column 
{
    public function Up()
    {
        $db = Application::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL;";
        $db->pdo->exec($SQL);
    }

    public function Down()
    {
        $db = Application::$app->db;
        $SQL = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($SQL);
    }
}    