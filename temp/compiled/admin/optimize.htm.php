<!-- $Id: optimize.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start form -->
<div class="form-div">
<form method="post" action="database.php" name="theForm">
<?php echo $this->_var['lang']['chip_count']; ?>:<?php echo $this->_var['num']; ?>
<input type="submit" value="<?php echo $this->_var['lang']['start_optimize']; ?>" class="button" />
<input type= "hidden" name= "num" value = "<?php echo $this->_var['num']; ?>">
<input type= "hidden" name="act" value = "run_optimize">
</form>
</div>
<!-- end form -->
<!-- start list -->
<div class="list-div" id="listDiv">
<table cellspacing='1' cellpadding='3' id='listTable'>
  <tr>
    <th><?php echo $this->_var['lang']['table']; ?></th>
    <th><?php echo $this->_var['lang']['type']; ?></th>
    <th><?php echo $this->_var['lang']['rec_num']; ?></th>
    <th><?php echo $this->_var['lang']['rec_size']; ?></th>
    <th><?php echo $this->_var['lang']['rec_chip']; ?></th>
    <th><?php echo $this->_var['lang']['charset']; ?></th>
    <th><?php echo $this->_var['lang']['status']; ?></th>
  </tr>
  <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <tr>
      <td class="first-cell"><?php echo $this->_var['item']['table']; ?></td>
      <td align ="left"><?php echo $this->_var['item']['type']; ?></td>
      <td align ="right"><?php echo $this->_var['item']['rec_num']; ?></td>
      <td align ="right"><?php echo $this->_var['item']['rec_size']; ?></td>
      <td align ="right"><?php echo $this->_var['item']['rec_chip']; ?></td>
      <td align ="left"><?php echo $this->_var['item']['charset']; ?></td>
      <td align ="left"><?php echo $this->_var['item']['status']; ?></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>
<!-- end  list -->

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