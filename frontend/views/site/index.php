<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii2 Blog!</h1>

        <p class="lead">Latest updates</p>
        
    </div>

    <div class="body-content">
    <div class="row">

     <?php if(count($model) > 0){ ?> 

      <?php foreach($model as $post) { ?> 
      
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../../uploads/<?= $post->image ?>" alt="<?= $post->title ?>"  height="200">
          <div class="caption">
            <h3><?= $post->title ?></h3>
            <p><?= $post->content ?></p>
            <p><a href="<?= Yii::$app->urlManager->createUrl(["post/detail","id"=>$post->id]) ?>" class="btn btn-primary" role="button">Read More </a></p>
          </div>
        </div>
      </div>
   
     <?php } ?>

    <?php } else { echo 'No Post Found!'; }?>            


        </div>
    </div>
</div>
