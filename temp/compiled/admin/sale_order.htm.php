<?php if ($this->_var['full_page']): ?>
<!-- $Id: sale_order.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
  <form name="TimeInterval"  action="javascript:getList()" style="margin:0px">
    <?php echo $this->_var['lang']['start_date']; ?>&nbsp;<?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'start_date','time'=>$this->_var['start_date'],'start_year'=>'-10','end_year'=>'+1','display_days'=>'true','month_format'=>'%m')); ?>&nbsp;&nbsp;
    <?php echo $this->_var['lang']['end_date']; ?>&nbsp;<?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'end_date','time'=>$this->_var['end_date'],'start_year'=>'-10','end_year'=>'+1','display_days'=>'true','month_format'=>'%m')); ?>
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>
<form method="POST" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>
  <table width="100%" cellspacing="1" cellpadding="3">
     <tr>
      <th><?php echo $this->_var['lang']['order_by']; ?></th>
      <th><?php echo $this->_var['lang']['goods_name']; ?></th>
      <th><?php echo $this->_var['lang']['goods_sn']; ?></th>
      <th><a href="javascript:listTable.sort('goods_num', 'DESC'); "><?php echo $this->_var['lang']['sell_amount']; ?></a><?php echo $this->_var['sort_goods_num']; ?></th>
      <th><a href="javascript:listTable.sort('turnover', 'DESC'); "><?php echo $this->_var['lang']['sell_sum']; ?></a><?php echo $this->_var['sort_turnover']; ?></th>
      <th><?php echo $this->_var['lang']['percent_count']; ?></th>
    </tr>
  <?php $_from = $this->_var['goods_order_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['val']['iteration']++;
?>
    <tr align="center">
      <td><?php echo $this->_foreach['val']['iteration']; ?></td>
      <td align="left"><a href="../goods.php?id=<?php echo $this->_var['list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['list']['goods_name']; ?></a></td>
      <td><?php echo $this->_var['list']['goods_sn']; ?></td>
      <td align="right"><?php echo $this->_var['list']['goods_num']; ?></td>
      <td align="right"><?php echo $this->_var['list']['turnover']; ?></td>
      <td align="right"><?php echo $this->_var['list']['wvera_price']; ?></td>
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
    listTable.filter['start_date'] = frm.elements['start_dateYear'].value + '-' + frm.elements['start_dateMonth'].value + '-' + frm.elements['start_dateDay'].value;
    listTable.filter['end_date'] = frm.elements['end_dateYear'].value + '-' + frm.elements['end_dateMonth'].value + '-' + frm.elements['end_dateDay'].value;
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
        listTable.filter['start_date'] = frm.elements['start_dateYear'].value + '-' + frm.elements['start_dateMonth'].value + '-' + frm.elements['start_dateDay'].value;
        listTable.filter['end_date'] = frm.elements['end_dateYear'].value + '-' + frm.elements['end_dateMonth'].value + '-' + frm.elements['end_dateDay'].value;
      }
      aTags[i].href = "sale_order.php?act=download&start_date=" + listTable.filter['start_date'] + "&end_date=" + listTable.filter['end_date'];
    }
  }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>