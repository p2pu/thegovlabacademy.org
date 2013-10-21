<h1>Read</h1>
<?php $documents_values = simple_fields_fieldgroup('topic_literature');
foreach ($documents_values as $key => $values) {
  ?>
  <div class="document">
    <div class="twocol first">
      <i class="icon-file-text"></i>
    </div>
    <div class="tencol">
      <h3>
        <a href="<?php echo $values['topic_page_source_url']; ?>"
           target="_blank">
          <?php echo $values['topic_page_source_title']; ?>
        </a>
      </h3>
      <p><?php echo $values['topic_page_source_description']; ?></p>
    </div>
  </div>
<?php } ?>