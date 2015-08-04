<!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,selectzone.js,colorselector.js')); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php if ($this->_var['warning']): ?>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['warning']; ?></li>
</ul>
<?php endif; ?>

<!-- start goods form -->
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab"><?php echo $this->_var['lang']['tab_general']; ?></span><span
        class="tab-back" id="detail-tab"><?php echo $this->_var['lang']['tab_detail']; ?></span><span
        class="tab-back" id="mix-tab"><?php echo $this->_var['lang']['tab_mix']; ?></span><?php if ($this->_var['goods_type_list']): ?><span
        class="tab-back" id="properties-tab"><?php echo $this->_var['lang']['tab_properties']; ?></span><?php endif; ?><span
        class="tab-back" id="gallery-tab"><?php echo $this->_var['lang']['tab_gallery']; ?></span><span
        class="tab-back" id="linkgoods-tab"><?php echo $this->_var['lang']['tab_linkgoods']; ?></span><?php if ($this->_var['code'] == ''): ?><span
        class="tab-back" id="groupgoods-tab"><?php echo $this->_var['lang']['tab_groupgoods']; ?></span><?php endif; ?><span
        class="tab-back" id="article-tab"><?php echo $this->_var['lang']['tab_article']; ?></span>
      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="" method="post" name="theForm" >
        <!-- 鏈€澶ф枃浠堕檺鍒 -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <!-- 閫氱敤淇℃伅 -->
        <table width="90%" id="general-table" align="center">
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_goods_name']; ?></td>
            <td><input type="text" name="goods_name" value="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" style="float:left;color:<?php echo $this->_var['goods_name_color']; ?>;" size="30" /><div style="background-color:<?php echo $this->_var['goods_name_color']; ?>;float:left;margin-left:2px;" id="font_color" onclick="ColorSelecter.Show(this);"><img src="images/color_selecter.gif" style="margin-top:-1px;" /></div><input type="hidden" id="goods_name_color" name="goods_name_color" value="<?php echo $this->_var['goods_name_color']; ?>" />&nbsp;
            <select name="goods_name_style">
              <option value=""><?php echo $this->_var['lang']['select_font']; ?></option>
              <?php echo $this->html_options(array('options'=>$this->_var['lang']['font_styles'],'selected'=>$this->_var['goods_name_style'])); ?>
            </select>
            <?php echo $this->_var['lang']['require_field']; ?></td>
          </tr>
          <tr>
            <td class="label">
            <a href="javascript:showNotice('noticeGoodsSN');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_goods_sn']; ?> </td>
            <td><input type="text" name="goods_sn" value="<?php echo htmlspecialchars($this->_var['goods']['goods_sn']); ?>" size="20" onblur="checkGoodsSn(this.value,'<?php echo $this->_var['goods']['goods_id']; ?>')" /><span id="goods_sn_notice"></span><br />
            <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['notice_goods_sn']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_goods_cat']; ?></td>
            <td><select name="cat_id" onchange="hideCatDiv()" ><option value="0"><?php echo $this->_var['lang']['select_please']; ?></option><?php echo $this->_var['cat_list']; ?></select>
              <?php if ($this->_var['is_add']): ?>
              <a href="javascript:void(0)" onclick="rapidCatAdd()" title="<?php echo $this->_var['lang']['rapid_add_cat']; ?>" class="special"><?php echo $this->_var['lang']['rapid_add_cat']; ?></a>
              <span id="category_add" style="display:none;">
              <input class="text" size="10" name="addedCategoryName" />
               <a href="javascript:void(0)" onclick="addCategory()" title="<?php echo $this->_var['lang']['button_submit']; ?>" class="special" ><?php echo $this->_var['lang']['button_submit']; ?></a>
               <a href="javascript:void(0)" onclick="return goCatPage()" title="<?php echo $this->_var['lang']['category_manage']; ?>" class="special" ><?php echo $this->_var['lang']['category_manage']; ?></a>
               <a href="javascript:void(0)" onclick="hideCatDiv()" title="<?php echo $this->_var['lang']['hide']; ?>" class="special" ><<</a>
               </span>
               <?php endif; ?>
               <?php echo $this->_var['lang']['require_field']; ?>
            </td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_other_cat']; ?></td>
            <td>
              <input type="button" value="<?php echo $this->_var['lang']['add']; ?>" onclick="addOtherCat(this.parentNode)" class="button" />
              <?php $_from = $this->_var['goods']['other_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_id');if (count($_from)):
    foreach ($_from AS $this->_var['cat_id']):
?>
              <select name="other_cat[]"><option value="0"><?php echo $this->_var['lang']['select_please']; ?></option><?php echo $this->_var['other_cat_list'][$this->_var['cat_id']]; ?></select>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_goods_brand']; ?></td>
            <td><select name="brand_id" onchange="hideBrandDiv()" ><option value="0"><?php echo $this->_var['lang']['select_please']; ?><?php echo $this->html_options(array('options'=>$this->_var['brand_list'],'selected'=>$this->_var['goods']['brand_id'])); ?></select>
              <?php if ($this->_var['is_add']): ?>
              <a href="javascript:void(0)" title="<?php echo $this->_var['lang']['rapid_add_brand']; ?>" onclick="rapidBrandAdd()" class="special" ><?php echo $this->_var['lang']['rapid_add_brand']; ?></a>
              <span id="brand_add" style="display:none;">
              <input class="text" size="15" name="addedBrandName" />
               <a href="javascript:void(0)" onclick="addBrand()" class="special" ><?php echo $this->_var['lang']['button_submit']; ?></a>
               <a href="javascript:void(0)" onclick="return goBrandPage()" title="<?php echo $this->_var['lang']['brand_manage']; ?>" class="special" ><?php echo $this->_var['lang']['brand_manage']; ?></a>
               <a href="javascript:void(0)" onclick="hideBrandDiv()" title="<?php echo $this->_var['lang']['hide']; ?>" class="special" ><<</a>
               </span>
               <?php endif; ?>
            </td>
          </tr>
         <?php if ($this->_var['suppliers_exists'] == 1): ?>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['label_suppliers']; ?></td>
            <td><select name="suppliers_id" id="suppliers_id">
        <option value="0"><?php echo $this->_var['lang']['suppliers_no']; ?></option>
        <?php echo $this->html_options(array('options'=>$this->_var['suppliers_list_name'],'selected'=>$this->_var['goods']['suppliers_id'])); ?>
      </select></td>
          </tr>
         <?php endif; ?>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_shop_price']; ?></td>
            <td><input type="text" name="shop_price" value="<?php echo $this->_var['goods']['shop_price']; ?>" size="20" onblur="priceSetted()"/>
            <input type="button" value="<?php echo $this->_var['lang']['compute_by_mp']; ?>" onclick="marketPriceSetted()" />
            <?php echo $this->_var['lang']['require_field']; ?></td>
          </tr>
          <?php if ($this->_var['user_rank_list']): ?>
          <tr>
            <td class="label"><a href="javascript:showNotice('noticeUserPrice');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['lab_user_price']; ?></td>
            <td>
              <?php $_from = $this->_var['user_rank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user_rank');if (count($_from)):
    foreach ($_from AS $this->_var['user_rank']):
