<?php
namespace bl\cms\redirect\entities;
use yii\db\ActiveRecord;

/**
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 */
class Redirect extends ActiveRecord
{
    public static function tableName()
    {
        return 'redirect';
    }

    public function getType() {
        return $this->hasOne(RedirectType::className(), ['id' => 'type_id']);
    }
}