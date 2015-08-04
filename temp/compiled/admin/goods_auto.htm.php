<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<script>
var thisfile = '<?php echo $this->_var['thisfile']; ?>';
var deleteck = '<?php echo $this->_var['lang']['deleteck']; ?>';
var deleteid = '<?php echo $this->_var['lang']['delete']; ?>';
</script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="form-div">
<?php if (! $this->_var['crons_enable']): ?>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['lang']['enable_notice']; ?></li>
</ul>
<?php endif; ?>
<form action="<?php echo $this->_var['thisfile']; ?>" method="post">
  <?php echo $this->_var['lang']['goods_name']; ?>
  <input type="hidden" name="act" value="list" />
  <input name="goods_name" type="text" size="25" /> <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
</form>
</div>
<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
  <?php endif; ?>

<table cellspacing='1' cellpadding='3'>
<tr>
  <th width="5%"><input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox"><?php echo $this->_var['lang']['id']; ?></th>
  <th><?php echo $this->_var['lang']['goods_name']; ?></th>
  <th width="25%"><?php echo $this->_var['lang']['starttime']; ?></th>
  <th width="25%"><?php echo $this->_var['lang']['endtime']; ?></th>
  <th width="10%"><?php echo $this->_var['lang']['handler']; ?></th>
</tr>
<?php $_from = $this->_var['goodsdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
<tr>
  <td><input name="checkboxes[]" type="checkbox" value="<?php echo $this->_var['val']['goods_id']; ?>" /><?php echo $this->_var['val']['goods_id']; ?></td>
  <td><?php echo $this->_var['val']['goods_name']; ?></td>
  <td align="center">
  <span onclick="listTable.edit(this, 'edit_starttime', '<?php echo $this->_var['val']['goods_id']; ?>');showCalendar(this.firstChild, '%Y-%m-%d', false, false, this.firstChild)"><!-- <?php if ($this->_var['val']['starttime']): ?> --><?php echo $this->_var['val']['starttime']; ?><!-- <?php else: ?> -->0000-00-00<!-- <?php endif; ?> --></span>
</td>
  <td align="center">
  <span onclick="listTable.edit(this, 'edit_endtime', '<?php echo $this->_var['val']['goods_id']; ?>');showCalendar(this.firstChild, '%Y-%m-%d', false, false, this.firstChild)"><!-- <?php if ($this->_var['val']['endtime']): ?> --><?php echo $this->_var['val']['endtime']; ?><!-- <?php else: ?> -->0000-00-00<!-- <?php endif; ?> --></span>
  </td>
  <td align="center"><span id="del<?php echo $this->_var['val']['goods_id']; ?>">
  <?php if ($this->_var['val']['endtime'] || $this->_var['val']['starttime']): ?>
    <a href="<?php echo $this->_var['thisfile']; ?>?goods_id=<?php echo $this->_var['val']['goods_id']; ?>&act=del" onclick="return confirm('<?php echo $this->_var['lang']['deleteck']; ?>');"><?php echo $this->_var['lang']['delete']; ?></a>
  <?php else: ?>
    -
  <?php endif; ?></span>
  </td>
</tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<?php if ($this->_var['full_page']): ?>
<?php endif; ?>
<table id="page-table" cellspacing="0">
  <tr>
    <td>
      <input type="hidden" name="act" value="" />
      <input name="date" type="text" id="date" size="10" value='0000-00-00' readonly="readonly" /><input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('date', '%Y-%m-%d', false, false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
      <input type="button" id="btnSubmit1" value="<?php echo $this->_var['lang']['button_start']; ?>" disabled="true" class="button" onClick="return validate('batch_start')" />
      <input type="button" id="btnSubmit2" value="<?php echo $this->_var['lang']['button_end']; ?>" disabled="true" class="button" onClick="return validate('batch_end')" />
    </td>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>
<?php if ($this->_var['full_page']): ?>
</form>
</div>
<script type="Text/Javascript" language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<!--

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}


function validate(name)
{
  if(document.listForm.elements["date"].value == "0000-00-00")
  {
    alert('<?php echo $this->_var['lang']['select_time']; ?>');
    return;	
  }
  else
  {
    document.listForm.act.value=name;
    document.listForm.submit();
  }
}
//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
