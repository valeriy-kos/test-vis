<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GuestBook */

$this->title = 'Create Guest Book';
$this->params['breadcrumbs'][] = ['label' => 'Guest Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
