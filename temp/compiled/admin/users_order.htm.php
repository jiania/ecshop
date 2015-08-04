<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
  <form name="TimeInterval"  action="javascript:getList()" style="margin:0px">
  <?php echo $this->_var['lang']['start_date']; ?>&nbsp;
    <input name="start_date" type="text" id="start_date" size="15" value='<?php echo $this->_var['start_date']; ?>' readonly="readonly" /><input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_date', '%Y-%m-%d', false, false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>&nbsp;&nbsp;
    <?php echo $this->_var['lang']['end_date']; ?>&nbsp;
    <input name="end_date" type="text" id="end_date" size="15" value='<?php echo $this->_var['end_date']; ?>' readonly="readonly" /><input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('end_date', '%Y-%m-%d', false, false, 'selbtn2');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>&nbsp;&nbsp;
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>
<form method="POST" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>
  <table width="100%" cellspacing="1" cellpadding="3">
     <tr>
      <th><?php echo $this->_var['lang']['order_by']; ?></th>
      <th><?php echo $this->_var['lang']['member_name']; ?></th>
      <th><a href="javascript:listTable.sort('order_num', 'DESC'); "><?php echo $this->_var['lang']['order_amount']; ?></a><?php echo $this->_var['sort_order_num']; ?></th>
      <th><a href="javascript:listTable.sort('turnover', 'DESC'); "><?php echo $this->_var['lang']['buy_sum']; ?></a><?php echo $this->_var['sort_turnover']; ?></th>
    </tr>
  <?php $_from = $this->_var['user_orderinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['val']['iteration']++;
?>
    <tr align="center">
      <td align="center"><?php echo $this->_foreach['val']['iteration']; ?></td>
      <td align="left"><?php echo $this->_var['list']['user_name']; ?></td>
      <td><?php echo $this->_var['list']['order_num']; ?></td>
      <td><?php echo $this->_var['list']['turnover']; ?></td>
    </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
  <table id="page-table" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
  </table>
<?php if ($this->_var['full_page']): ?>
</div>
</form>

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
  getDownUrl();
}

function getList()
{
    var frm =  document.forms['TimeInterval'];
    listTable.filter['start_date'] = frm.elements['start_date'].value;
    listTable.filter['end_date'] = frm.elements['end_date'].value;
    listTable.filter['page'] = 1;
    listTable.loadList();
    getDownUrl();
}

function getDownUrl()
{
  var aTags = document.getElementsByTagName('A');
  for (var i = 0; i < aTags.length; i++)
  { 
    if (aTags[i].href.indexOf('download') >= 0)
    {
      if (listTable.filter['start_date'] == "")
      {
        var frm =  document.forms['TimeInterval'];
        listTable.filter['start_date'] = frm.elements['start_date'].value;
        listTable.filter['end_date'] = frm.elements['end_date'].value;
      }
      aTags[i].href = "users_order.php?act=download&start_date=" + listTable.filter['start_date'] + "&end_date=" + listTable.filter['end_date'];
    }
  }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>