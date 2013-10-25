<?php $tools_values = simple_fields_fieldgroup('topic_page_tools');
if($tools_values){?>
  <h1>Toolbox</h1><?php
  foreach ($tools_values as $key => $values) {
    ?>
    <div class="document">
      <div class="twocol first">
        <i class="icon-cog"></i>
      </div>
      <div class="tencol">
        <h3>
          <a href="<?php echo $values['topic_page_tool_url']; ?>"
             target="_blank">
            <?php echo $values['topic_page_tool_title']; ?>
          </a>
        </h3>
        <p><?php echo $values['topic_page_tool_description']; ?></p>
      </div>
    </div>
  <?php }
}?>