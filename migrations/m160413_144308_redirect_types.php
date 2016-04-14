<?php

use yii\db\Migration;

class m160413_144308_redirect_types extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%redirect_type}}', ['code' => 301, 'title' => 'Moved Permanently']);
        $this->insert('{{%redirect_type}}', ['code' => 302, 'title' => 'Found']);
        $this->insert('{{%redirect_type}}', ['code' => 303, 'title' => 'See Other']);
        $this->insert('{{%redirect_type}}', ['code' => 307, 'title' => 'Temporary Redirect']);
    }

    public function safeDown()
    {
        return true;
    }
}