?>
              <?php echo $this->_var['user_rank']['rank_name']; ?><span id="nrank_<?php echo $this->_var['user_rank']['rank_id']; ?>"></span><input type="text" id="rank_<?php echo $this->_var['user_rank']['rank_id']; ?>" name="user_price[]" value="<?php echo empty($this->_var['member_price_list'][$this->_var['user_rank']['rank_id']]) ? '-1' : $this->_var['member_price_list'][$this->_var['user_rank']['rank_id']]; ?>" onkeyup="if(parseInt(this.value)<-1){this.value='-1';};set_price_note(<?php echo $this->_var['user_rank']['rank_id']; ?>)" size="8" />
              <input type="hidden" name="user_rank[]" value="<?php echo $this->_var['user_rank']['rank_id']; ?>" />
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <br />
              <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeUserPrice"><?php echo $this->_var['lang']['notice_user_price']; ?></span>
            </td>
          </tr>
          <?php endif; ?>

          <!--鍟嗗搧浼樻儬浠锋牸-->
          <tr>
            <td class="label"><a href="javascript:showNotice('volumePrice');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['lab_volume_price']; ?></td>
            <td>
              <table width="100%" id="tbody-volume" align="center">
                <?php $_from = $this->_var['volume_price_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'volume_price');$this->_foreach['volume_price_tab'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['volume_price_tab']['total'] > 0):
    foreach ($_from AS $this->_var['volume_price']):
        $this->_foreach['volume_price_tab']['iteration']++;
?>
                <tr>
                  <td>
                     <?php if ($this->_foreach['volume_price_tab']['iteration'] == 1): ?>
                       <a href="javascript:;" onclick="addVolumePrice(this)">[+]</a>
                     <?php else: ?>
                       <a href="javascript:;" onclick="removeVolumePrice(this)">[-]</a>
                     <?php endif; ?>
                     <?php echo $this->_var['lang']['volume_number']; ?> <input type="text" name="volume_number[]" size="8" value="<?php echo $this->_var['volume_price']['number']; ?>"/>
                     <?php echo $this->_var['lang']['volume_price']; ?> <input type="text" name="volume_price[]" size="8" value="<?php echo $this->_var['volume_price']['price']; ?>"/>
                  </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </table>
              <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="volumePrice"><?php echo $this->_var['lang']['notice_volume_price']; ?></span>
            </td>
          </tr>
          <!--鍟嗗搧浼樻儬浠锋牸 end -->

          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_market_price']; ?></td>
            <td><input type="text" name="market_price" value="<?php echo $this->_var['goods']['market_price']; ?>" size="20" />
              <input type="button" value="<?php echo $this->_var['lang']['integral_market_price']; ?>" onclick="integral_market_price()" />
            </td>
          </tr>
          <tr>
            <td class="label"><a href="javascript:showNotice('giveIntegral');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_give_integral']; ?></td>
            <td><input type="text" name="give_integral" value="<?php echo $this->_var['goods']['give_integral']; ?>" size="20" />
            <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="giveIntegral"><?php echo $this->_var['lang']['notice_give_integral']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><a href="javascript:showNotice('rankIntegral');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_rank_integral']; ?></td>
            <td><input type="text" name="rank_integral" value="<?php echo $this->_var['goods']['rank_integral']; ?>" size="20" />
            <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="rankIntegral"><?php echo $this->_var['lang']['notice_rank_integral']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><a href="javascript:showNotice('noticPoints');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_integral']; ?></td>
            <td><input type="text" name="integral" value="<?php echo $this->_var['goods']['integral']; ?>" size="20" onblur="parseint_integral()";/>
              <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticPoints"><?php echo $this->_var['lang']['notice_integral']; ?></span>
            </td>
          </tr>
          <tr>
            <td class="label"><label for="is_promote"><input type="checkbox" id="is_promote" name="is_promote" value="1" <?php if ($this->_var['goods']['is_promote']): ?>checked="checked"<?php endif; ?> onclick="handlePromote(this.checked);" /> <?php echo $this->_var['lang']['lab_promote_price']; ?></label></td>
            <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="<?php echo $this->_var['goods']['promote_price']; ?>" size="20" /></td>
          </tr>
          <tr id="promote_4">
            <td class="label" id="promote_5"><?php echo $this->_var['lang']['lab_promote_date']; ?></td>
            <td id="promote_6">
              <input name="promote_start_date" type="text" id="promote_start_date" size="12" value='<?php echo $this->_var['goods']['promote_start_date']; ?>' readonly="readonly" /><input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('promote_start_date', '%Y-%m-%d', false, false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/> - <input name="promote_end_date" type="text" id="promote_end_date" size="12" value='<?php echo $this->_var['goods']['promote_end_date']; ?>' readonly="readonly" /><input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('promote_end_date', '%Y-%m-%d', false, false, 'selbtn2');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
            </td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_picture']; ?></td>
            <td>
              <input type="file" name="goods_img" size="35" />
              <?php if ($this->_var['goods']['goods_img']): ?>
                <a href="goods.php?act=show_image&img_url=<?php echo $this->_var['goods']['goods_img']; ?>" target="_blank"><img src="images/yes.gif" border="0" /></a>
              <?php else: ?>
                <img src="images/no.gif" />
              <?php endif; ?>
              <br /><input type="text" size="40" value="<?php echo $this->_var['lang']['lab_picture_url']; ?>" style="color:#aaa;" onfocus="if (this.value == '<?php echo $this->_var['lang']['lab_picture_url']; ?>'){this.value='http://';this.style.color='#000';}" name="goods_img_url"/>
            </td>
          </tr>
          <tr id="auto_thumb_1">
            <td class="label"> <?php echo $this->_var['lang']['lab_thumb']; ?></td>
            <td id="auto_thumb_3">
              <input type="file" name="goods_thumb" size="35" />
              <?php if ($this->_var['goods']['goods_thumb']): ?>
                <a href="goods.php?act=show_image&img_url=<?php echo $this->_var['goods']['goods_thumb']; ?>" target="_blank"><img src="images/yes.gif" border="0" /></a>
              <?php else: ?>
                <img src="images/no.gif" />
              <?php endif; ?>
              <br /><input type="text" size="40" value="<?php echo $this->_var['lang']['lab_thumb_url']; ?>" style="color:#aaa;" onfocus="if (this.value == '<?php echo $this->_var['lang']['lab_thumb_url']; ?>'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url"/>
              <?php if ($this->_var['gd'] > 0): ?>
              <br /><label for="auto_thumb"><input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)" /><?php echo $this->_var['lang']['auto_thumb']; ?></label><?php endif; ?>
            </td>
          </tr>
        </table>

        <!-- 璇︾粏鎻忚堪 -->
        <table width="90%" id="detail-table" style="display:none">
          <tr>
            <td><?php echo $this->_var['FCKeditor']; ?></td>
          </tr>
        </table>

        <!-- 鍏朵粬淇℃伅 -->
        <table width="90%" id="mix-table" style="display:none" align="center">
          <?php if ($this->_var['code'] == ''): ?>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_goods_weight']; ?></td>
            <td><input type="text" name="goods_weight" value="<?php echo $this->_var['goods']['goods_weight_by_unit']; ?>" size="20" /> <select name="weight_unit"><?php echo $this->html_options(array('options'=>$this->_var['unit_list'],'selected'=>$this->_var['weight_unit'])); ?></select></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['cfg']['use_storage']): ?>
          <tr>
            <td class="label"><a href="javascript:showNotice('noticeStorage');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_goods_number']; ?></td>
