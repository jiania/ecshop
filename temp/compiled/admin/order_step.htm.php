<!-- $Id -->

<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,../js/transport.js,validator.js')); ?>
<?php if ($this->_var['step'] == "consignee"): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/region.js')); ?>
<?php endif; ?>

<?php if ($this->_var['step'] == "user"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkUser()">
<div class="main-div" style="padding: 15px">
  <label><input type="radio" name="anonymous" value="1" checked /> <?php echo $this->_var['lang']['anonymous']; ?></label><br />
  <label><input type="radio" name="anonymous" value="0" id="user_useridname" /> <?php echo $this->_var['lang']['by_useridname']; ?></label>
  <input name="keyword" type="text" value="" />
  <input type="button" class="button" name="search" value="<?php echo $this->_var['lang']['button_search']; ?>" onclick="searchUser();" />
  <select name="user"></select>
  <p><?php echo $this->_var['lang']['notice_user']; ?></p>
</div>
<div style="text-align:center">
  <p>
    <input name="submit" type="submit" class="button" value="<?php echo $this->_var['lang']['button_next']; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</div>
</form>

<?php elseif ($this->_var['step'] == "goods"): ?>
<form name="theForm" action="order.php?act=step_post&step=edit_goods&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th scope="col"><?php echo $this->_var['lang']['goods_name']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['goods_sn']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['goods_price']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['goods_number']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['goods_attr']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['subtotal']; ?></th>
    <th scope="col"><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
  <tr>
    <td>
    <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
    <a href="#" onclick="getGoodsInfo(<?php echo $this->_var['goods']['goods_id']; ?>);"><?php echo $this->_var['goods']['goods_name']; ?></a>
    <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
    <?php echo $this->_var['goods']['goods_name']; ?>
    <?php endif; ?>
    </td>
    <td><?php echo $this->_var['goods']['goods_sn']; ?><input name="rec_id[]" type="hidden" value="<?php echo $this->_var['goods']['rec_id']; ?>" /></td>
    <td><input name="goods_price[]" type="text" style="text-align:right" value="<?php echo $this->_var['goods']['goods_price']; ?>" size="10" />
        <input name="goods_id[]" type="hidden" style="text-align:right" value="<?php echo $this->_var['goods']['goods_id']; ?>" size="10" /></td>
    <td><input name="goods_number[]" type="text" style="text-align:right" value="<?php echo $this->_var['goods']['goods_number']; ?>" size="6" /></td>
    <td><textarea name="goods_attr[]" cols="30" rows="<?php echo $this->_var['goods']['rows']; ?>"><?php echo $this->_var['goods']['goods_attr']; ?></textarea></td>
    <td align="right"><?php echo $this->_var['goods']['subtotal']; ?></td>
    <td><a href="javascript:confirm_redirect(confirm_drop, 'order.php?act=process&func=drop_order_goods&rec_id=<?php echo $this->_var['goods']['rec_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>&order_id=<?php echo $this->_var['order_id']; ?>')"><?php echo $this->_var['lang']['drop']; ?></a></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td colspan="4"><span class="require-field"><?php echo $this->_var['lang']['price_note']; ?></span></td>
    <td align="right"><strong><?php echo $this->_var['lang']['label_total']; ?></strong></td>
    <td align="right"><?php echo $this->_var['goods_amount']; ?></td>
    <td><?php if ($this->_foreach['goods']['total'] > 0): ?><input name="edit_goods" type="submit" value="<?php echo $this->_var['lang']['update_goods']; ?>" /><?php endif; ?>
    <input name="goods_count" type="hidden" value="<?php echo $this->_foreach['goods']['total']; ?>" /></td>
  </tr>
</table>
</div>
</form>

<form name="goodsForm" action="order.php?act=step_post&step=add_goods&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return addToOrder()">
<p>
  <?php echo $this->_var['lang']['search_goods']; ?>
  <input type="text" name="keyword" value="" />
  <input type="button" name="search" value="<?php echo $this->_var['lang']['button_search']; ?>" onclick="searchGoods();" />
  <select name="goodslist" onchange="getGoodsInfo(this.value)"></select>
</p>
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="100"><?php echo $this->_var['lang']['goods_name']; ?></th>
    <td id="goods_name">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['goods_sn']; ?></th>
    <td id="goods_sn">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['category']; ?></th>
    <td id="goods_cat">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['brand']; ?></th>
    <td id="goods_brand">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['goods_price']; ?></th>
    <td id="add_price">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['goods_attr']; ?><input type="hidden" name="spec_count" value="0" /></th>
    <td id="goods_attr">&nbsp;</td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['goods_number']; ?></th>
    <td><input name="add_number" type="text" value="1" size="10"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="add_goods" type="submit" value="<?php echo $this->_var['lang']['add_to_order']; ?>" /></td>
  </tr>
</table>
</div>
</form>
<form action="order.php?act=step_post&step=goods&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkGoods()">
  <p align="center">
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>

<?php elseif ($this->_var['step'] == "consignee"): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/transport.js,../js/region.js')); ?>
<script type="text/javascript">
region.isAdmin=true;
</script>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkConsignee()">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <?php if ($this->_var['address_list']): ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['address_list']; ?></th>
    <td><select onchange="loadAddress(this.value)"><option value="0" selected><?php echo $this->_var['lang']['select_please']; ?></option>
      <?php $_from = $this->_var['address_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'address');if (count($_from)):
    foreach ($_from AS $this->_var['address']):
?><option value="<?php echo $this->_var['address']['address_id']; ?>" <?php if ($_GET['address_id'] == $this->_var['address']['address_id']): ?>selected<?php endif; ?>><?php echo htmlspecialchars($this->_var['address']['consignee']); ?> <?php echo $this->_var['address']['email']; ?> <?php echo htmlspecialchars($this->_var['address']['address']); ?> <?php echo htmlspecialchars($this->_var['address']['tel']); ?></option><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </select></td>
  </tr>
  <?php endif; ?>
  <tr>
    <th width="150" align="left"><?php echo $this->_var['lang']['label_consignee']; ?></th>
    <td><input name="consignee" type="text" value="<?php echo $this->_var['order']['consignee']; ?>" />
      <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php if ($this->_var['exist_real_goods']): ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_area']; ?></th>
    <td><select name="country" id="selCountries" onChange="region.changed(this, 1, 'selProvinces')">
        <option value="0" selected="true"><?php echo $this->_var['lang']['select_please']; ?></option>
        <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
        <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['order']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </select> <select name="province" id="selProvinces" onChange="region.changed(this, 2, 'selCities')">
        <option value="0"><?php echo $this->_var['lang']['select_please']; ?></option>
        <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
        <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['order']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </select> <select name="city" id="selCities" onchange="region.changed(this, 3, 'selDistricts')">
          <option value="0"><?php echo $this->_var['lang']['select_please']; ?></option>
          <!-- <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?> -->
          <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['order']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
          <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
        </select>
        <select name="district" id="selDistricts">
          <option value="0"><?php echo $this->_var['lang']['select_please']; ?></option>
          <!-- <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?> -->
          <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['order']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
          <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
        </select>
        <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php endif; ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_email']; ?></th>
    <td><input name="email" type="text" value="<?php echo $this->_var['order']['email']; ?>" size="40" />
    <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php if ($this->_var['exist_real_goods']): ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_address']; ?></th>
    <td><input name="address" type="text" value="<?php echo $this->_var['order']['address']; ?>" size="40" />
    <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_zipcode']; ?></th>
    <td><input name="zipcode" type="text" value="<?php echo $this->_var['order']['zipcode']; ?>" /></td>
  </tr>
  <?php endif; ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_tel']; ?></th>
    <td><input name="tel" type="text" value="<?php echo $this->_var['order']['tel']; ?>" />
    <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_mobile']; ?></th>
    <td><input name="mobile" type="text" value="<?php echo $this->_var['order']['mobile']; ?>" /></td>
  </tr>
  <?php if ($this->_var['exist_real_goods']): ?>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_sign_building']; ?></th>
    <td><input name="sign_building" type="text" value="<?php echo $this->_var['order']['sign_building']; ?>" size="40" /></td>
  </tr>
  <tr>
    <th align="left"><?php echo $this->_var['lang']['label_best_time']; ?></th>
    <td><input name="best_time" type="text" value="<?php echo $this->_var['order']['best_time']; ?>" size="40" /></td>
  </tr>
  <?php endif; ?>
</table>
</div>

<div align="center">
  <p>
    <?php if ($this->_var['step_act'] == "add"): ?><?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?><?php endif; ?>
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</div>
</form>

<?php elseif ($this->_var['step'] == "shipping"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkShipping()">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="5%">&nbsp;</th>
    <th width="25%"><?php echo $this->_var['lang']['name']; ?></th>
    <th><?php echo $this->_var['lang']['desc']; ?></th>
    <th width="15%"><?php echo $this->_var['lang']['shipping_fee']; ?></th>
    <th width="15%"><?php echo $this->_var['lang']['free_money']; ?></th>
  <th width="15%"><?php echo $this->_var['lang']['insure']; ?></th>
  </tr>
  <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
  <tr>
    <td><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked<?php endif; ?> onclick="" /></td>
    <td><?php echo $this->_var['shipping']['shipping_name']; ?></td>
    <td><?php echo $this->_var['shipping']['shipping_desc']; ?></td>
    <td><div align="right"><?php echo $this->_var['shipping']['format_shipping_fee']; ?></div></td>
    <td><div align="right"><?php echo $this->_var['shipping']['free_money']; ?></div></td>
  <td><div align="right"><?php echo $this->_var['shipping']['insure']; ?></div></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>

<p align="right"><input name="insure" type="checkbox" value="1" <?php if ($this->_var['order']['insure_fee'] > 0): ?>checked<?php endif; ?> />
<?php echo $this->_var['lang']['want_insure']; ?></p>

  <p align="center">
    <?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?>
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>

<?php elseif ($this->_var['step'] == "payment"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkPayment()">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="5%">&nbsp;</th>
    <th width="20%"><?php echo $this->_var['lang']['name']; ?></th>
    <th><?php echo $this->_var['lang']['desc']; ?></th>
    <th width="15%"><?php echo $this->_var['lang']['pay_fee']; ?></th>
  </tr>
  <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
  <tr>
    <td><input type="radio" name="payment" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> /></td>
    <td><?php echo $this->_var['payment']['pay_name']; ?></td>
    <td><?php echo $this->_var['payment']['pay_desc']; ?></td>
    <td align="right"><?php echo $this->_var['payment']['pay_fee']; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>
  <p align="center">
    <?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?>
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>

<?php elseif ($this->_var['step'] == "other"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post">
<div class="list-div">
<?php if ($this->_var['exist_real_goods'] && ( $this->_var['pack_list'] || $this->_var['card_list'] )): ?>
<table cellpadding="3" cellspacing="1">
  <?php if ($this->_var['pack_list']): ?>
  <tr>
    <th colspan="4" scope="col"><?php echo $this->_var['lang']['select_pack']; ?></th>
    </tr>
  <tr>
    <td width="5%" scope="col">&nbsp;</td>
    <td width="35%" scope="col"><div align="center"><strong><?php echo $this->_var['lang']['name']; ?></strong></div></td>
    <td width="22%" scope="col"><div align="center"><strong><?php echo $this->_var['lang']['pack_fee']; ?></strong></div></td>
    <td width="22%" scope="col"><div align="center"><strong><?php echo $this->_var['lang']['free_money']; ?></strong></div></td>
    </tr>
  <tr>
    <td><input type="radio" name="pack" value="0" <?php if ($this->_var['order']['pack_id'] == 0): ?>checked<?php endif; ?> /></td>
    <td><?php echo $this->_var['lang']['no_pack']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php $_from = $this->_var['pack_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pack');if (count($_from)):
    foreach ($_from AS $this->_var['pack']):
?>
  <tr>
    <td><input type="radio" name="pack" value="<?php echo $this->_var['pack']['pack_id']; ?>" <?php if ($this->_var['order']['pack_id'] == $this->_var['pack']['pack_id']): ?>checked<?php endif; ?> /></td>
    <td><?php echo $this->_var['pack']['pack_name']; ?></td>
    <td><div align="right"><?php echo $this->_var['pack']['format_pack_fee']; ?></div></td>
    <td><div align="right"><?php echo $this->_var['pack']['format_free_money']; ?></div></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php endif; ?>
  <?php if ($this->_var['card_list']): ?>
  <tr>
    <th colspan="4" scope="col"><?php echo $this->_var['lang']['select_card']; ?></th>
    </tr>
  <tr>
    <td scope="col">&nbsp;</td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['name']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['card_fee']; ?></strong></div></td>
    <td scope="col"><div align="center"><strong><?php echo $this->_var['lang']['free_money']; ?></strong></div></td>
    </tr>
  <tr>
    <td><input type="radio" name="card" value="0" <?php if ($this->_var['order']['card_id'] == 0): ?>checked<?php endif; ?> /></td>
    <td><?php echo $this->_var['lang']['no_card']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php $_from = $this->_var['card_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
  <tr>
    <td><input type="radio" name="card" value="<?php echo $this->_var['card']['card_id']; ?>" <?php if ($this->_var['order']['card_id'] == $this->_var['card']['card_id']): ?>checked<?php endif; ?> /></td>
    <td><?php echo $this->_var['card']['card_name']; ?></td>
    <td><div align="right"><?php echo $this->_var['card']['format_card_fee']; ?></div></td>
    <td><div align="right"><?php echo $this->_var['card']['format_free_money']; ?></div></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php endif; ?>
</table>
<?php endif; ?>
</div><br />
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <?php if ($this->_var['exist_real_goods']): ?>
  <?php if ($this->_var['card_list']): ?>
  <tr>
    <th><?php echo $this->_var['lang']['label_card_message']; ?></th>
    <td><textarea name="card_message" cols="60" rows="3"><?php echo $this->_var['order']['card_message']; ?></textarea></td>
  </tr>
  <?php endif; ?>
  <tr>
    <th><?php echo $this->_var['lang']['label_inv_type']; ?></th>
    <td><input name="inv_type" type="text" id="inv_type" value="<?php echo $this->_var['order']['inv_type']; ?>" size="40" /></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_inv_payee']; ?></th>
    <td><input name="inv_payee" value="<?php echo $this->_var['order']['inv_payee']; ?>" size="40" text="text" /></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_inv_content']; ?></th>
    <td><input name="inv_content" value="<?php echo $this->_var['order']['inv_content']; ?>" size="40" text="text" /></td>
  </tr>
  <?php endif; ?>
  <tr>
    <th><?php echo $this->_var['lang']['label_postscript']; ?></th>
    <td><textarea name="postscript" cols="60" rows="3"><?php echo $this->_var['order']['postscript']; ?></textarea></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_how_oos']; ?></th>
    <td><input name="how_oos" type="text" value="<?php echo $this->_var['order']['how_oos']; ?>" size="40" /></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_to_buyer']; ?></th>
    <td><textarea name="to_buyer" cols="60" rows="3"><?php echo $this->_var['order']['to_buyer']; ?></textarea></td>
  </tr>
</table>
</div>
  <p align="center">
    <?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?>
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>

<?php elseif ($this->_var['step'] == "money"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="120"><?php echo $this->_var['lang']['label_goods_amount']; ?></th>
    <td width="150"><?php echo $this->_var['order']['formated_goods_amount']; ?></td>
  <th width="120"><?php echo $this->_var['lang']['label_discount']; ?></th>
    <td><input name="discount" type="text" id="discount" value="<?php echo $this->_var['order']['discount']; ?>" size="15" /></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_tax']; ?></th>
    <td><input name="tax" type="text" id="tax" value="<?php echo $this->_var['order']['tax']; ?>" size="15" /></td>
    <th><?php echo $this->_var['lang']['label_order_amount']; ?></th>
    <td><?php echo $this->_var['order']['formated_total_fee']; ?></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_shipping_fee']; ?></th>
    <td><?php if ($this->_var['exist_real_goods']): ?><input name="shipping_fee" type="text" value="<?php echo $this->_var['order']['shipping_fee']; ?>" size="15"><?php else: ?>0<?php endif; ?></td>
  <th width="120"><?php echo $this->_var['lang']['label_money_paid']; ?></th>
    <td><?php echo $this->_var['order']['formated_money_paid']; ?> </td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_insure_fee']; ?></th>
    <td><?php if ($this->_var['exist_real_goods']): ?><input name="insure_fee" type="text" value="<?php echo $this->_var['order']['insure_fee']; ?>" size="15"><?php else: ?>0<?php endif; ?></td>
  <th><?php echo $this->_var['lang']['label_surplus']; ?></th>
    <td><?php if ($this->_var['order']['user_id'] > 0): ?>
        <input name="surplus" type="text" value="<?php echo $this->_var['order']['surplus']; ?>" size="15">
  <?php endif; ?> <?php echo $this->_var['lang']['available_surplus']; ?><?php echo empty($this->_var['available_user_money']) ? '0' : $this->_var['available_user_money']; ?></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_pay_fee']; ?></th>
    <td><input name="pay_fee" type="text" value="<?php echo $this->_var['order']['pay_fee']; ?>" size="15"></td>
  <th><?php echo $this->_var['lang']['label_integral']; ?></th>
    <td><?php if ($this->_var['order']['user_id'] > 0): ?>
        <input name="integral" type="text" value="<?php echo $this->_var['order']['integral']; ?>" size="15">
  <?php endif; ?> <?php echo $this->_var['lang']['available_integral']; ?><?php echo empty($this->_var['available_pay_points']) ? '0' : $this->_var['available_pay_points']; ?></td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_pack_fee']; ?></th>
    <td><?php if ($this->_var['exist_real_goods']): ?>
      <input name="pack_fee" type="text" value="<?php echo $this->_var['order']['pack_fee']; ?>" size="15">
      <?php else: ?>0<?php endif; ?></td>
    <th><?php echo $this->_var['lang']['label_bonus']; ?></th>
    <td>
      <select name="bonus_id">
        <option value="0" <?php if ($this->_var['order']['bonus_id'] == 0): ?>selected<?php endif; ?>><?php echo $this->_var['lang']['select_please']; ?></option>

          <?php $_from = $this->_var['available_bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>

        <option value="<?php echo $this->_var['bonus']['bonus_id']; ?>" <?php if ($this->_var['order']['bonus_id'] == $this->_var['bonus']['bonus_id']): ?>selected<?php endif; ?> money="<?php echo $this->_var['bonus']['type_money']; ?>"><?php echo $this->_var['bonus']['type_name']; ?> - <?php echo $this->_var['bonus']['type_money']; ?></option>

          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

      </select>    </td>
  </tr>
  <tr>
    <th><?php echo $this->_var['lang']['label_card_fee']; ?></th>
    <td><?php if ($this->_var['exist_real_goods']): ?>
      <input name="card_fee" type="text" value="<?php echo $this->_var['order']['card_fee']; ?>" size="15">
      <?php else: ?>0<?php endif; ?></td>
    <th><?php if ($this->_var['order']['order_amount'] >= 0): ?> <?php echo $this->_var['lang']['label_money_dues']; ?> <?php else: ?> <?php echo $this->_var['lang']['label_money_refund']; ?> <?php endif; ?></th>
    <td><?php echo $this->_var['order']['formated_order_amount']; ?></td>
  </tr>
</table>
</div>
  <p align="center">
    <?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?>
    <input name="finish" type="submit" class="button" value="<?php echo $this->_var['lang']['button_finish']; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>

<?php elseif ($this->_var['step'] == "invoice"): ?>
<form name="theForm" action="order.php?act=step_post&step=<?php echo $this->_var['step']; ?>&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>" method="post" onsubmit="return checkShipping()">
<div class="list-div">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="5%">&nbsp;</th>
    <th width="25%"><?php echo $this->_var['lang']['name']; ?></th>
    <th><?php echo $this->_var['lang']['desc']; ?></th>
    </tr>
  <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
  <tr>
    <td><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked<?php endif; ?> onclick="" /></td>
    <td><?php echo $this->_var['shipping']['shipping_name']; ?></td>
    <td><?php echo $this->_var['shipping']['shipping_desc']; ?></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td colspan="3"><strong><?php echo $this->_var['lang']['shipping_note']; ?></strong></td>
    </tr>
  <tr>
    <td colspan="3"><a href="javascript:showNotice('noticeinvoiceno');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><strong><?php echo $this->_var['lang']['label_invoice_no']; ?></strong><input name="invoice_no" type="text" value="<?php echo $this->_var['order']['invoice_no']; ?>" size="30"/><br/><span class="notice-span" id="noticeinvoiceno" style="display:block;"><?php echo $this->_var['lang']['invoice_no_mall']; ?></span></td>
  </tr>
</table>
</div>

  <p align="center">
    <?php if ($this->_var['step_act'] == "add"): ?><input type="button" value="<?php echo $this->_var['lang']['button_prev']; ?>" class="button" onclick="history.back()" /><?php endif; ?>
    <input name="<?php if ($this->_var['step_act'] == 'add'): ?>next<?php else: ?>finish<?php endif; ?>" type="submit" class="button" value="<?php if ($this->_var['step_act'] == 'add'): ?><?php echo $this->_var['lang']['button_next']; ?><?php else: ?><?php echo $this->_var['lang']['button_submit']; ?><?php endif; ?>" />
    <input type="button" value="<?php echo $this->_var['lang']['button_cancel']; ?>" class="button" onclick="location.href='order.php?act=process&func=cancel_order&order_id=<?php echo $this->_var['order_id']; ?>&step_act=<?php echo $this->_var['step_act']; ?>'" />
  </p>
</form>
<?php endif; ?>

<script language="JavaScript">
  var step = '<?php echo $this->_var['step']; ?>';
  var orderId = <?php echo $this->_var['order_id']; ?>;
  var act = '<?php echo $_GET['act']; ?>';

  function checkUser()
  {
    var eles = document.forms['theForm'].elements;

    /* 如果搜索会员，检查是否找到 */
    if (document.getElementById('user_useridname').checked && eles['user'].options.length == 0)
    {
      alert(pls_search_user);
      return false;
    }
    return true;
  }

  function checkGoods()
  {
    var eles = document.forms['theForm'].elements;

    if (eles['goods_count'].value <= 0)
    {
      alert(pls_search_goods);
      return false;
    }
    return true;
  }

  function checkConsignee()
  {
    var eles = document.forms['theForm'].elements;

    if (eles['country'].value <= 0)
    {
      alert(pls_select_area);
      return false;
    }
    if (eles['province'].options.length > 1 && eles['province'].value <= 0)
    {
      alert(pls_select_area);
      return false;
    }
    if (eles['city'].options.length > 1 && eles['city'].value <= 0)
    {
      alert(pls_select_area);
      return false;
    }
    if (eles['district'].options.length > 1 && eles['district'].value <= 0)
    {
      alert(pls_select_area);
      return false;
    }
    return true;
  }

  function checkShipping()
  {
    if (!radioChecked('shipping'))
    {
      alert(pls_select_shipping);
      return false;
    }
    return true;
  }

  function checkPayment()
  {
    if (!radioChecked('payment'))
    {
      alert(pls_select_payment);
      return false;
    }
    return true;
  }

  /**
   * 返回某 radio 是否被选中一个
   * @param string radioName
   */
  function radioChecked(radioName)
  {
    var eles = document.forms['theForm'].elements;

    for (var i = 0; i < eles.length; i++)
    {
      if (eles[i].name == radioName && eles[i].checked)
      {
        return true;
      }
    }
    return false;
  }

  /**
   * 按用户编号或用户名搜索用户
   */
  function searchUser()
  {
    var eles = document.forms['theForm'].elements;

    /* 填充列表 */
    var idName = Utils.trim(eles['keyword'].value);
    if (idName != '')
    {
      Ajax.call('order.php?act=search_users&id_name=' + idName, '', searchUserResponse, 'GET', 'JSON');
    }
  }

  function searchUserResponse(result)
  {
    if (result.message.length > 0)
    {
      alert(result.message);
    }

    if (result.error == 0)
    {
      var eles = document.forms['theForm'].elements;

      /* 清除列表 */
      var selLen = eles['user'].options.length;
      for (var i = selLen - 1; i >= 0; i--)
      {
        eles['user'].options[i] = null;
      }
      var arr = result.userlist;
      var userCnt = arr.length;

      for (var i = 0; i < userCnt; i++)
      {
        var opt = document.createElement('OPTION');
        opt.value = arr[i].user_id;
        opt.text = arr[i].user_name;
        eles['user'].options.add(opt);
      }
    }
  }

  /**
   * 按商品编号或商品名称或商品货号搜索商品
   */
  function searchGoods()
  {
    var eles = document.forms['goodsForm'].elements;

    /* 填充列表 */
    var keyword = Utils.trim(eles['keyword'].value);
    if (keyword != '')
    {
      Ajax.call('order.php?act=search_goods&keyword=' + keyword, '', searchGoodsResponse, 'GET', 'JSON');
    }
  }

  function searchGoodsResponse(result)
  {
    if (result.message.length > 0)
    {
      alert(result.message);
    }

    if (result.error == 0)
    {
      var eles = document.forms['goodsForm'].elements;

      /* 清除列表 */
      var selLen = eles['goodslist'].options.length;
      for (var i = selLen - 1; i >= 0; i--)
      {
        eles['goodslist'].options[i] = null;
      }

      var arr = result.goodslist;
      var goodsCnt = arr.length;
      if (goodsCnt > 0)
      {
        for (var i = 0; i < goodsCnt; i++)
        {
          var opt = document.createElement('OPTION');
          opt.value = arr[i].goods_id;
          opt.text = arr[i].name;
          eles['goodslist'].options.add(opt);
        }
        getGoodsInfo(arr[0].goods_id);
      }
      else
      {
        getGoodsInfo(0);
      }
    }
  }

  /**
   * 取得某商品信息
   * @param int goodsId 商品id
   */
  function getGoodsInfo(goodsId)
  {
    if (goodsId > 0)
    {
      Ajax.call('order.php?act=json&func=get_goods_info', 'goods_id=' + goodsId, getGoodsInfoResponse, 'get', 'json');
    }
    else
    {
      document.getElementById('goods_name').innerHTML = '';
      document.getElementById('goods_sn').innerHTML = '';
      document.getElementById('goods_cat').innerHTML = '';
      document.getElementById('goods_brand').innerHTML = '';
      document.getElementById('add_price').innerHTML = '';
      document.getElementById('goods_attr').innerHTML = '';
    }
  }
  function getGoodsInfoResponse(result)
  {
    var eles = document.forms['goodsForm'].elements;

    // 显示商品名称、货号、分类、品牌
    document.getElementById('goods_name').innerHTML = result.goods_name;
    document.getElementById('goods_sn').innerHTML = result.goods_sn;
    document.getElementById('goods_cat').innerHTML = result.cat_name;
    document.getElementById('goods_brand').innerHTML = result.brand_name;

    // 显示价格：包括市场价、本店价（促销价）、会员价
    var priceHtml = '<input type="radio" name="add_price" value="' + result.market_price + '" />市场价 [' + result.market_price + ']<br />' +
      '<input type="radio" name="add_price" value="' + result.goods_price + '" checked />本店价 [' + result.goods_price + ']<br />';
    for (var i = 0; i < result.user_price.length; i++)
    {
      priceHtml += '<input type="radio" name="add_price" value="' + result.user_price[i].user_price + '" />' + result.user_price[i].rank_name + ' [' + result.user_price[i].user_price + ']<br />';
    }
    priceHtml += '<input type="radio" name="add_price" value="user_input" />' + input_price + '<input type="text" name="input_price" value="" /><br />';
    document.getElementById('add_price').innerHTML = priceHtml;

    // 显示属性
    var specCnt = 0; // 规格的数量
    var attrHtml = '';
    var attrType = '';
    var attrTypeArray = '';
    var attrCnt = result.attr_list.length;
    for (i = 0; i < attrCnt; i++)
    {
      var valueCnt = result.attr_list[i].length;

      // 规格
      if (valueCnt > 1)
      {
        attrHtml += result.attr_list[i][0].attr_name + ': ';
        for (var j = 0; j < valueCnt; j++)
        {
          switch (result.attr_list[i][j].attr_type)
          {
            case '0' :
            case '1' :
              attrType = 'radio';
              attrTypeArray = '';
            break;

            case '2' :
              attrType = 'checkbox';
              attrTypeArray = '[]';
            break;
          }
          attrHtml += '<input type="' + attrType + '" name="spec_' + specCnt + attrTypeArray + '" value="' + result.attr_list[i][j].goods_attr_id + '"';
          if (j == 0)
          {
            attrHtml += ' checked';
          }
          attrHtml += ' />' + result.attr_list[i][j].attr_value;
          if (result.attr_list[i][j].attr_price > 0)
          {
            attrHtml += ' [+' + result.attr_list[i][j].attr_price + ']';
          }
          else if (result.attr_list[i][j].attr_price < 0)
          {
            attrHtml += ' [-' + Math.abs(result.attr_list[i][j].attr_price) + ']';
          }
        }
        attrHtml += '<br />';
        specCnt++;
      }
      // 属性
      else
      {
        attrHtml += result.attr_list[i][0].attr_name + ': ' + result.attr_list[i][0].attr_value + '<br />';
      }
    }
    eles['spec_count'].value = specCnt;
    document.getElementById('goods_attr').innerHTML = attrHtml;
  }

  /**
   * 把商品加入订单
   */
  function addToOrder()
  {
    var eles = document.forms['goodsForm'].elements;

    // 检查是否选择了商品
    if (eles['goodslist'].options.length <= 0)
    {
      alert(pls_search_goods);
      return false;
    }
    return true;
  }

  /**
   * 载入收货地址
   * @param int addressId 收货地址id
   */
  function loadAddress(addressId)
  {

    location.href += 'order.php?act=<?php echo $_GET['act']; ?>&order_id=<?php echo $_GET['order_id']; ?>&step=<?php echo $_GET['step']; ?>&address_id=' + addressId;

  }
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>