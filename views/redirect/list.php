<?php
/**
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 *
 * @var $this View
 * @var $redirectModel Redirect
 * @var $redirects Redirect[]
 * @var $redirectTypes RedirectType[]
 */

use bl\cms\redirect\entities\Redirect;
use bl\cms\redirect\entities\RedirectType;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Redirects';

?>

<!-- REDIRECTS -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-circle-arrow-right"></i>
                Redirects
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Position</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Comment</th>
                            <th class="text-center">Pattern</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($redirects as $redirect): ?>
                            <tr>
                                <td class="text-center">
                                    <a href="<?= Url::to([
                                        'redirect/up',
                                        'id' => $redirect->id
                                    ]) ?>" class="glyphicon glyphicon-arrow-up text-primary">
                                    </a>
                                    <a href="<?= Url::to([
                                        'redirect/down',
                                        'id' => $redirect->id
                                    ]) ?>" class="glyphicon glyphicon-arrow-down text-primary">
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= Url::to([
                                        'redirect/switch-active',
                                        'id' => $redirect->id
                                    ]) ?>">
                                        <?php if ($redirect->active): ?>
                                            <i class="glyphicon glyphicon-ok text-success"></i>
                                        <?php else: ?>
                                            <i class="glyphicon glyphicon-minus text-danger"></i>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?= $redirect->comment ?>
                                </td>
                                <td class="text-center">
                                    <?= $redirect->pattern ?>
                                </td>
                                <td class="text-center">
                                    <?= $redirect->subject ?>
                                </td>
                                <td class="text-center">
                                    <?= $redirect->type->code ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= Url::to([
                                        'redirect/remove',
                                        'id' => $redirect->id
                                    ]) ?>" class="glyphicon glyphicon-remove text-danger">

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRedirectPopup">
                    <i class="glyphicon glyphicon-plus"></i> Add
                </a>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div>

<!-- Create Redirect Modal -->

<div class="modal fade" id="addRedirectPopup" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $redirectForm = ActiveForm::begin([
                'action' => Url::to(['redirect/create']),
                'method' => 'post'
            ]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Add new redirect</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?= $redirectForm->field($redirectModel, 'comment', [
                        'inputOptions' => [
                            'class' => 'form-control'
                        ]
                    ])->label('Comment')
                    ?>
                </div>
                <div class="form-group">
                    <?= $redirectForm->field($redirectModel, 'pattern', [
                        'inputOptions' => [
                            'class' => 'form-control'
                        ]
                    ])->label('From')
                    ?>
                </div>
                <div class="form-group">
                    <?= $redirectForm->field($redirectModel, 'subject', [
                        'inputOptions' => [
                            'class' => 'form-control'
                        ]
                    ])->label('To')
                    ?>
                </div>
                <div class="form-group">
                    <?= $redirectForm->field($redirectModel, 'type_id')
                        ->dropDownList(ArrayHelper::map($redirectTypes, 'id', 'code'), [
                            'class' => 'form-control'
                        ])->label('Type');
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary pull-right" value="Add">
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
