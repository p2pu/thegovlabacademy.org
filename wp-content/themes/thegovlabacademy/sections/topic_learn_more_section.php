<?php $learn_more_values = simple_fields_fieldgroup('topic_learn_more_section');

foreach ($learn_more_values as $key => $values) {

  ?>
  <div class="fivecol">
    <iframe width="100%" height="315"
            src="<?php echo $values['you_tube_id']; ?>"
            frameborder="0" allowfullscreen></iframe>
    <p><?php echo $values['learn_more_description']; ?></p></div>
<?php } ?>
</div>