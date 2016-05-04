<?php
namespace bl\cms\redirect\controllers;

use bl\cms\redirect\entities\Redirect;
use bl\cms\redirect\entities\RedirectType;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 */
class RedirectController extends Controller
{
    public $defaultAction = 'list';

    public function actionList() {
        return $this->render('list', [
            'redirects' => Redirect::find()->orderBy(['position' => SORT_ASC])->all(),
            'redirectTypes' => RedirectType::find()->all(),
            'redirectModel' => new Redirect()
        ]);
    }

    public function actionCreate() {
        $redirect = new Redirect();

        if(!$redirect->load(\Yii::$app->request->post())) {
            Yii::$app->session->setFlash('error', 'Model load error');
        }

        if(!$redirect->save()) {
            Yii::$app->session->setFlash('error', 'Model save error');
        }

        return $this->redirect(Url::to(['/redirect']));
    }

    public function actionRemove($id) {
        Redirect::deleteAll(['id' => $id]);
        return $this->redirect(Url::to(['/redirect']));
    }

    public function actionUp($id) {
        if($redirect = Redirect::findOne($id)) {
            $redirect->movePrev();
        }

        return $this->redirect(Url::to(['/redirect']));
    }

    public function actionDown($id) {
        if($redirect = Redirect::findOne($id)) {
            $redirect->moveNext();
        }

        return $this->redirect(Url::to(['/redirect']));
    }

    public function actionSwitchActive($id) {
        if($redirect = Redirect::findOne($id)) {
            $redirect->active = !$redirect->active;
            $redirect->save();
        }

        return $this->redirect(Url::to(['/redirect']));
    }
}