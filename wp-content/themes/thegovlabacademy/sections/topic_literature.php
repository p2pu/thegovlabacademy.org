<?php $documents_values = simple_fields_fieldgroup('topic_page_read_section');
if ($documents_values) {?>
  <h1>Read</h1><?php
  foreach ($documents_values as $key => $values) {
    print_r($values['id']);
    ?>
    <div class="document">
      <div class="twocol first">
        <i class="icon-file-text"></i>
      </div>
      <div class="tencol">
        <h3>
          <a href="<?php echo simple_fields_get_post_value($values['id'], "Link to document", true); ?>"
             target="_blank">
            <?php echo $values['title']; ?>
          </a>
        </h3>

        <p><?php echo simple_fields_get_post_value($values['id'], "Description", true); ?></p>
      </div>
    </div>
  <?php
  }
}?>
