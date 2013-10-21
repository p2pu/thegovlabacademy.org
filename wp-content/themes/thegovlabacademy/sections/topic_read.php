<?php $documents_values = simple_fields_fieldgroup('topic_literature');
foreach ($documents_values as $key =>$values){
  ?>
  <div class="document">
    <i class="document"></i>
    <h3>
      <a href="<?php echo wp_get_attachment_url( $values['topic_page_document_upload']); ?>"
         target="_blank">
        <?php echo $values['topic_page_document_title']; ?>
      </a>
    </h3>
    <p><?php echo $values['topic_page_document_description']; ?></p>
  </div>
<?php } ?>