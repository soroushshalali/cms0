<?php

//foreach ($result as $key => $article):
//    ?>
<!--    <h1>--><?php //echo $article->title;  ?><!--</h1>-->
<!--    <p>--><?php // echo $article->text;  ?><!--</p>-->
<?php // endforeach;  ?>
<?php
foreach ($result as $key => $article) :
?>
<h1><?php echo $article->title ?></h1>
<p><?php echo $article->text ?></p>
<hr>
<?php   endforeach;   ?>
