<?php

use app\core\Application;

class m002_add_password_column_user_table
{
    public function up()
    {
        echo "Migration up";
        $db = Application::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";
        $db->pdo->exec($SQL);
    }
    public function down()
    {
        echo "Migration down";
        $db = Application::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";
        $db->pdo->exec($SQL);
    }
}
