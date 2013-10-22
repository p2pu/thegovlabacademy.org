<h1>Topics</h1>
<?php $topics_values = simple_fields_fieldgroup('theme_page_topics');
foreach ($topics_values as $key => $values) {
  ?>
  <div class="document">
    <div class="twocol first">
      <i class="icon-file-text"></i>
    </div>
    <div class="tencol">
      <h3>
        <a href="<?php echo get_permalink($values['theme_page_topic_page']); ?>"
           target="_blank">
          <?php echo $values['theme_page_topic_name']; ?>
        </a>
      </h3>
      <p><?php echo $values['theme_page_topic_description']; ?></p>
    </div>
  </div>
<?php } ?>