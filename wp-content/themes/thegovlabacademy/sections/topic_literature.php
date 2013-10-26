<?php $documents_values = simple_fields_fieldgroup('topic_page_read_section');
if ($documents_values) {?>
  <h2>Read</h2><?php
  foreach ($documents_values as $key => $values) {
    ?>
    <a href="<?php echo simple_fields_get_post_value($values['id'], "Link to document", true); ?>"
       target="_blank">
      <article class="content-entry doc twelvecol">
        <div class="icon-doc"></div>
        <h3 class="post-title"><?php echo $values['title']; ?></h3>
        <p><?php echo simple_fields_get_post_value($values['id'], "Description", true); ?></p>
      </article>
    </a>
  <?php
  }
}?>
