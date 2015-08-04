<!-- $Id $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
  <form action="javascript:searchPackage()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['package_name']; ?> <input type="text" name="keyword" /> <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th><a href="javascript:listTable.sort('act_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_act_id']; ?></th>
      <th><a href="javascript:listTable.sort('package_name'); "><?php echo $this->_var['lang']['package_name']; ?></a><?php echo $this->_var['sort_package_name']; ?></th>
      <th><a href="javascript:listTable.sort('start_time'); "><?php echo $this->_var['lang']['start_time']; ?></a><?php echo $this->_var['sort_start_time']; ?></th>
      <th><a href="javascript:listTable.sort('end_time'); "><?php echo $this->_var['lang']['end_time']; ?></a><?php echo $this->_var['sort_end_time']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['package_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package');if (count($_from)):
    foreach ($_from AS $this->_var['package']):
?>
    <tr>
      <td align="center"><?php echo $this->_var['package']['act_id']; ?></td>
      <td class="first-cell"><span onclick="listTable.edit(this, 'edit_package_name', <?php echo $this->_var['package']['act_id']; ?>)"><?php echo $this->_var['package']['package_name']; ?></span></td>
      <td align="center"><?php echo $this->_var['package']['start_time']; ?></td>
      <td align="center"><?php echo $this->_var['package']['end_time']; ?></td>
      <td align="center">
        <a href="package.php?act=edit&amp;id=<?php echo $this->_var['package']['act_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['package']['act_id']; ?>,'<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <tr>
      <td align="right" nowrap="true" colspan="10"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>
<!-- end article list -->

<script type="text/javascript" language="JavaScript">
<!--
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
      document.forms['searchForm'].elements['keyword'].focus();
      // 开始检查订单
      startCheckOrder();
  }

  /**
   * 搜索礼包
   */
  function searchPackage()
  {
    var keyword = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
    listTable.filter.keywords = keyword;
    listTable.filter.page = 1;
    listTable.loadList();
  }
  
//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>