<!-- $Id: searchengine_stats.htm 16420 2009-07-02 06:56:57Z liubo $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="form-div">
  <form action="" method="post" id="selectForm">
     <div id="group">
       <?php echo $this->_var['lang']['start_date']; ?>&nbsp;&nbsp;
       <input name="start_date" value="<?php echo $this->_var['start_date']; ?>" style="width:80px;" onclick="return showCalendar(this, '%Y-%m-%d', false, false, this);" />
       <?php echo $this->_var['lang']['end_date']; ?>&nbsp;&nbsp;
       <input name="end_date" value="<?php echo $this->_var['end_date']; ?>" style="width:80px;" onclick="return showCalendar(this, '%Y-%m-%d', false, false, this);" /> 
       <br><?php echo $this->_var['lang']['result_filter']; ?>&nbsp;
        <?php $_from = $this->_var['searchengines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sename', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['sename'] => $this->_var['val']):
?>
        <label><input type="checkbox" value="<?php echo $this->_var['sename']; ?>" name="filter[]" <?php if ($this->_var['val']): ?>checked<?php endif; ?>><?php echo $this->_var['sename']; ?></label>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <input type="submit" name="submit" value="<?php echo $this->_var['lang']['query']; ?>" class="button" />
  </form>
</div>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab"><?php echo $this->_var['lang']['tab_keywords']; ?></span>
      </p>
    </div>
    <!-- tab body -->
    <div id="tabbody-div">
        <!-- 关键字 -->
        <table width="90%" id="general-table">
          <tr><td align="center">
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
              codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
              width="565" height="420" id="FCColumn2" align="middle">
              <PARAM NAME="FlashVars" value="&dataXML=<?php echo $this->_var['general_data']; ?>">
              <PARAM NAME=movie VALUE="images/charts/ScrollColumn2D.swf?chartWidth=650&chartHeight=400">
              <param NAME="quality" VALUE="high">
              <param NAME="bgcolor" VALUE="#FFFFFF">
              <param NAME="wmode" VALUE="opaque">
              <embed src="images/charts/ScrollColumn2D.swf?chartWidth=650&chartHeight=400" FlashVars="&dataXML=<?php echo $this->_var['general_data']; ?>" quality="high" bgcolor="#FFFFFF"  width="650" height="400" name="FCColumn2" wmode="opaque" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
            </object>
          </td></tr>
        </table>
    </div>
</div>

<?php echo $this->smarty_insert_scripts(array('files'=>'tab.js')); ?>


<script type="Text/Javascript" language="JavaScript">
<!--
onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>