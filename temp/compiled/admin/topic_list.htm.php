<!-- $Id: topic_list.htm 14441 2008-04-18 03:09:11Z zhuwenyuan $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<form method="POST" action="" name="listForm">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th width="13%">
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
        <a href="javascript:listTable.sort('topic_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_topic_id']; ?></th>
      <th width="26%"><a href="javascript:listTable.sort('title'); "><?php echo $this->_var['lang']['topic_title']; ?></a><?php echo $this->_var['sort_title']; ?></th>
      <th width="13%"><a href="javascript:listTable.sort('start_time'); "><?php echo $this->_var['lang']['start_time']; ?></a><?php echo $this->_var['sort_start_time']; ?></th>
      <th width="13%"><a href="javascript:listTable.sort('end_time'); "><?php echo $this->_var['lang']['end_time']; ?></a><?php echo $this->_var['sort_end_time']; ?></th>
      <th width=""><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['topic_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'topic');if (count($_from)):
    foreach ($_from AS $this->_var['topic']):
?>
    <tr>
      <td><span><input value="<?php echo $this->_var['topic']['topic_id']; ?>" name="checkboxs[]" type="checkbox"><?php echo $this->_var['topic']['topic_id']; ?></span></td>
      
      <td><?php echo $this->_var['topic']['title']; ?></td>
      
      <td><?php echo $this->_var['topic']['start_time']; ?></td>
      <td><?php echo $this->_var['topic']['end_time']; ?></td>
      <td align="center"><a href="../topic.php?topic_id=<?php echo $this->_var['topic']['topic_id']; ?>" title="<?php echo $this->_var['lang']['view']; ?>" target="_blank"><?php echo $this->_var['lang']['view']; ?></a>    <a href="topic.php?act=edit&topic_id=<?php echo $this->_var['topic']['topic_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><?php echo $this->_var['lang']['edit']; ?></a>
      <a href="javascript:;" on title="<?php echo $this->_var['lang']['drop']; ?>" onclick="listTable.remove(<?php echo $this->_var['topic']['topic_id']; ?>,delete_topic_confirm,'delete');"><?php echo $this->_var['lang']['drop']; ?></a>
      <a href="ads.php?act=add&ad_name=<?php echo $this->_var['topic']['title']; ?>&ad_link=<?php echo $this->_var['topic']['url']; ?>" ><?php echo $this->_var['lang']['publish_to_ads']; ?></a>
      <a href="flashplay.php?act=add&ad_link=<?php echo $this->_var['topic']['url']; ?>" title="<?php echo $this->_var['lang']['publish_to_player']; ?>" ><?php echo $this->_var['lang']['publish_to_player']; ?></a>
    </td>
   
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" />
      </td>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end user_bonus list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['listForm'].reset();
  }
  
  document.getElementById("btnSubmit").onclick = function()
  {
    if (confirm(delete_topic_confirm))
    {
      document.forms["listForm"].action = "topic.php?act=delete";
      return;
    }
    else
    {
      return false;
    }
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>