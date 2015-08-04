<!-- $Id: sql.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="form-div">
  <form name="sqlFrom" method="post" action="sql.php" onsubmit="return validate()">
  <table>
    <tr><th><?php echo $this->_var['lang']['title']; ?></th></tr>
    <tr><td><span style="color: rgb(255, 0, 0);"><strong><?php echo $this->_var['lang']['note']; ?></strong></span></td></tr>
    <tr><td><textarea name="sql" rows="6" cols="80"><?php echo $this->_var['sql']; ?></textarea></td></tr>
    <tr><td><input type="hidden" name="act" value="query"><input value="<?php echo $this->_var['lang']['query']; ?>" type="submit" class="button" /></td></tr>
  </table>
  </form>
</div>

<!-- start users list -->
<div class="list-div" id="listDiv">
  <?php if ($this->_var['type'] == 0): ?>
  <!-- 出错提示-->
  <span style="color: rgb(255, 0, 0);"><strong><?php echo $this->_var['lang']['error']; ?>:</strong></span><br />
  <?php echo $this->_var['error']; ?>
  <?php endif; ?>
  <?php if ($this->_var['type'] == 1): ?>
  <!-- 执行成功-->
  <center><h3><?php echo $this->_var['lang']['succeed']; ?></h3></center>
  <?php endif; ?>
  <?php if ($this->_var['type'] == 2): ?>
  <!--有返回值-->
    <?php echo $this->_var['result']; ?>
  <?php endif; ?>
</div>
<script language="JavaScript">
<!--

document.forms['sqlFrom'].elements['sql'].focus();

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

/**
 * 检查表单输入的数据
 */
function validate()
{
  var frm = document.forms['sqlFrom'];
  var sql = frm.elements['sql'].value;
  var msg ='';

  if (sql.length == 0 )
  {
    msg += sql_not_null + "\n";
  }

  if (msg.length > 0)
  {
    alert (msg);
    return false;
  }

  return true;
}
//-->

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>