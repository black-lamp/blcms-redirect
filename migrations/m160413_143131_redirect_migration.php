<?php

use yii\db\Migration;

class m160413_143131_redirect_migration extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(),
            'from' => $this->string(255),
            'to' => $this->string(255),
            'type_id' => $this->integer(),
            'position' => $this->integer(),
            'comment' => $this->string(255)
        ]);

        $this->createTable('{{%redirect_type}}', [
            'id' => $this->primaryKey(),
            'code' => $this->integer(),
            'title' => $this->string(255)
        ]);

        $this->addForeignKey(
            'redirect_redirect_type',
            '{{%redirect}}', 'type_id',
            '{{%redirect_type}}', 'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%redirect}}');
        $this->dropTable('{{%redirect_type}}');
    }

}
