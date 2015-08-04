<!-- $Id: adsense.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start ads_stats list -->
<div class="list-div" id="listDiv">
<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <th><?php echo $this->_var['lang']['adsense_name']; ?></th>
    <th><?php echo $this->_var['lang']['cleck_referer']; ?></th>
    <th><?php echo $this->_var['lang']['click_count']; ?></th>
    <th><?php echo $this->_var['lang']['confirm_order']; ?></th>
    <th><?php echo $this->_var['lang']['gen_order_amount']; ?></th>
  </tr>
  <?php $_from = $this->_var['ads_stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
  <tr>
    <td><?php echo $this->_var['list']['ad_name']; ?></td>
    <td><?php echo $this->_var['list']['referer']; ?></td>
    <td align="right"><?php echo $this->_var['list']['clicks']; ?></td>
    <td align="right"><?php echo $this->_var['list']['order_confirm']; ?></td>
    <td align="right"><?php echo $this->_var['list']['order_num']; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php $_from = $this->_var['goods_stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'info');if (count($_from)):
    foreach ($_from AS $this->_var['info']):
?>
  <tr>
    <td><?php echo $this->_var['info']['ad_name']; ?></td>
    <td><?php echo $this->_var['info']['referer']; ?></td>
    <td align="right"><?php echo $this->_var['info']['clicks']; ?></td>
    <td align="right"><?php echo $this->_var['info']['order_confirm']; ?></td>
    <td align="right"><?php echo $this->_var['info']['order_num']; ?></td>
  </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>
<!-- end ads_stats list -->
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script type="text/javascript" language="JavaScript">
<!--
onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>