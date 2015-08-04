<!-- $Id -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js')); ?>
<div class="main-div">
<form name="theForm" method="post" action="">
  <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_category']; ?></td>
      <td><select name="category" id="category">
        <option value="0" selected><?php echo $this->_var['lang']['all_category']; ?></option>
        <?php echo $this->_var['cat_list']; ?>
      </select></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_brand']; ?></td>
      <td><select name="brand" id="brand">
        <option value="0" selected><?php echo $this->_var['lang']['all_brand']; ?></option>
        <?php echo $this->html_options(array('options'=>$this->_var['brand_list'])); ?>
      </select></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_intro_type']; ?></td>
      <td><select name="intro_type" id="intro_type">
        <option value="all" selected><?php echo $this->_var['lang']['all_intro_type']; ?></option>
        <?php echo $this->html_options(array('options'=>$this->_var['intro_list'])); ?>
      </select></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_need_image']; ?></td>
      <td>        <label>
        <select name="need_image" id="need_image">
          <option value="true" selected><?php echo $this->_var['lang']['need']; ?></option>
          <option value="false"><?php echo $this->_var['lang']['need_not']; ?></option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_goods_num']; ?></td>
      <td><input name="goods_num" type="text" id="goods_num" value="1" /></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_arrange']; ?></td>
      <td><select name="arrange" id="arrange">
        <option value="h" selected><?php echo $this->_var['lang']['horizontal']; ?></option>
        <option value="v"><?php echo $this->_var['lang']['verticle']; ?></option>
      </select></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_rows_num']; ?></td>
      <td><input name="rows_num" type="text" id="rows_num" value="1" /></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_charset']; ?></td>
      <td><select name="charset" id="charset">
        <?php echo $this->html_options(array('options'=>$this->_var['lang_list'])); ?>
      </select></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['label_sitename']; ?></td>
      <td><input name="sitename" type="text" id="sitename"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" class="button" name="gen_code" value="<?php echo $this->_var['lang']['generate']; ?>" onclick="genCode()" />        </td>
      </tr>
    <tr>
      <td colspan="2" align="center"><textarea name="code" cols="80" rows="5" id="code"></textarea></td>
      </tr>
  </table>
</form>
</div>
<script language="JavaScript">
    var elements = document.forms['theForm'].elements;
    var url = '<?php echo $this->_var['url']; ?>';

    onload = function()
    {
      // 开始检查订单
      startCheckOrder();
    }
    /**
     * 生成代码
     */
    function genCode()
    {
        // 检查输入
        if (isNaN(parseInt(elements['goods_num'].value)))
        {
            alert(goods_num_must_be_int);
            return;
        }
        if (elements['goods_num'].value < 1)
        {
            alert(goods_num_must_over_0);
            return;
        }
        if (isNaN(parseInt(elements['rows_num'].value)))
        {
            alert(rows_num_must_be_int);
            return;
        }
        if (elements['rows_num'].value < 1)
        {
            alert(rows_num_must_over_0);
            return;
        }

        // 生成代码
        var code = '\<script src=\"' + url + 'goods_script.php?';
        if (elements['category'].value > 0)
        {
            code += 'cat_id=' + elements['category'].value + '&';
        }
        if (elements['brand'].value > 0)
        {
            code += 'brand_id=' + elements['brand'].value + '&';
        }
        if (elements['intro_type'].value != 'all')
        {
            code += 'intro_type=' + elements['intro_type'].value + '&';
        }
        code += 'need_image=' + elements['need_image'].value + '&';
        code += 'goods_num=' + elements['goods_num'].value + '&';
        code += 'arrange=' + elements['arrange'].value + '&';
        code += 'rows_num=' + elements['rows_num'].value + '&';
        code += 'charset=' + elements['charset'].value + '&';
        code += 'sitename=' + encodeURI(elements['sitename'].value);
        code += '\"\>\</script\>';
        elements['code'].value = code;
        elements['code'].select();
        if (Browser.isIE)
        {
            window.clipboardData.setData("Text",code);
        }
    }
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>