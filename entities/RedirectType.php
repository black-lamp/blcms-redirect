<?php
namespace bl\cms\entities;
use yii\db\ActiveRecord;

/**
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 */
class RedirectType extends ActiveRecord
{
    public static function tableName()
    {
        return 'redirect_type';
    }
}