<!--            <td><input type="text" name="goods_number" value="<?php echo $this->_var['goods']['goods_number']; ?>" size="20" <?php if ($this->_var['code'] != '' || $this->_var['goods']['_attribute'] != ''): ?>readonly="readonly"<?php endif; ?> /><br />-->
            <td><input type="text" name="goods_number" value="<?php echo $this->_var['goods']['goods_number']; ?>" size="20" /><br />
            <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeStorage"><?php echo $this->_var['lang']['notice_storage']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_warn_number']; ?></td>
            <td><input type="text" name="warn_number" value="<?php echo $this->_var['goods']['warn_number']; ?>" size="20" /></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_intro']; ?></td>
            <td><input type="checkbox" name="is_best" value="1" <?php if ($this->_var['goods']['is_best']): ?>checked="checked"<?php endif; ?> /><?php echo $this->_var['lang']['is_best']; ?> <input type="checkbox" name="is_new" value="1" <?php if ($this->_var['goods']['is_new']): ?>checked="checked"<?php endif; ?> /><?php echo $this->_var['lang']['is_new']; ?> <input type="checkbox" name="is_hot" value="1" <?php if ($this->_var['goods']['is_hot']): ?>checked="checked"<?php endif; ?> /><?php echo $this->_var['lang']['is_hot']; ?></td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2"><?php echo $this->_var['lang']['lab_is_on_sale']; ?></td>
            <td id="alone_sale_3"><input type="checkbox" name="is_on_sale" value="1" <?php if ($this->_var['goods']['is_on_sale']): ?>checked="checked"<?php endif; ?> /> <?php echo $this->_var['lang']['on_sale_desc']; ?></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_is_alone_sale']; ?></td>
            <td><input type="checkbox" name="is_alone_sale" value="1" <?php if ($this->_var['goods']['is_alone_sale']): ?>checked="checked"<?php endif; ?> /> <?php echo $this->_var['lang']['alone_sale']; ?></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_is_free_shipping']; ?></td>
            <td><input type="checkbox" name="is_shipping" value="1" <?php if ($this->_var['goods']['is_shipping']): ?>checked="checked"<?php endif; ?> /> <?php echo $this->_var['lang']['free_shipping']; ?></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_keywords']; ?></td>
            <td><input type="text" name="keywords" value="<?php echo htmlspecialchars($this->_var['goods']['keywords']); ?>" size="40" /> <?php echo $this->_var['lang']['notice_keywords']; ?></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['lab_goods_brief']; ?></td>
            <td><textarea name="goods_brief" cols="40" rows="3"><?php echo htmlspecialchars($this->_var['goods']['goods_brief']); ?></textarea></td>
          </tr>
          <tr>
            <td class="label">
            <a href="javascript:showNotice('noticeSellerNote');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a> <?php echo $this->_var['lang']['lab_seller_note']; ?> </td>
            <td><textarea name="seller_note" cols="40" rows="3"><?php echo $this->_var['goods']['seller_note']; ?></textarea><br />
            <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeSellerNote"><?php echo $this->_var['lang']['notice_seller_note']; ?></span></td>
          </tr>
        </table>

        <!-- 灞炴€т笌瑙勬牸 -->
        <?php if ($this->_var['goods_type_list']): ?>
        <table width="90%" id="properties-table" style="display:none" align="center">
          <tr>
              <td class="label"><a href="javascript:showNotice('noticeGoodsType');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['lab_goods_type']; ?></td>
              <td>
                <select name="goods_type" onchange="getAttrList(<?php echo $this->_var['goods']['goods_id']; ?>)">
                  <option value="0"><?php echo $this->_var['lang']['sel_goods_type']; ?></option>
                  <?php echo $this->_var['goods_type_list']; ?>
                </select><br />
              <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsType"><?php echo $this->_var['lang']['notice_goods_type']; ?></span></td>
          </tr>
          <tr>
            <td id="tbody-goodsAttr" colspan="2" style="padding:0"><?php echo $this->_var['goods_attr_html']; ?></td>
          </tr>
        </table>
        <?php endif; ?>

        <!-- 鍟嗗搧鐩稿唽 -->
        <table width="90%" id="gallery-table" style="display:none" align="center">
          <!-- 鍥剧墖鍒楄〃 -->
          <tr>
            <td>
              <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('i', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['i'] => $this->_var['img']):
