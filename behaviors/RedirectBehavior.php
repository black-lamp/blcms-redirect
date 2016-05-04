<?php
namespace bl\cms\redirect\behaviors;

use bl\cms\redirect\entities\Redirect;
use Yii;
use yii\base\Behavior;
use yii\web\Controller;

/**
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 */
class RedirectBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    public function beforeAction()
    {
        $url = Yii::$app->getRequest()->getAbsoluteUrl();

        $redirects = Redirect::find()
            ->where(['active' => true])
            ->orderBy(['position' => SORT_ASC])
            ->all();

        if(!empty($url)) {
            foreach($redirects as $redirect) {
                if(preg_match($redirect->pattern, $url)) {
                    $newUrl = preg_replace($redirect->pattern, $redirect->subject, $url);
                    if($newUrl != $url) {
                        Yii::$app->getResponse()->redirect($newUrl, $redirect->type->code);
                        break;
                    }
                }
            }
        }
    }
}