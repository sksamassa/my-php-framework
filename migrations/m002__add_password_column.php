<?php   
    class m002__add_password_column {
        public function up() {
            $db = \Sksamassa\MyFramework\src\Application::$app -> db;
            $db -> pdo -> exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
        }

        public function down() {
            $db = \Sksamassa\MyFramework\src\Application::$app -> db;
            $db -> pdo -> exec("ALTER TABLE users DROP COLUMN password");
        }
    }