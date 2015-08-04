<!-- $Id: sitemap.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="main-div">
<p style="padding: 0 10px"><?php echo $this->_var['lang']['license_notice']; ?></p>
</div>
<?php if ($this->_var['is_download'] == 1): ?>
<div class="main-div">
<table width="100%">
<form method="POST" action="license.php?act=download" name="theForm">
<tr>
    <td class="label"><?php echo $this->_var['lang']['label_certificate_download']; ?></td>
    <td></td>
</tr>
<tr>
    <td class="label"><?php echo $this->_var['lang']['label_license_key']; ?></td>
    <td><?php echo $this->_var['certificate_id']; ?></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" value="<?php echo $this->_var['lang']['download_license']; ?>" class="button" /></td>
</tr>
</form>
</table>
</div>
<?php endif; ?>
<div class="main-div">
<table width="100%">
<form method="POST" action="license.php" enctype="multipart/form-data" name="theForm">
<tr>
    <td class="label"><?php echo $this->_var['lang']['label_certificate_reset']; ?></td>
    <td></td>
</tr>
<tr>
    <td class="label"><?php echo $this->_var['lang']['label_select_license']; ?></td>
    <td><input type="file" name="license" size="50"></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" value="<?php echo $this->_var['lang']['upload_license']; ?>" class="button" /><input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" /></td>
</tr>
<input type="hidden" name="act" value="upload">
</form>
</table>
</div>

<div class="main-div">
<table width="100%">
<form method="POST" action="license.php?act=del" name="theForm" onsubmit="return del_check();">
<tr>
    <td class="label"><?php echo $this->_var['lang']['label_delete_license']; ?></td>
    <td></td>
</tr>
<tr>
    <td colspan="2"><?php echo $this->_var['lang']['delete_license_notice']; ?></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" /></td>
</tr>
</form>
</table>
</div>

<script type="text/javascript" language="JavaScript">
<!--
onload = function()
{

}

function del_check()
{
  if (confirm(del_confirm))
  {
    return true;
  }
  else
  {
    return false;
  }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>