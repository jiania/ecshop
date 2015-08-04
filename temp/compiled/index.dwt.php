<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,index.js')); ?>
</head>
<body>

<div class="blank"></div>
<div class="block clearfix">
  
  <div class="AreaL">
    
    <div class="box">
     <div class="box_1">
      <h3><span><?php echo $this->_var['lang']['shop_notice']; ?></span></h3>
      <div class="boxCenterList RelaArticle">
        <?php echo $this->_var['shop_notice']; ?>
      </div>
     </div>
    </div>
    <div class="blank5"></div>
    
  


<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
<div class="cart" id="ECS_CARTINFO">
 <?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
</div>
<div class="blank5"></div>

 


<div class="box">
 <div class="box_1">
  <div id="category_tree">
    <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
     <dl>
     <dt><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></dt>
     <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
     <dd><a href="<?php echo $this->_var['child']['url']; ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></dd>
       <?php $_from = $this->_var['child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'childer');if (count($_from)):
    foreach ($_from AS $this->_var['childer']):
?>
       <dd>&nbsp;&nbsp;<a href="<?php echo $this->_var['childer']['url']; ?>"><?php echo htmlspecialchars($this->_var['childer']['name']); ?></a></dd>
       <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
       
       </dl>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
  </div>
 </div>
</div>
<div class="blank5"></div>

 


<div class="box">
 <div class="box_2">
  <div class="top10Tit"></div>
  <div class="top10List clearfix">
  <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['top_goods']['iteration']++;
?>
  <ul class="clearfix">
	<img src="themes/default/images/top_<?php echo $this->_foreach['top_goods']['iteration']; ?>.gif" class="iteration" />
	<?php if ($this->_foreach['top_goods']['iteration'] < 4): ?>
      <li class="topimg">
      <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="samllimg" /></a>
      </li>
	<?php endif; ?>		
      <li <?php if ($this->_foreach['top_goods']['iteration'] < 4): ?>class="iteration1"<?php endif; ?>>
      <a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_name']; ?></a><br />
      <?php echo $this->_var['lang']['shop_price']; ?><font class="f1"><?php echo $this->_var['goods']['price']; ?></font><br />
      </li>
    </ul>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
 </div>
</div>
<div class="blank5"></div>

 


<?php if ($this->_var['promotion_info']): ?>

<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['promotion_info']; ?></span></h3>
  <div class="boxCenterList RelaArticle">
    <?php $_from = $this->_var['promotion_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    <?php if ($this->_var['item']['type'] == "snatch"): ?>
    <a href="snatch.php" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?>"><?php echo $this->_var['lang']['snatch_promotion']; ?></a>
    <?php elseif ($this->_var['item']['type'] == "group_buy"): ?>
    <a href="group_buy.php" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?>"><?php echo $this->_var['lang']['group_promotion']; ?></a>
    <?php elseif ($this->_var['item']['type'] == "auction"): ?>
    <a href="auction.php" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?>"><?php echo $this->_var['lang']['auction_promotion']; ?></a>
    <?php elseif ($this->_var['item']['type'] == "favourable"): ?>
    <a href="activity.php" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?>"><?php echo $this->_var['lang']['favourable_promotion']; ?></a>
    <?php endif; ?>
    <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?> <?php echo $this->_var['item']['act_name']; ?><?php echo $this->_var['item']['time']; ?>" style="background:none; padding-left:0px;"><?php echo $this->_var['item']['act_name']; ?></a><br />
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
 </div>
</div>
<div class="blank5"></div>
<?php endif; ?>
 


<?php if (empty ( $this->_var['order_query'] )): ?>
<script>var invalid_order_sn = "<?php echo $this->_var['lang']['invalid_order_sn']; ?>"</script>
<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['order_query']; ?></span></h3>
  <div class="boxCenterList">
    <form name="ecsOrderQuery">
    <input type="text" name="order_sn" class="inputBg" /><br />
    <div class="blank5"></div>
    <input type="button" value="<?php echo $this->_var['lang']['query_order']; ?>" class="bnt_blue_2" onclick="orderQuery()" />
    </form>
    <div id="ECS_ORDER_QUERY" style="margin-top:8px;">
      <?php else: ?>
      <?php if ($this->_var['order_query']['user_id']): ?>
<b><?php echo $this->_var['lang']['order_number']; ?>：</b><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['order_query']['order_id']; ?>" class="f6"><?php echo $this->_var['order_query']['order_sn']; ?></a><br>
  <?php else: ?>
<b><?php echo $this->_var['lang']['order_number']; ?>：</b><?php echo $this->_var['order_query']['order_sn']; ?><br>
  <?php endif; ?>
<b><?php echo $this->_var['lang']['order_status']; ?>：</b><br><font class="f1"><?php echo $this->_var['order_query']['order_status']; ?></font><br>
  <?php if ($this->_var['order_query']['invoice_no']): ?>
<b><?php echo $this->_var['lang']['consignment']; ?>：</b><?php echo $this->_var['order_query']['invoice_no']; ?><br>
  <?php endif; ?>
      <?php if ($this->_var['order_query']['shipping_date']): ?>：<?php echo $this->_var['lang']['shipping_date']; ?> <?php echo $this->_var['order_query']['shipping_date']; ?><br>
  <?php endif; ?>
  <?php endif; ?>
    </div>
  </div>
 </div>
</div>
<div class="blank5"></div>

 


<?php if ($this->_var['invoice_list']): ?>
<style type="text/css">
.boxCenterList form{display:inline;}
.boxCenterList form a{color:#404040; text-decoration:underline;}
</style>
<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['shipping_query']; ?></span></h3>
  <div class="boxCenterList">
    <?php $_from = $this->_var['invoice_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'invoice');if (count($_from)):
    foreach ($_from AS $this->_var['invoice']):
?>
   <?php echo $this->_var['lang']['order_number']; ?> <?php echo $this->_var['invoice']['order_sn']; ?><br />
   <?php echo $this->_var['lang']['consignment']; ?> <?php echo $this->_var['invoice']['invoice_no']; ?>
   <div class="blank"></div>
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
 </div>
</div>
<div class="blank5"></div>
<?php endif; ?>
 


<?php 
$k = array (
  'name' => 'vote',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
 


<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['email_subscribe']; ?></span></h3>
  <div class="boxCenterList RelaArticle">
    <input type="text" id="user_email" class="inputBg" /><br />
    <div class="blank5"></div>
    <input type="button" class="bnt_blue" value="<?php echo $this->_var['lang']['email_list_ok']; ?>" onclick="add_email_list();" />
    <input type="button" class="bnt_bonus"  value="<?php echo $this->_var['lang']['email_list_cancel']; ?>" onclick="cancel_email_list();" />
  </div>
 </div>
</div>
<div class="blank5"></div>
<script type="text/javascript">
var email = document.getElementById('user_email');
function add_email_list()
{
  if (check_email())
  {
    Ajax.call('user.php?act=email_list&job=add&email=' + email.value, '', rep_add_email_list, 'GET', 'TEXT');
  }
}
function rep_add_email_list(text)
{
  alert(text);
}
function cancel_email_list()
{
  if (check_email())
  {
    Ajax.call('user.php?act=email_list&job=del&email=' + email.value, '', rep_cancel_email_list, 'GET', 'TEXT');
  }
}
function rep_cancel_email_list(text)
{
  alert(text);
}
function check_email()
{
  if (Utils.isEmail(email.value))
  {
    return true;
  }
  else
  {
    alert('<?php echo $this->_var['lang']['email_invalid']; ?>');
    return false;
  }
}
</script>

 


  </div>
  
  
  <div class="AreaR">
   
    <div class="box clearfix">
     <div class="box_1 clearfix">
       <div class="f_l" id="focus">
       
       </div>
       
       <div id="mallNews" class="f_r">
        <div class="NewsTit"></div>
        <div class="NewsList tc">
         

        
        </div>
       </div>
       
     </div>
    </div>
    <div class="blank5"></div>
   
   
    <div class="clearfix">
      
      
      
      <div class="box f_r brandsIe6">
       <div class="box_1 clearfix" id="brands">
        
       </div>
      </div>
    </div>
    <div class="blank5"></div>
   


<?php if ($this->_var['best_goods']): ?>
<?php if ($this->_var['cat_rec_sign'] != 1): ?>
<div class="box">
<div class="box_2 centerPadd">
  <div class="itemTit" id="itemBest">
      <?php if ($this->_var['cat_rec'] [ 1 ]): ?>
      <h2><a href="javascript:void(0)" onclick="change_tab_style('itemBest', 'h2', this);get_cat_recommend(1, 0);"><?php echo $this->_var['lang']['all_goods']; ?></a></h2>
      <?php $_from = $this->_var['cat_rec']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rec_data');if (count($_from)):
    foreach ($_from AS $this->_var['rec_data']):
?>
      <h2 class="h2bg"><a href="javascript:void(0)" onclick="change_tab_style('itemBest', 'h2', this);get_cat_recommend(1, <?php echo $this->_var['rec_data']['cat_id']; ?>)"><?php echo $this->_var['rec_data']['cat_name']; ?></a></h2>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>
  </div>
  <div id="show_best_area" class="clearfix goodsBox">
  <?php endif; ?>
  <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <div class="goodsItem">
         <span class="best"></span>
           <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="goodsimg" /></a><br />
           <p><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></p>
           <font class="f1">
           <?php if ($this->_var['goods']['promote_price'] != ""): ?>
          <?php echo $this->_var['goods']['promote_price']; ?>
          <?php else: ?>
          <?php echo $this->_var['goods']['shop_price']; ?>
          <?php endif; ?>
           </font>
        </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <div class="more"><a href="search.php?intro=best"><img src="themes/default/images/more.gif" /></a></div>
  <?php if ($this->_var['cat_rec_sign'] != 1): ?>
  </div>
</div>
</div>
<div class="blank5"></div>
  <?php endif; ?>
<?php endif; ?>

 


<?php if ($this->_var['new_goods']): ?>
<?php if ($this->_var['cat_rec_sign'] != 1): ?>
<div class="box">
<div class="box_2 centerPadd">
  <div class="itemTit New" id="itemNew">
      <?php if ($this->_var['cat_rec'] [ 2 ]): ?>
      <h2><a href="javascript:void(0)" onclick="change_tab_style('itemNew', 'h2', this);get_cat_recommend(2, 0);"><?php echo $this->_var['lang']['all_goods']; ?></a></h2>
      <?php $_from = $this->_var['cat_rec']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rec_data');if (count($_from)):
    foreach ($_from AS $this->_var['rec_data']):
?>
      <h2 class="h2bg"><a href="javascript:void(0)" onclick="change_tab_style('itemNew', 'h2', this);get_cat_recommend(2, <?php echo $this->_var['rec_data']['cat_id']; ?>)"><?php echo $this->_var['rec_data']['cat_name']; ?></a></h2>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>
  </div>
  <div id="show_new_area" class="clearfix goodsBox">
  <?php endif; ?>
  <?php $_from = $this->_var['new_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <div class="goodsItem">
         <span class="news"></span>
           <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="goodsimg" /></a><br />
           <p><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></p>
           <font class="f1">
           <?php if ($this->_var['goods']['promote_price'] != ""): ?>
          <?php echo $this->_var['goods']['promote_price']; ?>
          <?php else: ?>
          <?php echo $this->_var['goods']['shop_price']; ?>
          <?php endif; ?>
           </font>
        </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <div class="more"><a href="search.php?intro=new"><img src="themes/default/images/more.gif" /></a></div>
  <?php if ($this->_var['cat_rec_sign'] != 1): ?>
  </div>
</div>
</div>
<div class="blank5"></div>
  <?php endif; ?>
<?php endif; ?>

 


<?php if ($this->_var['hot_goods']): ?>
<?php if ($this->_var['cat_rec_sign'] != 1): ?>
<div class="box">
<div class="box_2 centerPadd">
  <div class="itemTit Hot" id="itemHot">
      <?php if ($this->_var['cat_rec'] [ 3 ]): ?>
      <h2><a href="javascript:void(0)" onclick="change_tab_style('itemHot', 'h2', this);get_cat_recommend(3, 0);"><?php echo $this->_var['lang']['all_goods']; ?></a></h2>
      <?php $_from = $this->_var['cat_rec']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rec_data');if (count($_from)):
    foreach ($_from AS $this->_var['rec_data']):
?>
      <h2 class="h2bg"><a href="javascript:void(0)" onclick="change_tab_style('itemHot', 'h2', this);get_cat_recommend(3, <?php echo $this->_var['rec_data']['cat_id']; ?>)"><?php echo $this->_var['rec_data']['cat_name']; ?></a></h2>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>
  </div>
  <div id="show_hot_area" class="clearfix goodsBox">
  <?php endif; ?>
  <?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <div class="goodsItem">
         <span class="hot"></span>
           <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="goodsimg" /></a><br />
           <p><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></p>
           <font class="f1">
           <?php if ($this->_var['goods']['promote_price'] != ""): ?>
          <?php echo $this->_var['goods']['promote_price']; ?>
          <?php else: ?>
          <?php echo $this->_var['goods']['shop_price']; ?>
          <?php endif; ?>
           </font>
        </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <div class="more"><a href="search.php?intro=hot"><img src="themes/default/images/more.gif" /></a></div>
  <?php if ($this->_var['cat_rec_sign'] != 1): ?>
  </div>
</div>
</div>
<div class="blank5"></div>
  <?php endif; ?>
<?php endif; ?>

 


<?php if ($this->_var['auction_list']): ?>
<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['auction_goods']; ?></span><a href="auction.php"><img src="themes/default/images/more.gif"></a></h3>
    <div class="centerPadd">
    <div class="clearfix goodsBox" style="border:none;">
      <?php $_from = $this->_var['auction_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'auction');if (count($_from)):
    foreach ($_from AS $this->_var['auction']):
?>
      <div class="goodsItem">
           <a href="<?php echo $this->_var['auction']['url']; ?>"><img src="<?php echo $this->_var['auction']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['auction']['goods_name']); ?>" class="goodsimg" /></a><br />
           <p><a href="<?php echo $this->_var['auction']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['auction']['goods_name']); ?>"><?php echo htmlspecialchars($this->_var['auction']['short_style_name']); ?></a></p>
           <font class="shop_s"><?php echo $this->_var['auction']['formated_start_price']; ?></font>
        </div>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    </div>
 </div>
</div>
<div class="blank5"></div>
<?php endif; ?>
 


<?php if ($this->_var['group_buy_goods']): ?>
<div class="box">
 <div class="box_1">
  <h3><span><?php echo $this->_var['lang']['group_buy_goods']; ?></span><a href="group_buy.php"><img src="themes/default/images/more.gif"></a></h3>
    <div class="centerPadd">
    <div class="clearfix goodsBox" style="border:none;">
      <?php $_from = $this->_var['group_buy_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
      <div class="goodsItem">
           <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" class="goodsimg" /></a><br />
					 <p><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"><?php echo htmlspecialchars($this->_var['goods']['short_style_name']); ?></a></p>
           <font class="shop_s"><?php echo $this->_var['goods']['last_price']; ?></font>
        </div>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    </div>
 </div>
</div>
<div class="blank5"></div>
<?php endif; ?>
 

  </div>
  
</div>
<div class="blank5"></div>

<div class="block">
  <div class="box">
   <div class="helpTitBg clearfix">
    
   </div>
  </div>
</div>
<div class="blank"></div>


<?php if ($this->_var['img_links'] || $this->_var['txt_links']): ?>
<div id="bottomNav" class="box">
 <div class="box_1">
  <div class="links clearfix">
    <?php $_from = $this->_var['img_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    <a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><img src="<?php echo $this->_var['link']['logo']; ?>" alt="<?php echo $this->_var['link']['name']; ?>" border="0" /></a>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['txt_links']): ?>
    <?php $_from = $this->_var['txt_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
    [<a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><?php echo $this->_var['link']['name']; ?></a>]
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php endif; ?>
  </div>
 </div>
</div>
<?php endif; ?>

<div class="blank"></div>

</body>
</html>
