<?php $experts_values = simple_fields_fieldgroup('theme_page_experts');

if($experts_values){?>
<div class="experts">
  <h1>Meet the Experts</h1><?php
  foreach ($experts_values as $key =>$values){?>
    <div class="expert">
      <div class="onecol <?php if($key === 0) echo 'first'?>">
        <img src="http://placehold.it/100x100&text=<?php echo $experts_values[$key] ?>" alt=""/>
      </div>
    </div><?php
  }
}?>
</div>