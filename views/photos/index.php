<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотографии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Загрузить', ['upload'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered photo-gallery'
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'preview',
                'label' => 'Превью',
                'value' => function($data) {
                    return '<a class="preview" href="/web/' . $data->filePath . '"><img width="100" src="/web/' . $data->filePath . '"></a>';
                },
                'format' => 'html',
            ],
            'fileName',
            //'filePath',
            [
                'attribute' => 'timedate',
                'value' => function($data) {
                    return Yii::$app->formatter->asDate(strtotime($data->timedate), 'php:d.m.Y H:i:s');
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
