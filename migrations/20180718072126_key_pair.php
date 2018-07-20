<?php

use Phpmig\Migration\Migration;

class KeyPair extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $db = $this->container['db'];
        $db->exec('CREATE TABLE `access_secret_key` ( `id` INT NOT NULL AUTO_INCREMENT , `access_key` VARCHAR(32) NOT NULL , `secret_key` VARCHAR(32) NOT NULL , `created_time` INT(10) NOT NULL , `updated_time` INT(10) NOT NULL , PRIMARY KEY (`id`), UNIQUE `ak` (`access_key`, `secret_key`)) ENGINE = InnoDB;');
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $db = $this->container['db'];
        $db->exec('DROP TABLE `access_secret_key`');
    }
}
