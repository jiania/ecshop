<!-- $Id: message_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">
  <form method="post" action="javascript:searchMessage()" name="theForm">
  <?php echo $this->_var['lang']['select_msg_type']; ?>:
  <select name="msg_type" onchange="javascript:searchMessage()">
    <?php echo $this->html_options(array('options'=>$this->_var['lang']['message_type'],'selected'=>$this->_var['msg_type'])); ?>
  </select>
  <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
  </form>
</div>

<!-- start admin_message list -->
<form method="POST" action="message.php?act=drop_msg" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
        <a href="javascript:listTable.sort('message_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_message_id']; ?>
      </th>
      <th><a href="javascript:listTable.sort('title'); "><?php echo $this->_var['lang']['title']; ?></a><?php echo $this->_var['sort_title']; ?></th>
      <th><a href="javascript:listTable.sort('sender_id'); "><?php echo $this->_var['lang']['sender_id']; ?></a><?php echo $this->_var['sort_sender_id']; ?></th>
      <th><a href="javascript:listTable.sort('sent_time'); "><?php echo $this->_var['lang']['send_date']; ?></a><?php echo $this->_var['sort_send_date']; ?></th>
      <th><a href="javascript:listTable.sort('read_time'); "><?php echo $this->_var['lang']['read_date']; ?></a><?php echo $this->_var['sort_read_date']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['message_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
    <tr>
      <td><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['msg']['message_id']; ?>" /><?php echo $this->_var['msg']['message_id']; ?></td>
      <td class="first-cell"><?php echo sub_str(htmlspecialchars($this->_var['msg']['title']),35); ?></td>
      <td><?php echo htmlspecialchars($this->_var['msg']['user_name']); ?></td>
      <td align="right"><?php echo $this->_var['msg']['sent_time']; ?></td>
      <td align="right"><?php echo empty($this->_var['msg']['read_time']) ? 'N/A' : $this->_var['msg']['read_time']; ?></td>
      <td align="center">
        <a href="message.php?act=view&id=<?php echo $this->_var['msg']['message_id']; ?>" title="<?php echo $this->_var['lang']['view_msg']; ?>"><?php echo $this->_var['lang']['view']; ?></a>
         <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['msg']['message_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')"><?php echo $this->_var['lang']['remove']; ?></a>
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" /></td>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>
<script type="text/javascript" language="JavaScript">
<!--
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
  }

  /**
   * 查询留言
   */
  function searchMessage()
  {
    listTable.filter.msg_type = document.forms['theForm'].elements['msg_type'].value;
    listTable.filter.page = 1;
    listTable.loadList();
  }
  
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>