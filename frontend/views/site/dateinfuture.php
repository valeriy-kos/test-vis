<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 25.10.15
 * Time: 21:44
 */
use yii\helpers\Html;

$this->params['DateInFuture'] = 'DateInFuture';

$this->title = 'Обратный отсчет до Нового года!';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
<div id="countdown"></div>

<p id="note"></p>
    </div>
</div>

