<!-- $Id: sale_general.htm 16869 2009-12-10 10:31:14Z liuhui $ -->
<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_RunActiveContent.js" type="text/javascript"></script>

<?php echo $this->fetch('pageheader.htm'); ?>
<div class="form-div">
  <form action="sale_general.php?act=list" method="post">
  <strong><?php echo $this->_var['lang']['year_status']; ?></strong>
  <?php echo $this->html_select_date(array('prefix'=>'year_begin','time'=>$this->_var['start_time'],'start_year'=>'2006','end_year'=>'+1','display_days'=>'false','display_months'=>'false')); ?>
  -
  <?php echo $this->html_select_date(array('prefix'=>'year_end','time'=>$this->_var['end_time'],'start_year'=>'2006','end_year'=>'+1','display_days'=>'false','display_months'=>'false')); ?>
  <input type="submit" name="query_by_year" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  <br />
  <strong><?php echo $this->_var['lang']['month_status']; ?></strong>
  <?php echo $this->html_select_date(array('prefix'=>'month_begin','time'=>$this->_var['start_time'],'start_year'=>'2006','end_year'=>'+1','display_days'=>'false','field_order'=>'YMD','month_format'=>'%m')); ?>
  -
  <?php echo $this->html_select_date(array('prefix'=>'month_end','time'=>$this->_var['end_time'],'start_year'=>'2006','end_year'=>'+1','display_days'=>'false','field_order'=>'YMD','month_format'=>'%m')); ?>
  <input type="submit" name="query_by_month" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>

<div class="tab-div">
   <div id="tabbar-div">
      <p>
        <span class="tab-front" id="order-tab"><?php echo $this->_var['lang']['order_status']; ?></span><span
        class="tab-back" id="turnover-tab"><?php echo $this->_var['lang']['turnover_status']; ?></span>
      </p>
   </div>
   <div id="tabbody-div">
      <!-- 订单数量 -->
      <table width="90%" id="order-table">
        <tr><td align="center">
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
            width="565" height="420" id="FCColumn2" align="middle">
            <param NAME="movie" VALUE="images/charts/column3d.swf?dataXML=<?php echo $this->_var['data_count']; ?>">
            <param NAME="quality" VALUE="high">
            <param NAME="bgcolor" VALUE="#FFFFFF">
            <embed src="images/charts/column3d.swf?dataXML=<?php echo $this->_var['data_count']; ?>" quality="high" bgcolor="#FFFFFF"  width="565" height="420" name="FCColumn2" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
          </object>
          <div><?php echo $this->_var['data_count_name']; ?></div>
        </td></tr>
      </table>

      <!-- 营业额 -->
      <table width="90%" id="turnover-table" style="display:none">
        <tr><td align="center">
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
            width="565" height="420" id="FCColumn2" align="middle">
            <param NAME="movie" VALUE="images/charts/column3d.swf?dataXML=<?php echo $this->_var['data_amount']; ?>">
            <param NAME="quality" VALUE="high">
            <param NAME="bgcolor" VALUE="#FFFFFF">
            <embed src="images/charts/column3d.swf?dataXML=<?php echo $this->_var['data_amount']; ?>" quality="high" bgcolor="#FFFFFF"  width="565" height="420" name="FCColumn2" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
          </object>
          <div><?php echo $this->_var['data_amount_name']; ?></div>
        </td></tr>
      </table>
    </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'tab.js')); ?>
<script language="JavaScript">
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>