?>
              <div id="gallery_<?php echo $this->_var['img']['img_id']; ?>" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                <a href="javascript:;" onclick="if (confirm('<?php echo $this->_var['lang']['drop_img_confirm']; ?>')) dropImg('<?php echo $this->_var['img']['img_id']; ?>')">[-]</a><br />
                <a href="goods.php?act=show_image&img_url=<?php echo $this->_var['img']['img_url']; ?>" target="_blank">
                <img src="../<?php if ($this->_var['img']['thumb_url']): ?><?php echo $this->_var['img']['thumb_url']; ?><?php else: ?><?php echo $this->_var['img']['img_url']; ?><?php endif; ?>" <?php if ($this->_var['thumb_width'] != 0): ?>width="<?php echo $this->_var['thumb_width']; ?>"<?php endif; ?> <?php if ($this->_var['thumb_height'] != 0): ?>height="<?php echo $this->_var['thumb_height']; ?>"<?php endif; ?> border="0" />
                </a><br />
                <input type="text" value="<?php echo htmlspecialchars($this->_var['img']['img_desc']); ?>" size="15" name="old_img_desc[<?php echo $this->_var['img']['img_id']; ?>]" />
              </div>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <!-- 涓婁紶鍥剧墖 -->
          <tr>
            <td>
              <a href="javascript:;" onclick="addImg(this)">[+]</a>
              <?php echo $this->_var['lang']['img_desc']; ?> <input type="text" name="img_desc[]" size="20" />
              <?php echo $this->_var['lang']['img_url']; ?> <input type="file" name="img_url[]" />
              <input type="text" size="40" value="<?php echo $this->_var['lang']['img_file']; ?>" style="color:#aaa;" onfocus="if (this.value == '<?php echo $this->_var['lang']['img_file']; ?>'){this.value='http://';this.style.color='#000';}" name="img_file[]"/>
            </td>
          </tr>
        </table>

        <!-- 鍏宠仈鍟嗗搧 -->
        <table width="90%" id="linkgoods-table" style="display:none" align="center">
          <!-- 鍟嗗搧鎼滅储 -->
          <tr>
            <td colspan="3">
              <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
              <select name="cat_id1"><option value="0"><?php echo $this->_var['lang']['all_category']; ?><?php echo $this->_var['cat_list']; ?></select>
              <select name="brand_id1"><option value="0"><?php echo $this->_var['lang']['all_brand']; ?><?php echo $this->html_options(array('options'=>$this->_var['brand_list'])); ?></select>
              <input type="text" name="keyword1" />
              <input type="button" value="<?php echo $this->_var['lang']['button_search']; ?>"  class="button"
                onclick="searchGoods(sz1, 'cat_id1','brand_id1','keyword1')" />
            </td>
          </tr>
          <!-- 鍟嗗搧鍒楄〃 -->
          <tr>
            <th><?php echo $this->_var['lang']['all_goods']; ?></th>
            <th><?php echo $this->_var['lang']['handler']; ?></th>
            <th><?php echo $this->_var['lang']['link_goods']; ?></th>
          </tr>
          <tr>
            <td width="42%">
              <select name="source_select1" size="20" style="width:100%" ondblclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" multiple="true">
              </select>
            </td>
            <td align="center">
              <p><input name="is_single" type="radio" value="1" checked="checked" /><?php echo $this->_var['lang']['single']; ?><br /><input name="is_single" type="radio" value="0" /><?php echo $this->_var['lang']['double']; ?></p>
              <p><input type="button" value=">>" onclick="sz1.addItem(true, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" class="button" /></p>
              <p><input type="button" value=">" onclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" class="button" /></p>
              <p><input type="button" value="<" onclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
              <p><input type="button" value="<<" onclick="sz1.dropItem(true, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
            </td>
            <td width="42%">
              <select name="target_select1" size="20" style="width:100%" multiple ondblclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)">
                <?php $_from = $this->_var['link_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link_goods');if (count($_from)):
    foreach ($_from AS $this->_var['link_goods']):
