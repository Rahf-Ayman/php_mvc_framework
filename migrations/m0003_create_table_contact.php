<?php

use McQueen\phpmvc\Application;

class m0003_create_table_contact 
{
    public function Up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            subject VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            body VARCHAR(255) NOT NULL,
            createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function Down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE contacts;";
        $db->pdo->exec($SQL);
    }
}    