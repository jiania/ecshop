<!-- $Id: card_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start goods list -->
<form method="post" action="" name="listForm">
<input type="hidden" name="goods_id" value="<?php echo $this->_var['goods_id']; ?>" />
<div class="list-div" id="listDiv">
<?php endif; ?>
  <table cellpadding="3" cellspacing="1">
  <tr>
    <th>&nbsp</th>
    <th><a href="javascript:listTable.sort('card_name');"><?php echo $this->_var['lang']['card_name']; ?></a><?php echo $this->_var['sort_card_name']; ?></th>
    <th><a href="javascript:listTable.sort('card_fee');"><?php echo $this->_var['lang']['card_fee']; ?></a><?php echo $this->_var['sort_card_fee']; ?></th>
    <th><a href="javascript:listTable.sort('free_money');"><?php echo $this->_var['lang']['free_money']; ?></a><?php echo $this->_var['sort_free_money']; ?></th>
    <th><?php echo $this->_var['lang']['card_desc']; ?></th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['card_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
  <tr>
    <td align="center">
    <?php if ($this->_var['card']['card_img']): ?>
        <a href = "../data/cardimg/<?php echo $this->_var['card']['card_img']; ?>" target="_brank"><img src="images/picflag.gif" width="16" height="16" border="0" alt="" /></a>
    <?php else: ?>
        <img src="images/picnoflag.gif" width="16" height="16" border="0" alt="" />
    <?php endif; ?>
    </td>
    <td align="left"><span onclick="listTable.edit(this, 'edit_card_name', <?php echo $this->_var['card']['card_id']; ?>)"><?php echo htmlspecialchars($this->_var['card']['card_name']); ?></a></td>
    <td align="right"><span onclick="listTable.edit(this, 'edit_card_fee', <?php echo $this->_var['card']['card_id']; ?>)"><?php echo $this->_var['card']['card_fee']; ?></a></td>
    <td align="right"><span onclick="listTable.edit(this, 'edit_free_money', <?php echo $this->_var['card']['card_id']; ?>)"><?php echo $this->_var['card']['free_money']; ?></a></td>
    <td align="left"><?php if ($this->_var['card']['card_desc']): ?><?php echo htmlspecialchars(sub_str($this->_var['card']['card_desc'],50)); ?><?php else: ?>N/A<?php endif; ?></td>
    <td align="center" nowrap="true" valign="top">
        <a href="?act=edit&amp;id=<?php echo $this->_var['card']['card_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['card']['card_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
      </td>
  </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
<?php if ($this->_var['full_page']): ?>
</div>
</form>
<!-- end goods list -->
<script type="text/javascript" language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>