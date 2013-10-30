<?php $documents_values = simple_fields_fieldgroup('topic_page_activities');

if($documents_values){?>
  <h2 class="section-heading">Activites</h2><?php
  foreach ($documents_values as $key => $values) {?>
    <a href="<?php echo $values['topic_page_activity_url']; ?>" target="_blank">
      <article class="content-entry activity twelvecol">
        <div class="icon-activity"></div>
        <h3 class="post-title"><?php echo $values['topic_page_activity_title']; ?></h3>
        <p><?php echo $values['topic_page_activity_description']; ?></p>
      </article>
    </a>
  <?php }
}?>
