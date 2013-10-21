<div class="experts">
  <h1>Meet the Experts</h1>
  <?php $experts_values = simple_fields_fieldgroup('topic_experts');
  foreach ($experts_values as $key =>$values){

    ?>
    <div class="expert">
      <div class="twocol">
        <img src="http://placehold.it/400x400&text=<?php echo $experts_values[$key] ?>" alt=""/>
      </div>
    </div>
  <?php } ?>

</div>