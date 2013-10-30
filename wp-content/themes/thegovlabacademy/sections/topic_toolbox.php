<?php $tools_values = simple_fields_fieldgroup('topic_page_tools');
if($tools_values){?>
  <h2 class="section-heading">Toolbox</h2><?php
  foreach ($tools_values as $key => $values) {?>
    <a href="<?php echo $values['topic_page_tool_url']; ?>" target="_blank">
      <article class="content-entry tool twelvecol">
        <div class="icon-tool"></div>
        <h3 class="post-title"><?php echo $values['topic_page_tool_title']; ?></h3>

        <p><?php echo $values['topic_page_tool_description']; ?></p>
      </article>
    </a>
  <?php }
}?>