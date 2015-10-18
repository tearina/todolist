<?php

use yii\db\Schema;
use yii\db\Migration;

class m151018_151147_create_task_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%task}}', [
            'id' => Schema::TYPE_PK,
            'task' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%task}}');
    }

}
