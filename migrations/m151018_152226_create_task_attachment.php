<?php

use yii\db\Schema;
use yii\db\Migration;

class m151018_152226_create_task_attachment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%attachment}}', [
            'id' => Schema::TYPE_PK,
            'task_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'is_pic' => Schema::TYPE_BOOLEAN,
            'FOREIGN KEY (task_id) REFERENCES {{%task}}(id)
                ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%attachment}}');
    }

}
