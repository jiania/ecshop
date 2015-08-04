<!-- $Id: snatch_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
  <form action="javascript:searchSnatch()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['snatch_name']; ?> <input type="text" name="keyword" /> <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th><a href="javascript:listTable.sort('act_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_act_id']; ?></th>
      <th><a href="javascript:listTable.sort('snatch_name'); "><?php echo $this->_var['lang']['snatch_name']; ?></a><?php echo $this->_var['sort_snatch_name']; ?></th>
      <th><a href="javascript:listTable.sort('goods_name'); "><?php echo $this->_var['lang']['goods_name']; ?></a><?php echo $this->_var['sort_goods_name']; ?></th>
      <th><a href="javascript:listTable.sort('start_time'); "><?php echo $this->_var['lang']['start_time']; ?></a><?php echo $this->_var['sort_start_time']; ?></th>
      <th><a href="javascript:listTable.sort('end_time'); "><?php echo $this->_var['lang']['end_time']; ?></a><?php echo $this->_var['sort_end_time']; ?></th>
      <th><?php echo $this->_var['lang']['min_price']; ?></a></th>
      <th><?php echo $this->_var['lang']['integral']; ?></a></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['snatch_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'snatch');if (count($_from)):
    foreach ($_from AS $this->_var['snatch']):
?>
    <tr>
      <td align="center"><?php echo $this->_var['snatch']['act_id']; ?></td>
      <td class="first-cell"><span onclick="listTable.edit(this, 'edit_snatch_name', <?php echo $this->_var['snatch']['act_id']; ?>)"><?php echo $this->_var['snatch']['snatch_name']; ?></span></td>
      <td><span><?php echo $this->_var['snatch']['goods_name']; ?></span></td>
      <td align="center"><?php echo $this->_var['snatch']['start_time']; ?></td>
      <td align="center"><?php echo $this->_var['snatch']['end_time']; ?></td>
      <td align="right"><?php echo $this->_var['snatch']['start_price']; ?></td>
      <td align="right"><?php echo $this->_var['snatch']['cost_points']; ?></td>
      <td align="center">
        <a href="snatch.php?act=view&amp;snatch_id=<?php echo $this->_var['snatch']['act_id']; ?>" title="<?php echo $this->_var['lang']['view_detail']; ?>"><img src="images/icon_view.gif" border="0" height="16" width="16"></a>
        <a href="snatch.php?act=edit&amp;id=<?php echo $this->_var['snatch']['act_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['snatch']['act_id']; ?>,'<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
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
   * 搜索文章
   */
  function searchSnatch()
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