<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

<div class="media">
  <div class="media-left media-middle">
    <a href="#">
      <img class="media-object" src="../../uploads/<?= $model->image ?>" alt="<?= $model->title ?>">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">On <?= Yii::$app->formatter->asDatetime($model->created_at, "php:d-m-Y H:i:s")  ?> by Admin</h4>
    <?= $model->content ?>
  </div>
</div>



</div>
