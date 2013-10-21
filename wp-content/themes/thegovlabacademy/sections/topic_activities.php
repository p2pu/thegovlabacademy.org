<h1>Activites</h1>
<?php $documents_values = simple_fields_fieldgroup('topic_page_activities');
foreach ($documents_values as $key => $values) {
  ?>
  <div class="document">
    <div class="twocol first">
      <i class="icon-cog"></i>
    </div>
    <div class="tencol">
      <h3>
        <a href="<?php echo $values['topic_page_activity_url']; ?>"
           target="_blank">
          <?php echo $values['topic_page_activity_title']; ?>
        </a>
      </h3>
      <p><?php echo $values['topic_page_activity_description']; ?></p>
    </div>
  </div>
<?php } ?>