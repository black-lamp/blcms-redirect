<?php

use yii\db\Migration;

class m160830_094454_add_pattern_subject_active_column extends Migration
{
    public function up()
    {

        $this->addColumn('redirect', 'pattern', $this->string());
        $this->addColumn('redirect', 'subject', $this->string());
        $this->addColumn('redirect', 'active', $this->boolean()->defaultValue(0));

        $this->dropColumn('redirect', 'from');
        $this->dropColumn('redirect', 'to');
    }

    public function down()
    {
        $this->addColumn('redirect', 'from' ,$this->string());
        $this->addColumn('redirect', 'to' ,$this->string());

        $this->dropColumn('redirect', 'active');
        $this->dropColumn('redirect', 'subject');
        $this->dropColumn('redirect', 'pattern');
    }
}
