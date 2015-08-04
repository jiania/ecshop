<!-- $Id: ads_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<form method="post" action="" name="listForm">
<!-- start ads list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th><a href="javascript:listTable.sort('ad_name'); "><?php echo $this->_var['lang']['ad_name']; ?></a><?php echo $this->_var['sort_ad_name']; ?></th>
    <th><a href="javascript:listTable.sort('position_id'); "><?php echo $this->_var['lang']['position_id']; ?></a><?php echo $this->_var['sort_position_id']; ?></th>
    <th><a href="javascript:listTable.sort('media_type'); "><?php echo $this->_var['lang']['media_type']; ?></a><?php echo $this->_var['sort_media_type']; ?></th>
    <th><a href="javascript:listTable.sort('start_date'); "><?php echo $this->_var['lang']['start_date']; ?></a><?php echo $this->_var['sort_start_date']; ?></th>
    <th><a href="javascript:listTable.sort('end_date'); "><?php echo $this->_var['lang']['end_date']; ?></a><?php echo $this->_var['sort_end_date']; ?></th>
    <th><a href="javascript:listTable.sort('click_count'); "><?php echo $this->_var['lang']['click_count']; ?></a><?php echo $this->_var['sort_click_count']; ?></th>
    <th><?php echo $this->_var['lang']['ads_stats']; ?></th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['ads_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
  <tr>
    <td class="first-cell">
    <span onclick="javascript:listTable.edit(this, 'edit_ad_name', <?php echo $this->_var['list']['ad_id']; ?>)"><?php echo htmlspecialchars($this->_var['list']['ad_name']); ?></span>
    </td>
    <td align="left"><span><?php if ($this->_var['list']['position_id'] == 0): ?><?php echo $this->_var['lang']['outside_posit']; ?><?php else: ?><?php echo $this->_var['list']['position_name']; ?><?php endif; ?></span>
    </td>
    <td align="left"><span><?php echo $this->_var['list']['type']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list']['start_date']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list']['end_date']; ?></span></td>
    <td align="right"><span><?php echo $this->_var['list']['click_count']; ?></span></td>
    <td align="right"><span><?php echo $this->_var['list']['ad_stats']; ?></span></td>
    <td align="right"><span>
      <?php if ($this->_var['list']['position_id'] == 0): ?>
      <a href="ads.php?act=add_js&type=<?php echo $this->_var['list']['media_type']; ?>&id=<?php echo $this->_var['list']['ad_id']; ?>" title="<?php echo $this->_var['lang']['add_js_code']; ?>"><img src="images/icon_js.gif" border="0" height="16" width="16" /></a>
      <?php endif; ?>
      <a href="ads.php?act=edit&id=<?php echo $this->_var['list']['ad_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16" /></a>
      <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['ad_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16" /></a></span>
    </td>
  </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_ads']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td align="right" nowrap="true" colspan="10"><?php echo $this->fetch('page.htm'); ?></td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end ad_position list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
