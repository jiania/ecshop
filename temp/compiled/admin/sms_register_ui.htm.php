<!-- $Id: sms_register_ui.htm 16697 2009-09-24 03:57:47Z liuhui $ -->
<?php echo $this->fetch('pageheader.htm'); ?>

<div id="main-div">
<div class="main-div">
<!--<form name="sms-register-form" action="sms.php?act=register" method="POST" onsubmit="return validate_register();">-->
<table cellspacing="1" cellpadding="3" width="100%">
  <tr>
    <th colspan="2"><?php echo $this->_var['lang']['error_tips']; ?></th>
  </tr>
  <!--<tr>
    <td class="label"><?php echo $this->_var['lang']['email']; ?>:</td>
    <td><input type="text" name="email" maxlength="60" size="20" value="<?php echo $this->_var['sms_site_info']['email']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['password']; ?>:</td>
    <td><input type="password" name="password" maxlength="20" size="20" value="" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['domain']; ?>:</td>
    <td><input type="text" name="domain" maxlength="60" size="40" value="<?php echo $this->_var['sms_site_info']['domain']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['phone']; ?>:</td>
    <td><input type="text" name="phone" maxlength="60" size="20" value="" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </td>
  </tr>-->
</table>
<!--</form>-->
</div>
<!--<div class="main-div">
<form name="sms-enable-form" action="sms.php?act=enable" method="POST" onsubmit="return validate_enable();">
<table cellspacing="1" cellpadding="3" width="100%">
  <tr>
    <th colspan="2"><?php echo $this->_var['lang']['enable_old']; ?></th>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['email']; ?>:</td>
    <td><input type="text" name="email" maxlength="60" size="20" value="<?php echo $this->_var['sms_site_info']['email']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['password']; ?>:</td>
    <td><input type="password" name="password" maxlength="20" size="20" value="" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </td>
  </tr>
</table>
</form>
</div>-->
</div>

<!--<script type="text/javascript" language="JavaScript">
<!--

function validate(formName) {
  var f = document[formName],
      email = f.email.value,
      password = f.password.value;

  var reEmpty = /^\s*$/,
      reEmailFormat = /^[^@]+@.+$/,
      errorStr = '';

  if (reEmpty.test(email)) {
    errorStr += username_empty_error + "\n";
  }

  if (!reEmailFormat.test(email)) {
    errorStr += username_format_error + "\n";
  }

  if (reEmpty.test(password)) {
    errorStr +=  password_empty_error + "\n";
  }

  return errorStr;
}

function validate_register() {
  var errorStr = validate("sms-register-form"),
    domain = document["sms-register-form"].domain.value,
    reEmpty = /^\s*$/,
    reDomainFormat = /^(?:[^.]+\.)*\w+\/?$/;

  if (reEmpty.test(domain)) {
    errorStr += domain_empty_error + "\n";
  }
  if (!reDomainFormat.test(domain)) {
    errorStr += domain_format_error + "\n";
  }

  if (errorStr === '') {
    return true;
  } else {
    alert(errorStr);
    return false;
  }
}

function validate_enable() {
  var errorStr = validate("sms-enable-form");

  if (errorStr === '') {
    return true;
  } else {
    alert(errorStr);
    return false;
  }
}

//-->
-->
<?php echo $this->fetch('pagefooter.htm'); ?>