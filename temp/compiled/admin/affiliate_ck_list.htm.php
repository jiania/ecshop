<!-- <?php if ($this->_var['full_page']): ?> -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
<?php if ($_GET['auid']): ?>
<?php echo $this->_var['lang']['show_affiliate_orders']; ?>
<?php else: ?>
<form action="affiliate_ck.php?act=list">
  <?php echo $this->_var['lang']['sch_stats']['info']; ?>
  <a href="affiliate_ck.php?act=list"><?php echo $this->_var['lang']['sch_stats']['all']; ?></a>
  <a href="affiliate_ck.php?act=list&status=0"><?php echo $this->_var['lang']['sch_stats']['0']; ?></a>
  <a href="affiliate_ck.php?act=list&status=1"><?php echo $this->_var['lang']['sch_stats']['1']; ?></a>
  <a href="affiliate_ck.php?act=list&status=2"><?php echo $this->_var['lang']['sch_stats']['2']; ?></a>
<?php echo $this->_var['lang']['sch_order']; ?>

<input type="hidden" name="act" value="list" />
<input name="order_sn" type="text" id="order_sn" size="15"><input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
</form>
<?php endif; ?>
</div>
<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<!-- <?php endif; ?> -->
<table cellspacing='1' cellpadding='3'>
<tr>
  <th width="20%"><?php echo $this->_var['lang']['order_id']; ?></th>
  <th width="8%"><?php echo $this->_var['lang']['order_stats']['name']; ?></th>
  <th width="8%"><?php echo $this->_var['lang']['sch_stats']['name']; ?></th>
  <th><?php echo $this->_var['lang']['log_info']; ?></th>
  <th width="8%"><?php echo $this->_var['lang']['separate_type']; ?></th>
  <th width="10%"><?php echo $this->_var['lang']['handler']; ?></th>
</tr>
<!-- <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?> -->
<tr>
  <td align="center"><a href="order.php?act=info&order_id=<?php echo $this->_var['val']['order_id']; ?>"><?php echo $this->_var['val']['order_sn']; ?></a></td>
  <td><?php echo $this->_var['lang']['order_stats']['\$val']['order_status']; ?></td>
  <td><?php echo $this->_var['lang']['sch_stats']['\$val']['is_separate']; ?></td>
  <td><?php echo $this->_var['val']['info']; ?></td>
  <td><?php echo $this->_var['lang']['separate_by'][$this->_var['val']['separate_type']]; ?></td>
  <td>
  <!-- <?php if ($this->_var['val']['is_separate'] == 0 && $this->_var['val']['separate_able'] == 1 && $this->_var['on'] == 1): ?> -->
  <a href="javascript:confirm_redirect(separate_confirm, 'affiliate_ck.php?act=separate&oid=<?php echo $this->_var['val']['order_id']; ?>')"><?php echo $this->_var['lang']['affiliate_separate']; ?></a> | <a href="javascript:confirm_redirect(cancel_confirm, 'affiliate_ck.php?act=del&oid=<?php echo $this->_var['val']['order_id']; ?>')"><?php echo $this->_var['lang']['affiliate_cancel']; ?></a>
  <!-- <?php elseif ($this->_var['val']['is_separate'] == 1): ?> -->
<a href="javascript:confirm_redirect(rollback_confirm, 'affiliate_ck.php?act=rollback&logid=<?php echo $this->_var['val']['log_id']; ?>')"><?php echo $this->_var['lang']['affiliate_rollback']; ?></a>
  <!-- <?php else: ?> -->
  -
  <!-- <?php endif; ?> -->
  </td>
</tr>
    <!-- <?php endforeach; else: ?> -->
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
<!-- <?php endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
</table>
  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
<!-- <?php if ($this->_var['full_page']): ?> -->
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

<!--  -->
onload = function()
{
  // 开始检查订单
  startCheckOrder();
}
<!--  -->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<!-- <?php endif; ?> -->