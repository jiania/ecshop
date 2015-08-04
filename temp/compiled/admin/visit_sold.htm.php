<!-- $Id: visit_sold.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="form-div">
  <form name="TimeInterval" action="visit_sold.php?act=list" method="post" style="margin:0px">
    <?php echo $this->_var['lang']['goods_cat']; ?>
    <select name="cat_id">
      <option value="0"><?php echo $this->_var['lang']['select_please']; ?></option><?php echo $this->_var['cat_list']; ?>
    </select>
    <?php echo $this->_var['lang']['goods_brand']; ?>
    <select name="brand_id">
      <option value="0"><?php echo $this->_var['lang']['select_please']; ?></caption>
      <?php echo $this->html_options(array('options'=>$this->_var['brand_list'],'selected'=>$this->_var['brand_id'])); ?>
    </select>
    <?php echo $this->_var['lang']['show_num']; ?>
    <input name="show_num" type="text" size="8" value="<?php echo $this->_var['show_num']; ?>" />
    <input type="hidden" name="order_type" value="<?php echo $this->_var['order_type']; ?>" />
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>
<div class="list-div">
  <table width="100%" cellpadding="3" cellspacing="1">
     <tr>
      <th><?php echo $this->_var['lang']['order_by']; ?></th>
      <th><?php echo $this->_var['lang']['goods_name']; ?></th>
      <th><?php echo $this->_var['lang']['fav_exponential']; ?></th>
      <th><?php echo $this->_var['lang']['buy_times']; ?></th>
      <th><?php echo $this->_var['lang']['visit_buy']; ?></th>
    </tr>
  <?php $_from = $this->_var['click_sold_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('Key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['Key'] => $this->_var['list']):
?>
    <tr align="right">
      <td align="center"><?php echo $this->_var['Key+1']; ?></td>
      <td align="left"><a href="../goods.php?id=<?php echo $this->_var['list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['list']['goods_name']; ?></a></td>
      <td><?php echo $this->_var['list']['click_count']; ?></td>
      <td><?php echo $this->_var['list']['sold_times']; ?></td>
      <td><?php echo $this->_var['list']['scale']; ?></td>
    </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
</div>

<script type="Text/Javascript" language="JavaScript">
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
