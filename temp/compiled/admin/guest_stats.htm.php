<!-- $Id: guest_stats.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>

<div class="list-div">
  <table width="100%" cellspacing="1" cellpadding="3">
    <tr>
    <th colspan="5" align="left" style="padding-left:10px;">
    <?php echo $this->_var['lang']['percent_buy_member']; ?><span style="font:12px;color:#777;"><?php echo $this->_var['lang']['buy_member_formula']; ?></span>
    </th>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['lang']['member_count']; ?></td>
      <td><?php echo $this->_var['lang']['order_member_count']; ?></td>
      <td><?php echo $this->_var['lang']['member_order_count']; ?></td>
      <td><?php echo $this->_var['lang']['percent_buy_member']; ?></td>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['user_num']; ?></td>
      <td><?php echo $this->_var['have_order_usernum']; ?></td>
      <td><?php echo $this->_var['user_order_turnover']; ?></td>
      <td><?php echo $this->_var['user_ratio']; ?>%</td>
    </tr>
  </table>
</div>
<div class="list-div">
  <table width="100%" cellspacing="1" cellpadding="3">
    <tr>
    <th colspan="5" align="left" style="padding-left:10px;">
    <?php echo $this->_var['lang']['order_turnover_peruser']; ?><span style="font:12px;color:#777;"><?php echo $this->_var['lang']['member_order_amount']; ?>
    <?php echo $this->_var['lang']['member_buy_amount']; ?></span>
    </th>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['lang']['member_sum']; ?></td>
      <td><?php echo $this->_var['lang']['average_member_order']; ?></td>
      <td><?php echo $this->_var['lang']['member_order_sum']; ?></td>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['user_all_turnover']; ?></td>
      <td><?php echo $this->_var['ave_user_ordernum']; ?></td>
      <td><?php echo $this->_var['ave_user_turnover']; ?></td>
    </tr>
  </table>
</div>
<div class="list-div">
  <table width="100%" cellspacing="1" cellpadding="3">
    <tr><th colspan="5" align="left" style="padding-left:10px;">
    <?php echo $this->_var['lang']['order_turnover_percus']; ?><span style="font:12px;color:#777;"><?php echo $this->_var['lang']['guest_all_ordercount']; ?></span>
    </th>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['lang']['guest_member_orderamount']; ?></td>
      <td><?php echo $this->_var['lang']['guest_member_ordercount']; ?></td>
      <td><?php echo $this->_var['lang']['guest_order_sum']; ?></td>
    </tr>
    <tr align="center">
      <td><?php echo $this->_var['guest_all_turnover']; ?></td>
      <td><?php echo $this->_var['guest_order_num']; ?></td>
      <td><?php echo $this->_var['guest_order_amount']; ?></td>
    </tr>
  </table>
</div>

<script type="Text/Javascript" language="JavaScript">
<!--

onload = function()
{
    // &#64138;&#53036;&#10870;鵥
    startCheckOrder();
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
