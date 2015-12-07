<?php
use frontend\assets\AppAsset;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Тестовое задание № 1';
?>
<div class="site-index">

    <div class="row">
        <h1>Задание № 1</h1>
        <p class="lead">1. Написать SQL-запрос, возвращающий название фирмы и ее телефон. В результате
            должны быть представлены все фирмы по одному разу. Если у фирмы нет телефона,
            нужно вернуть пробел или прочерк. Если у фирмы несколько телефонов, нужно
            вернуть любой из них.</p>
    </div>

    <div class="padingTop">
        <ul class="nav nav-tabs myTab bs-tab-content-top" id="myTab">
            <li role="presentation" class="active"><a href="#main">Исходные данные</a></li>
            <li role="presentation"><a href="#zadacha1">Задание 1 (основное)</a></li>
            <li role="presentation"><a href="#dop-a">Дополнительное (a)</a></li>
            <li role="presentation"><a href="#dop-b">Дополнительное (b)</a></li>
            <li role="presentation"><a href="#dop-c">Дополнительное (c)</a></li>
            <li role="presentation"><a href="#dop-d">Дополнительное (d)</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content bs-tab-content-bootom">
            <div role="tabpanel" class="tab-pane active" id="main">
                <div class="row">
                    <p>Исходные данные:</p>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <p>Таблица Firms:<br>
                        ID Name<br>
                        1 Sony<br>
                        2 Panasonic<br>
                        3 Samsung</p>
                    </div>
                    <div class="col-lg-3">
                        <p>Таблица Phones:<br>
                        phone_id FirmID Phone<br>
                        1 1 332-55-56<br>
                        2 1 332-50-01<br>
                        3 2 256-39-11</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'id',
                                'Name',
                            ],
                        ]); ?>
                    </div>
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderPhones,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'phone_id',
                                'FirmID',
                                'Phone',
                            ],
                        ]); ?>
                </div>
                    </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="zadacha1">
                <div class="row">
                Для представленного примера запрос должен вернуть:
                    </div>
                <div class="row">
                    <div class="col-lg-3">
                Name Phone <br>
                Sony 332-55-56 <br>
                Panasonic 256-39-11 <br>
                Samsung <br>
                        </div>
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider1,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'Name',
                                'pPhone',
                            ],
                        ]); ?>
                    </div>
                    </div>
                <div class="row">
                    SELECT * FROM `Firms` Left Join `Phones` ON `id` = `FirmID` GROUP BY `id`
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="dop-a">
                <div class="row">
                    Дополнительные задания:<br>
                    a. Вернуть все фирмы, не имеющие телефонов.
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider2,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'Name',
                                'pPhone',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">
                    SELECT *
                    FROM `Firms`
                    LEFT JOIN `Phones` ON `id` = `FirmID`
                    GROUP BY `id`
                    HAVING count( `phone_id` ) = '0'
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="dop-b">
                <div class="row">
                    Дополнительные задания:<br>
                    b. Вернуть все фирмы, имеющие не менее 2-х телефонов.
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider3,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'Name',
                                'pPhone',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">

                    SELECT * FROM `Firms` Left Join `Phones` ON `id` = `FirmID` GROUP BY `id` HAVING count(`phone_id`) >= '2'
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="dop-c">
                <div class="row">
                    Дополнительные задания:<br>
                    c. Вернуть все фирмы, имеюшие менее 2-х телефонов.
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider4,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'Name',
                                'pPhone',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">

                    SELECT * FROM `Firms` Left Join `Phones` ON `id` = `FirmID` GROUP BY `id` HAVING count(`phone_id`) < '2'
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="dop-d">
                <div class="row">
                    Дополнительные задания:<br>
                    d. Вернуть фирму, имеющую максимальное кол-во телефонов.
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider5,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'Name',
                                'pPhone',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="row">

                    SELECT *
                    FROM `Firms`
                    LEFT JOIN `Phones` ON `id` = `FirmID`
                    GROUP BY `id`
                    HAVING count( `phone_id` ) = (SELECT MAX( `cpid` ) AS `mcpid`
                    FROM (
                    SELECT count( `FirmID` ) AS `cpid`
                    FROM `Firms`
                    LEFT JOIN `Phones` ON `id` = `FirmID`
                    GROUP BY `FirmID`
                    ) AS cphone)
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/tab.js',['depends' => AppAsset::className()]); ?>
