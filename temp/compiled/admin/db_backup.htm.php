<!-- $Id: db_backup.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php if ($this->_var['warning']): ?>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['warning']; ?></li>
</ul>
<?php endif; ?>
<form  name="theForm" method="post"  action="database.php" onsubmit="return validate()">
<!-- start  list -->
<div class="list-div" id="listDiv">

<table cellspacing='1' cellpadding='3' >
  <tr>
    <th colspan="2"><?php echo $this->_var['lang']['backup_type']; ?></th>
  </tr>
  <tr>
    <td><input type="radio" name="type" value="full" class="radio" onclick="findobj('showtables').style.display='none'"><?php echo $this->_var['lang']['full_backup']; ?></td>
    <td><?php echo $this->_var['lang']['full_backup_note']; ?></td>
  </tr>
  <tr>
    <td><input type="radio" name="type" value="stand" class="radio" checked="checked" onclick="findobj('showtables').style.display='none'"><?php echo $this->_var['lang']['stand_backup']; ?></td>
    <td><?php echo $this->_var['lang']['stand_backup_note']; ?></td>
  </tr>
  <tr>
    <td><input type="radio" name="type" value="min" class="radio" onclick="findobj('showtables').style.display='none'"><?php echo $this->_var['lang']['min_backup']; ?></td>
    <td><?php echo $this->_var['lang']['min_backup_note']; ?></td>
  </tr>
  <tr>
    <td><input type="radio" name="type" value="custom" class="radio" onclick="findobj('showtables').style.display=''"><?php echo $this->_var['lang']['custom_backup']; ?></td>
    <td><?php echo $this->_var['lang']['custom_backup_note']; ?></td>
  </tr>
  <tbody id="showtables" style="display:none">
  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td colspan="4"><input name="chkall" onclick="checkall(this.form, 'customtables[]')" type="checkbox"><b><?php echo $this->_var['lang']['check_all']; ?></b></td>
        </tr>
        <tr>
        <?php $_from = $this->_var['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'table');$this->_foreach['table_name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table_name']['total'] > 0):
    foreach ($_from AS $this->_var['table']):
        $this->_foreach['table_name']['iteration']++;
?>
          <?php if ($this->_foreach['table_name']['iteration'] > 1 && ( $this->_foreach['table_name']['iteration'] - 1 ) % 4 == 0): ?>
          </tr><tr>
          <?php endif; ?>
          <td><input name="customtables[]" value="<?php echo $this->_var['table']; ?>"  type="checkbox"><?php echo $this->_var['table']; ?></td>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </tr>
      </table>
    </td>
  </tr>
  </tbody>
</table>

<table cellspacing='1' cellpadding='3' >
  <tr>
    <th colspan="2"><?php echo $this->_var['lang']['option']; ?></th>
  </tr>
  <tr>
    <td><?php echo $this->_var['lang']['ext_insert']; ?></td>
    <td><input type="radio" name="ext_insert" class="radio" value='1'><?php echo $this->_var['lang']['yes']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ext_insert" class="radio" value='0' checked="checked"><?php echo $this->_var['lang']['no']; ?></td>
  </tr>
  <tr>
    <td><?php echo $this->_var['lang']['vol_size']; ?></td>
    <td><input type="text" name="vol_size" value="<?php echo $this->_var['vol_size']; ?>"></td>
  </tr>
  <tr>
    <td><?php echo $this->_var['lang']['sql_name']; ?></td>
    <td><input type="text" name="sql_file_name" value="<?php echo $this->_var['sql_name']; ?>"></td>
  </tr>
</table>
<input type="hidden" name="act" value="dumpsql">

<input type="hidden" name="act" value="dumpsql">
<input type="hidden" name="token" value="<?php echo $this->_var['token']; ?>">

<center><input type="submit" value="<?php echo $this->_var['lang']['start_backup']; ?>" class="button" /></center>
</div>
<!-- end  list -->
</form>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("sql_file_name", sql_name_not_null);
  validator.required("vol_size", vol_size_not_null);
  return validator.passed();
}

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

function findobj(str)
{
    return document.getElementById(str);
}

function checkall(frm, chk)
{
    for (i = 0; i < frm.elements.length; i++)
    {
        if (frm.elements[i].name == chk)
        {
            frm.elements[i].checked = frm.elements['chkall'].checked;
        }
    }
}

function radioClicked(n)
{
    if (n > 0)
    {
        document.forms['theForm'].elements["vol_size"].disabled = false;
        var str = document.forms['theForm'].elements["sql_name"].value ;
        document.forms['theForm'].elements["sql_name"].value = str.slice(0, -4) + '.zip' ;
    }
    else
    {
        document.forms['theForm'].elements["vol_size"].disabled = true;
        var str = document.forms['theForm'].elements["sql_name"].value ;
        document.forms['theForm'].elements["sql_name"].value = str.slice(0, -4) + '.sql' ;
    }
}

/**
 * 切换显示表前缀
 * @param bool display 是否显示
 */
function toggleTablePre(display)
{
    var disp = display ? '' : 'none';
    for (var i = 1; i <= 9; i++)
    {
        document.getElementById('pre_' + i).style.display = disp;
    }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>