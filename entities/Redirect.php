<?php
namespace bl\cms\redirect\entities;

use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * Class Redirect
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 *
 * @property string $pattern
 * @property string $subject
 * @property string $redirect
 * @property string $comment
 * @property RedirectType $type
 */
class Redirect extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'positionBehavior' => [
                'class' => PositionBehavior::className(),
                'positionAttribute' => 'position',
            ],
        ];
    }

    public static function tableName()
    {
        return 'redirect';
    }

    public function rules()
    {
        return [
            [['comment', 'subject', 'pattern'], 'string'],
            [['active'], 'boolean'],
            [['pattern', 'subject'], 'required'],
            [
                'type_id', 'exist',
                'targetClass' => RedirectType::className(),
                'targetAttribute' => 'id',
                'message' => 'This request type does not exists.'
            ],
        ];
    }


    public function getType() {
        return $this->hasOne(RedirectType::className(), ['id' => 'type_id']);
    }
}