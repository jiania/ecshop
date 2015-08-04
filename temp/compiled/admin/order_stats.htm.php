<!-- $Id: order_stats.htm 16420 2009-07-02 06:56:57Z liubo $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="main-div">
  <p style="margin: 10px">
    <strong><?php echo $this->_var['lang']['overall_sum']; ?></strong>:&nbsp;&nbsp;<?php echo $this->_var['total_turnover']; ?>&nbsp;&nbsp;&nbsp;
    <strong><?php echo $this->_var['lang']['overall_choose']; ?></strong>:&nbsp;&nbsp;<?php echo $this->_var['click_count']; ?>&nbsp;&nbsp;&nbsp;
    <strong><?php echo $this->_var['lang']['kilo_buy_amount']; ?></strong>:&nbsp;&nbsp;<?php echo $this->_var['click_ordernum']; ?>&nbsp;&nbsp;&nbsp;
    <strong><?php echo $this->_var['lang']['kilo_buy_sum']; ?></strong>:&nbsp;&nbsp;<?php echo $this->_var['click_turnover']; ?>
  </p>
</div>

<div class="form-div">
  <form action="" method="post" id="selectForm" name="selectForm">
    <?php echo $this->_var['lang']['start_date']; ?>&nbsp;&nbsp;
    <input name="start_date" value="<?php echo $this->_var['start_date']; ?>" style="width:80px;" onclick="return showCalendar(this, '%Y-%m-%d', false, false, this);" />
    <?php echo $this->_var['lang']['end_date']; ?>&nbsp;&nbsp;
    <input name="end_date" value="<?php echo $this->_var['end_date']; ?>" style="width:80px;" onclick="return showCalendar(this, '%Y-%m-%d', false, false, this);" />
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
    <form action="" method="post" id="selectForm" name="selectForm">
    <?php echo $this->_var['lang']['select_year_month']; ?>&nbsp;&nbsp;
    <!--<?php $_from = $this->_var['start_date_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'start_date_0_29972000_1438679123');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['start_date_0_29972000_1438679123']):
?>-->
    <?php if ($this->_var['k'] > 0): ?>
    &nbsp;+&nbsp;
    <?php endif; ?>
    <input name="year_month[]" value="<?php echo $this->_var['start_date_0_29972000_1438679123']; ?>" style="width:60px;" onclick="return showCalendar(this, '%Y-%m', false, false, this);" /> 
    <!--<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>--><input type="hidden" name="is_multi" value="1" />
    <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>
<div class="tab-div">
 <div id="tabbar-div">
    <p>
      <span class="tab-front" id="order_circs-tab"><?php echo $this->_var['lang']['order_circs']; ?></span><span
      class="tab-back" id="shipping-tab"><?php echo $this->_var['lang']['shipping_method']; ?></span><span
      class="tab-back" id="pay-tab"><?php echo $this->_var['lang']['pay_method']; ?></span>
    </p>
 </div>
 <div id="tabbody-div">
    <table width="90%" cellspacing="0" cellpadding="3" id="order_circs-table">
      <tr>
        <td align="center">
        <?php if ($this->_var['is_multi'] == '0'): ?>
        <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" id="OrderGeneral" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['order_general_xml']; ?>">
          <PARAM NAME="movie" VALUE="images/charts/pie3d.swf?chartWidth=650&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <PARAM NAME=bgcolor VALUE="#FFFFFF">
          <param name="wmode" value="opaque" />
          <EMBED src="images/charts/pie3d.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['order_general_xml']; ?>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" wmode="opaque" NAME="OrderGeneral" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
          </OBJECT>
        <?php else: ?>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
              codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['order_general_xml']; ?>">
              <PARAM NAME=movie VALUE="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param name="wmode" value="opaque" />
              <embed src="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['order_general_xml']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
            </object>
    <?php endif; ?>
        </td>
      </tr>
    </table>
    <table width="90%" cellspacing="0" cellpadding="3" id="shipping-table" style="display:none">
      <tr>
        <td align="center">
        <?php if ($this->_var['is_multi'] == '0'): ?>
          <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" id="ShipType" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['ship_xml']; ?>">
          <PARAM NAME="movie" VALUE="images/charts/pie3d.swf?chartWidth=650&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <param name="wmode" value="opaque" />
          <PARAM NAME="bgcolor" VALUE="#FFFFFF">
          <EMBED src="images/charts/pie3d.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['ship_xml']; ?>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" NAME="ShipType" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" wmode="opaque"></EMBED>
          </OBJECT>
        <?php else: ?>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
              codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['ship_xml']; ?>">
              <PARAM NAME=movie VALUE="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param name="wmode" value="opaque" />
              <embed src="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['ship_xml']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
            </object>
        <?php endif; ?>
        </td>
      </tr>
    </table>
    <table width="90%" cellspacing="0" cellpadding="3" id="pay-table" style="display:none">
      <tr>
        <td align="center">
        <?php if ($this->_var['is_multi'] == '0'): ?>
          <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" id="PayMethod" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['pay_xml']; ?>">
          <PARAM NAME="movie" VALUE="images/charts/pie3d.swf?chartWidth=650&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <PARAM NAME="bgcolor" VALUE="#FFFFFF">
          <param name="wmode" value="opaque" />
          <EMBED src="images/charts/pie3d.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['pay_xml']; ?>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" NAME="PayMethod" wmode="opaque" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
        </OBJECT>
    <?php else: ?>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['pay_xml']; ?>">
              <PARAM NAME=movie VALUE="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param name="wmode" value="opaque" />
              <embed src="images/charts/MSColumn3D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['pay_xml']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></object>
    <?php endif; ?>
        </td>
      </tr>
    </table>
 </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'tab.js')); ?>
<script language="JavaScript">
onload = function()
{
    // 开始检查订单
  startCheckOrder();
}
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>