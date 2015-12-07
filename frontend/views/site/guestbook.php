<?php

use backend\assets\AppAsset;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GuestBook */
/* @var $form ActiveForm */
$this->title = 'Гостевая книга';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-guestbook">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(is_array($allItems) && !empty($allItems)){
        foreach($allItems as $item) {?>
        <div class="row">
            <div class="col-lg-9">
            <div class="panel panel-default"><div class="panel-heading">
                <div class="row">
                    <div class="col-lg-3"><?=$item->created_at;?></div>
                    <div class="col-lg-3"><?=$item->name;?></div>
                    <div class="col-lg-3"><?=$item->email;?></div></div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-default"><div class="panel-heading">
                        <h2 class="panel-title"><?=$item->title;?></h2>
                        </div></div>
                    <div class="panel-body">
                    <p><?=$item->content; ?></p>
                    </div>
                </div>
            </div>

        </div>
            </div>

    <? } } ?>


    <div class="row">
        <p>
            Если Вы хотите оставить отзыв в гостевой книге, заполните поля формы! Спасибо.
        </p>
        <div class="col-lg-6">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'guest-book',
            /*'enableClientValidation' => false,*/
            'enableAjaxValidation' => true,
            'validationUrl' => 'valid-guest-book',
            ]); ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'content')->textArea(['rows' => 6]) ?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary','id'=>'button-guest-book']) ?>
        </div>
    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div><!-- site-guestbook -->
<?php  /*$this->registerJsFile('/js/_guest-book.js',['depends' => AppAsset::className()]);*/ ?>