?>
                <option value="<?php echo $this->_var['link_goods']['goods_id']; ?>"><?php echo $this->_var['link_goods']['goods_name']; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
            </td>
          </tr>
        </table>

        <!-- 閰嶄欢 -->
        <table width="90%" id="groupgoods-table" style="display:none" align="center">
          <!-- 鍟嗗搧鎼滅储 -->
          <tr>
            <td colspan="3">
              <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
              <select name="cat_id2"><option value="0"><?php echo $this->_var['lang']['all_category']; ?><?php echo $this->_var['cat_list']; ?></select>
              <select name="brand_id2"><option value="0"><?php echo $this->_var['lang']['all_brand']; ?><?php echo $this->html_options(array('options'=>$this->_var['brand_list'])); ?></select>
              <input type="text" name="keyword2" />
              <input type="button" value="<?php echo $this->_var['lang']['button_search']; ?>" onclick="searchGoods(sz2, 'cat_id2', 'brand_id2', 'keyword2')" class="button" />
            </td>
          </tr>
          <!-- 鍟嗗搧鍒楄〃 -->
          <tr>
            <th><?php echo $this->_var['lang']['all_goods']; ?></th>
            <th><?php echo $this->_var['lang']['handler']; ?></th>
            <th><?php echo $this->_var['lang']['group_goods']; ?></th>
          </tr>
          <tr>
            <td width="42%">
              <select name="source_select2" size="20" style="width:100%" onchange="sz2.priceObj.value = this.options[this.selectedIndex].id" ondblclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)">
              </select>
            </td>
            <td align="center">
              <p><?php echo $this->_var['lang']['price']; ?><br /><input name="price2" type="text" size="6" /></p>
              <p><input type="button" value=">" onclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)" class="button" /></p>
              <p><input type="button" value="<" onclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
              <p><input type="button" value="<<" onclick="sz2.dropItem(true, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
            </td>
            <td width="42%">
              <select name="target_select2" size="20" style="width:100%" multiple ondblclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)">
                <?php $_from = $this->_var['group_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group_goods');if (count($_from)):
    foreach ($_from AS $this->_var['group_goods']):
?>
                <option value="<?php echo $this->_var['group_goods']['goods_id']; ?>"><?php echo $this->_var['group_goods']['goods_name']; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
            </td>
          </tr>
        </table>

        <!-- 鍏宠仈鏂囩珷 -->
        <table width="90%" id="article-table" style="display:none" align="center">
          <!-- 鏂囩珷鎼滅储 -->
          <tr>
            <td colspan="3">
              <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
              <?php echo $this->_var['lang']['article_title']; ?> <input type="text" name="article_title" />
              <input type="button" value="<?php echo $this->_var['lang']['button_search']; ?>" onclick="searchArticle()" class="button" />
            </td>
          </tr>
          <!-- 鏂囩珷鍒楄〃 -->
          <tr>
            <th><?php echo $this->_var['lang']['all_article']; ?></th>
            <th><?php echo $this->_var['lang']['handler']; ?></th>
            <th><?php echo $this->_var['lang']['goods_article']; ?></th>
          </tr>
          <tr>
            <td width="45%">
              <select name="source_select3" size="20" style="width:100%" multiple ondblclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)">
              </select>
            </td>
            <td align="center">
              <p><input type="button" value=">>" onclick="sz3.addItem(true, 'add_goods_article', goodsId, this.form.elements['price2'].value)" class="button" /></p>
              <p><input type="button" value=">" onclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)" class="button" /></p>
              <p><input type="button" value="<" onclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" class="button" /></p>
              <p><input type="button" value="<<" onclick="sz3.dropItem(true, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" class="button" /></p>
            </td>
            <td width="45%">
              <select name="target_select3" size="20" style="width:100%" multiple ondblclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)">
                <?php $_from = $this->_var['goods_article_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_article');if (count($_from)):
    foreach ($_from AS $this->_var['goods_article']):
?>
                <option value="<?php echo $this->_var['goods_article']['article_id']; ?>"><?php echo $this->_var['goods_article']['title']; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
            </td>
          </tr>
        </table>

        <div class="button-div">
          <input type="hidden" name="goods_id" value="<?php echo $this->_var['goods']['goods_id']; ?>" />
          <?php if ($this->_var['code'] != ''): ?>
          <input type="hidden" name="extension_code" value="<?php echo $this->_var['code']; ?>" />
          <?php endif; ?>
          <input type="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" onclick="validate('<?php echo $this->_var['goods']['goods_id']; ?>')" />
          <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
        </div>
        <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
      </form>
    </div>
</div>
<!-- end goods form -->
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,tab.js')); ?>

<script language="JavaScript">
  var goodsId = '<?php echo $this->_var['goods']['goods_id']; ?>';
  var elements = document.forms['theForm'].elements;
  var sz1 = new SelectZone(1, elements['source_select1'], elements['target_select1']);
  var sz2 = new SelectZone(2, elements['source_select2'], elements['target_select2'], elements['price2']);
  var sz3 = new SelectZone(1, elements['source_select3'], elements['target_select3']);
  var marketPriceRate = <?php echo empty($this->_var['cfg']['market_price_rate']) ? '1' : $this->_var['cfg']['market_price_rate']; ?>;
  var integralPercent = <?php echo empty($this->_var['cfg']['integral_percent']) ? '0' : $this->_var['cfg']['integral_percent']; ?>;

  
  onload = function()
  {
      handlePromote(document.forms['theForm'].elements['is_promote'].checked);

      if (document.forms['theForm'].elements['auto_thumb'])
      {
          handleAutoThumb(document.forms['theForm'].elements['auto_thumb'].checked);
      }

      // 妫€鏌ユ柊璁㈠崟
      startCheckOrder();
      
      <?php $_from = $this->_var['user_rank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
      set_price_note(<?php echo $this->_var['item']['rank_id']; ?>);
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      document.forms['theForm'].reset();
  }

  function validate(goods_id)
  {
      var validator = new Validator('theForm');
      var goods_sn  = document.forms['theForm'].elements['goods_sn'].value;

      validator.required('goods_name', goods_name_not_null);
      if (document.forms['theForm'].elements['cat_id'].value == 0)
      {
          validator.addErrorMsg(goods_cat_not_null);
      }

      checkVolumeData("1",validator);

      validator.required('shop_price', shop_price_not_null);
      validator.isNumber('shop_price', shop_price_not_number, true);
      validator.isNumber('market_price', market_price_not_number, false);
      if (document.forms['theForm'].elements['is_promote'].checked)
      {
          validator.required('promote_start_date', promote_start_not_null);
          validator.required('promote_end_date', promote_end_not_null);
          validator.islt('promote_start_date', 'promote_end_date', promote_not_lt);
      }

      if (document.forms['theForm'].elements['goods_number'] != undefined)
      {
          validator.isInt('goods_number', goods_number_not_int, false);
          validator.isInt('warn_number', warn_number_not_int, false);
      }

      var callback = function(res)
     {
      if (res.error > 0)
      {
        alert("<?php echo $this->_var['lang']['goods_sn_exists']; ?>");
      }
      else
      {
         if(validator.passed())
         {
         document.forms['theForm'].submit();
         }
      }
  }
    Ajax.call('goods.php?is_ajax=1&act=check_goods_sn', "goods_sn=" + goods_sn + "&goods_id=" + goods_id, callback, "GET", "JSON");
}

  /**
   * 鍒囨崲鍟嗗搧绫诲瀷
   */
  function getAttrList(goodsId)
  {
      var selGoodsType = document.forms['theForm'].elements['goods_type'];

      if (selGoodsType != undefined)
      {
          var goodsType = selGoodsType.options[selGoodsType.selectedIndex].value;

          Ajax.call('goods.php?is_ajax=1&act=get_attr', 'goods_id=' + goodsId + "&goods_type=" + goodsType, setAttrList, "GET", "JSON");
      }
  }

  function setAttrList(result, text_result)
  {
    document.getElementById('tbody-goodsAttr').innerHTML = result.content;
  }

  /**
   * 鎸夋瘮渚嬭?绠椾环鏍
   * @param   string  inputName   杈撳叆妗嗗悕绉
   * @param   float   rate        姣斾緥
   * @param   string  priceName   浠锋牸杈撳叆妗嗗悕绉帮紙濡傛灉娌℃湁锛屽彇shop_price锛
   */
  function computePrice(inputName, rate, priceName)
  {
      var shopPrice = priceName == undefined ? document.forms['theForm'].elements['shop_price'].value : document.forms['theForm'].elements[priceName].value;
      shopPrice = Utils.trim(shopPrice) != '' ? parseFloat(shopPrice)* rate : 0;
      if(inputName == 'integral')
      {
          shopPrice = parseInt(shopPrice);
      }
      shopPrice += "";

      n = shopPrice.lastIndexOf(".");
      if (n > -1)
      {
          shopPrice = shopPrice.substr(0, n + 3);
      }

      if (document.forms['theForm'].elements[inputName] != undefined)
      {
          document.forms['theForm'].elements[inputName].value = shopPrice;
      }
      else
      {
          document.getElementById(inputName).value = shopPrice;
      }
  }

  /**
   * 璁剧疆浜嗕竴涓?晢鍝佷环鏍硷紝鏀瑰彉甯傚満浠锋牸銆佺Н鍒嗕互鍙婁細鍛樹环鏍
   */
  function priceSetted()
  {
    computePrice('market_price', marketPriceRate);
    computePrice('integral', integralPercent / 100);
    
    <?php $_from = $this->_var['user_rank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    set_price_note(<?php echo $this->_var['item']['rank_id']; ?>);
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
  }

  /**
   * 璁剧疆浼氬憳浠锋牸娉ㄩ噴
   */
  function set_price_note(rank_id)
  {
    var shop_price = parseFloat(document.forms['theForm'].elements['shop_price'].value);

    var rank = new Array();
    
    <?php $_from = $this->_var['user_rank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    rank[<?php echo $this->_var['item']['rank_id']; ?>] = <?php echo empty($this->_var['item']['discount']) ? '100' : $this->_var['item']['discount']; ?>;
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    if (shop_price >0 && rank[rank_id] && document.getElementById('rank_' + rank_id) && parseInt(document.getElementById('rank_' + rank_id).value) == -1)
    {
      var price = parseInt(shop_price * rank[rank_id] + 0.5) / 100;
      if (document.getElementById('nrank_' + rank_id))
      {
        document.getElementById('nrank_' + rank_id).innerHTML = '(' + price + ')';
      }
    }
    else
    {
      if (document.getElementById('nrank_' + rank_id))
      {
        document.getElementById('nrank_' + rank_id).innerHTML = '';
      }
    }
  }

  /**
   * 鏍规嵁甯傚満浠锋牸锛岃?绠楀苟鏀瑰彉鍟嗗簵浠锋牸銆佺Н鍒嗕互鍙婁細鍛樹环鏍
   */
  function marketPriceSetted()
  {
    computePrice('shop_price', 1/marketPriceRate, 'market_price');
    computePrice('integral', integralPercent / 100);
    
    <?php $_from = $this->_var['user_rank_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    set_price_note(<?php echo $this->_var['item']['rank_id']; ?>);
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
  }

  /**
   * 鏂板?涓€涓??鏍
   */
  function addSpec(obj)
  {
      var src   = obj.parentNode.parentNode;
      var idx   = rowindex(src);
      var tbl   = document.getElementById('attrTable');
      var row   = tbl.insertRow(idx + 1);
      var cell1 = row.insertCell(-1);
      var cell2 = row.insertCell(-1);
      var regx  = /<a([^>]+)<\/a>/i;

      cell1.className = 'label';
      cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
      cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
  }

  /**
   * 鍒犻櫎瑙勬牸鍊
   */
  function removeSpec(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('attrTable');

      tbl.deleteRow(row);
  }

  /**
   * 澶勭悊瑙勬牸
   */
  function handleSpec()
  {
      var elementCount = document.forms['theForm'].elements.length;
      for (var i = 0; i < elementCount; i++)
      {
          var element = document.forms['theForm'].elements[i];
          if (element.id.substr(0, 5) == 'spec_')
          {
              var optCount = element.options.length;
              var value = new Array(optCount);
              for (var j = 0; j < optCount; j++)
              {
                  value[j] = element.options[j].value;
              }

              var hiddenSpec = document.getElementById('hidden_' + element.id);
              hiddenSpec.value = value.join(String.fromCharCode(13)); // 鐢ㄥ洖杞﹂敭闅斿紑姣忎釜瑙勬牸
          }
      }
      return true;
  }

  function handlePromote(checked)
  {
      document.forms['theForm'].elements['promote_price'].disabled = !checked;
      document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      document.forms['theForm'].elements['selbtn2'].disabled = !checked;
  }

  function handleAutoThumb(checked)
  {
      document.forms['theForm'].elements['goods_thumb'].disabled = checked;
      document.forms['theForm'].elements['goods_thumb_url'].disabled = checked;
  }

  /**
   * 蹇?€熸坊鍔犲搧鐗
   */
  function rapidBrandAdd(conObj)
  {
      var brand_div = document.getElementById("brand_add");

      if(brand_div.style.display != '')
      {
          var brand =document.forms['theForm'].elements['addedBrandName'];
          brand.value = '';
          brand_div.style.display = '';
      }
  }

  function hideBrandDiv()
  {
      var brand_add_div = document.getElementById("brand_add");
      if(brand_add_div.style.display != 'none')
      {
          brand_add_div.style.display = 'none';
      }
  }

  function goBrandPage()
  {
      if(confirm(go_brand_page))
      {
          window.location.href='brand.php?act=add';
      }
      else
      {
          return;
      }
  }

  function rapidCatAdd()
  {
      var cat_div = document.getElementById("category_add");

      if(cat_div.style.display != '')
      {
          var cat =document.forms['theForm'].elements['addedCategoryName'];
          cat.value = '';
          cat_div.style.display = '';
      }
  }

  function addBrand()
  {
      var brand = document.forms['theForm'].elements['addedBrandName'];
      if(brand.value.replace(/^\s+|\s+$/g, '') == '')
      {
          alert(brand_cat_not_null);
          return;
      }

      var params = 'brand=' + brand.value;
      Ajax.call('brand.php?is_ajax=1&act=add_brand', params, addBrandResponse, 'GET', 'JSON');
  }

  function addBrandResponse(result)
  {
      if (result.error == '1' && result.message != '')
      {
          alert(result.message);
          return;
      }

      var brand_div = document.getElementById("brand_add");
      brand_div.style.display = 'none';

      var response = result.content;

      var selCat = document.forms['theForm'].elements['brand_id'];
      var opt = document.createElement("OPTION");
      opt.value = response.id;
      opt.selected = true;
      opt.text = response.brand;

      if (Browser.isIE)
      {
          selCat.add(opt);
      }
      else
      {
          selCat.appendChild(opt);
      }

      return;
  }

  function addCategory()
  {
      var parent_id = document.forms['theForm'].elements['cat_id'];
      var cat = document.forms['theForm'].elements['addedCategoryName'];
      if(cat.value.replace(/^\s+|\s+$/g, '') == '')
      {
          alert(category_cat_not_null);
          return;
      }

      var params = 'parent_id=' + parent_id.value;
      params += '&cat=' + cat.value;
      Ajax.call('category.php?is_ajax=1&act=add_category', params, addCatResponse, 'GET', 'JSON');
  }

  function hideCatDiv()
  {
      var category_add_div = document.getElementById("category_add");
      if(category_add_div.style.display != null)
      {
          category_add_div.style.display = 'none';
      }
  }

  function addCatResponse(result)
  {
      if (result.error == '1' && result.message != '')
      {
          alert(result.message);
          return;
      }

      var category_add_div = document.getElementById("category_add");
      category_add_div.style.display = 'none';

      var response = result.content;

      var selCat = document.forms['theForm'].elements['cat_id'];
      var opt = document.createElement("OPTION");
      opt.value = response.id;
      opt.selected = true;
      opt.innerHTML = response.cat;

      //鑾峰彇瀛愬垎绫荤殑绌烘牸鏁
      var str = selCat.options[selCat.selectedIndex].text;
      var temp = str.replace(/^\s+/g, '');
      var lengOfSpace = str.length - temp.length;
      if(response.parent_id != 0)
      {
          lengOfSpace += 4;
      }
      for (i = 0; i < lengOfSpace; i++)
      {
          opt.innerHTML = '&nbsp;' + opt.innerHTML;
      }

      for (i = 0; i < selCat.length; i++)
      {
          if(selCat.options[i].value == response.parent_id)
          {
              if(i == selCat.length)
              {
                  if (Browser.isIE)
                  {
                      selCat.add(opt);
                  }
                  else
                  {
                      selCat.appendChild(opt);
                  }
              }
              else
              {
                  selCat.insertBefore(opt, selCat.options[i + 1]);
              }
              //opt.selected = true;
              break;
          }

      }

      return;
  }

    function goCatPage()
    {
        if(confirm(go_category_page))
        {
            window.location.href='category.php?act=add';
        }
        else
        {
            return;
        }
    }


  /**
   * 鍒犻櫎蹇?€熷垎绫
   */
  function removeCat()
  {
      if(!document.forms['theForm'].elements['parent_cat'] || !document.forms['theForm'].elements['new_cat_name'])
      {
          return;
      }

      var cat_select = document.forms['theForm'].elements['parent_cat'];
      var cat = document.forms['theForm'].elements['new_cat_name'];

      cat.parentNode.removeChild(cat);
      cat_select.parentNode.removeChild(cat_select);
  }

  /**
   * 鍒犻櫎蹇?€熷搧鐗
   */
  function removeBrand()
  {
      if (!document.forms['theForm'].elements['new_brand_name'])
      {
          return;
      }

      var brand = document.theForm.new_brand_name;
      brand.parentNode.removeChild(brand);
  }

  /**
   * 娣诲姞鎵╁睍鍒嗙被
   */
  function addOtherCat(conObj)
  {
      var sel = document.createElement("SELECT");
      var selCat = document.forms['theForm'].elements['cat_id'];

      for (i = 0; i < selCat.length; i++)
      {
          var opt = document.createElement("OPTION");
          opt.text = selCat.options[i].text;
          opt.value = selCat.options[i].value;
          if (Browser.isIE)
          {
              sel.add(opt);
          }
          else
          {
              sel.appendChild(opt);
          }
      }
      conObj.appendChild(sel);
      sel.name = "other_cat[]";
      sel.onChange = function() {checkIsLeaf(this);};
  }

  /* 鍏宠仈鍟嗗搧鍑芥暟 */
  function searchGoods(szObject, catId, brandId, keyword)
  {
      var filters = new Object;

      filters.cat_id = elements[catId].value;
      filters.brand_id = elements[brandId].value;
      filters.keyword = Utils.trim(elements[keyword].value);
      filters.exclude = document.forms['theForm'].elements['goods_id'].value;

      szObject.loadOptions('get_goods_list', filters);
  }

  /**
   * 鍏宠仈鏂囩珷鍑芥暟
   */
  function searchArticle()
  {
    var filters = new Object;

    filters.title = Utils.trim(elements['article_title'].value);

    sz3.loadOptions('get_article_list', filters);
  }

  /**
   * 鏂板?涓€涓?浘鐗
   */
  function addImg(obj)
  {
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  }

  /**
   * 鍒犻櫎鍥剧墖涓婁紶
   */
  function removeImg(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');

      tbl.deleteRow(row);
  }

  /**
   * 鍒犻櫎鍥剧墖
   */
  function dropImg(imgId)
  {
    Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  }

  function dropImgResponse(result)
  {
      if (result.error == 0)
      {
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  }

  /**
   * 灏嗗競鍦轰环鏍煎彇鏁
   */
  function integral_market_price()
  {
    document.forms['theForm'].elements['market_price'].value = parseInt(document.forms['theForm'].elements['market_price'].value);
  }

   /**
   * 灏嗙Н鍒嗚喘涔伴?搴﹀彇鏁
   */
  function parseint_integral()
  {
    document.forms['theForm'].elements['integral'].value = parseInt(document.forms['theForm'].elements['integral'].value);
  }


  /**
  * 妫€鏌ヨ揣鍙锋槸鍚﹀瓨鍦
  */
  function checkGoodsSn(goods_sn, goods_id)
  {
    if (goods_sn == '')
    {
        document.getElementById('goods_sn_notice').innerHTML = "";
        return;
    }

    var callback = function(res)
    {
      if (res.error > 0)
      {
        document.getElementById('goods_sn_notice').innerHTML = res.message;
        document.getElementById('goods_sn_notice').style.color = "red";
      }
      else
      {
        document.getElementById('goods_sn_notice').innerHTML = "";
      }
    }
    Ajax.call('goods.php?is_ajax=1&act=check_goods_sn', "goods_sn=" + goods_sn + "&goods_id=" + goods_id, callback, "GET", "JSON");
  }

  /**
   * 鏂板?涓€涓?紭鎯犱环鏍
   */
  function addVolumePrice(obj)
  {
    var src      = obj.parentNode.parentNode;
    var tbl      = document.getElementById('tbody-volume');

    var validator  = new Validator('theForm');
    checkVolumeData("0",validator);
    if (!validator.passed())
    {
      return false;
    }

    var row  = tbl.insertRow(tbl.rows.length);
    var cell = row.insertCell(-1);
    cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addVolumePrice)(.*)(\[)(\+)/i, "$1removeVolumePrice$3$4-");

    var number_list = document.getElementsByName("volume_number[]");
    var price_list  = document.getElementsByName("volume_price[]");

    number_list[number_list.length-1].value = "";
    price_list[price_list.length-1].value   = "";
  }

  /**
   * 鍒犻櫎浼樻儬浠锋牸
   */
  function removeVolumePrice(obj)
  {
    var row = rowindex(obj.parentNode.parentNode);
    var tbl = document.getElementById('tbody-volume');

    tbl.deleteRow(row);
  }

  /**
   * 鏍￠獙浼樻儬鏁版嵁鏄?惁姝ｇ‘
   */
  function checkVolumeData(isSubmit,validator)
  {
    var volumeNum = document.getElementsByName("volume_number[]");
    var volumePri = document.getElementsByName("volume_price[]");
    var numErrNum = 0;
    var priErrNum = 0;

    for (i = 0 ; i < volumePri.length ; i ++)
    {
      if ((isSubmit != 1 || volumeNum.length > 1) && numErrNum <= 0 && volumeNum.item(i).value == "")
      {
        validator.addErrorMsg(volume_num_not_null);
        numErrNum++;
      }

      if (numErrNum <= 0 && Utils.trim(volumeNum.item(i).value) != "" && ! Utils.isNumber(Utils.trim(volumeNum.item(i).value)))
      {
        validator.addErrorMsg(volume_num_not_number);
        numErrNum++;
      }

      if ((isSubmit != 1 || volumePri.length > 1) && priErrNum <= 0 && volumePri.item(i).value == "")
      {
        validator.addErrorMsg(volume_price_not_null);
        priErrNum++;
      }

      if (priErrNum <= 0 && Utils.trim(volumePri.item(i).value) != "" && ! Utils.isNumber(Utils.trim(volumePri.item(i).value)))
      {
        validator.addErrorMsg(volume_price_not_number);
        priErrNum++;
      }
    }
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
