<?php
session_start();

if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Đăng ký tài khoản</title>
    <!-- InstanceEndEditable -->

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/link.css">
<link rel="stylesheet" type="text/css" href="css/product.css">
<!-- bxSlider CSS file -->
<link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
<!-- jQuery library  -->
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
--><script src="js/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="js/jquery.bxslider.min.js"></script>
<!--Code Script -->

<!-- InstanceBeginEditable name="head" -->
    <script src="js/check.js"></script>

    <!-- InstanceEndEditable -->
<script src="js/script.js">
</script>
</head>

<body>
<?php
	if (!isset($_SESSION['Cart'])) {
		$_SESSION['Cart'] = array();
	}
?>
<!-- InstanceBeginEditable name="EditRegion4" -->

<?php
        require_once '/helper/Utils.php';
        require_once '/entities/User.php';

        if (isset($_POST["btnDangKy"])) {
            $tendn = $_POST["txtTenDN"];
            $mk = $_POST["txtMK"];
            $hoTen = $_POST["txtHoTen"];
            $email = $_POST["txtEmail"];
            $ngaySinh = $_POST["txtNgaySinh"]; // 28/11/2014
			
            $dob = strtotime(str_replace('/', '-', $ngaySinh)); //d-m-Y

			$listName = User::loadUserName();
			
			$flag = true;
			
			foreach ($listName as $idname){
				if($idname == $tendn)
				{
					$flag =false;
					break;
				}
			}
			if($flag){
            	$u = new User(-1, $tendn, $mk, $hoTen, $email, $dob, 0);
            	$u->insert();
				Utils::RedirectTo("login.php?true=1");
			}
			else
				{ ?>
					<script> alert("Tên đăng nhập đã tồn tại!");</script>
				<?php }

        }
?>
    <!-- InstanceEndEditable -->
<div class="list">
  <div class="tl">HÃNG SẢN XUẤT</div>
  <?php
	require_once '/entities/categories.php';
	require_once '/entities/classify.php';
	require_once '/helper/Utils.php';
	$categories = categories::loadAll();
	for ($i = 0, $n = count($categories); $i < $n; $i++) 
	{
		$name = $categories[$i]->getCatName();
		$id = $categories[$i]->getCatId();
		?>
  <a href="productsByCat.php?catId=<?php echo $id; ?>" class="listmenu"><?php echo $name; ?></a>
  <?php
     }
     ?>
  <div class="tl">PHÂN LOẠI</div>
  <?php $classify = Classify::LoadClassify();
   for($i =0, $n=count($classify);$i<$n;$i++)
   {
	   $cid = $classify[$i]->getCId();
	   $cname = $classify[$i]->getCName();
	?>
  <a href="productsByCat.php?cId=<?php echo $cid; ?>" class="listmenu"><?php echo $cname; ?></a>
  <?php } ?>
</div>
<div id="top">
  <div class="search">
    <form id="frSearch"  name="frSearch" method="post" action="">  
      <input name="txtSearch" type="search" class="txtSearch" id="txtSearch" placeholder="Search">
      <input type="submit" id="btnSearch" name="btnSearch" value ="Search" class="blueButton" >  </br>
      <select name="selectHSX" id="selectHSX" >
    	<option value="0">All</option>
        <?php
        for ($i = 0, $n = count($categories); $i < $n; $i++) 
		{
			$name = $categories[$i]->getCatName();
			$id = $categories[$i]->getCatId(); ?>
        	<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
  		<?php }?>
      </select>
      
      <select name="selectLoai" id="selectLoai" >
    	<option value="0">All</option>
       <?php $classify = Classify::LoadClassify();
   for($i =0, $n=count($classify);$i<$n;$i++)
   {
	   $cid = $classify[$i]->getCId();
	   $cname = $classify[$i]->getCName();
	?>
        	<option value="<?php echo $cid; ?>"><?php echo $cname; ?></option>
  		<?php }?>
      </select>
       
       <select name="selectGia" id="selectGia" >
    		<option value="100000000">All</option>
        	<option value="10000000">< 10 triệu </option>
            <option value="20000000">< 20 triệu </option>
        	<option value="30000000">< 30 triệu </option>
        	<option value="40000000">< 40 triệu </option>
        	<option value="50000000">< 50 triệu </option>
      </select>
</form>


    <?php 
	if(isset($_POST["btnSearch"]))
	{
		$value = str_replace("'","",$_POST['txtSearch']);
		$value = str_replace("  ","",$value);
		$value = str_replace(" ","%",$value);

		$url ="search.php?nsx=".$_POST['selectHSX']."&value=".$value."&loai=".$_POST['selectLoai']."&gia=".$_POST['selectGia'];
		Utils::RedirectTo($url);
	}
	?>
  </div>
  <div class="userCommand">
    <?php
		require_once '/helper/Context.php';
		require_once '/helper/CartProcessing.php';
	if (!Context::isLogged()) {
		?>
    <a href="login.php" class="ucmd">Đăng nhập</a> <span style="float:left;">|</span> <a href="register.php" class="ucmd">Đăng ký</a>
    <?php
} else {
    ?>
    <a href="cart.php" class="ucmd"><?php echo CartProcessing::countQuantity();?> Sản phẩm</a> <span style="float:left;">|</span> <a href="profile.php" class="ucmd">Hi, <?php echo $_SESSION["CurrentUser"]; ?>!</a> <span style="float:left;">|</span> <a href="logout.php" class="ucmd">Thoát</a>
    <?php
}
?>
  </div>
</div>
<div id="main">
  <div id="header">
    <ul class="bxslider">
      <?php for($i=1;$i<7;$i++) { ?>
      <li><img src="imgs/banners/<?php echo $i?>.jpg"  alt=""/></li>
      <?php }?>
    </ul>
  </div>
  <div id="navigation">
    <ul>
      <li><a href="index.php" class="nav">TRANG CHỦ</a></li>
      <li><a href="productsByCat.php" class="nav">SẢN PHẨM</a></li>
      <li><a href="#" class="nav">LIÊN HỆ</a></li>
      <li><a href="#" class="nav">THÔNG TIN</a></li>
    </ul>
  </div>
  <hr class="hrm"/>
  <div id="body">
    <div class="info_address"> </div>
    <!-- InstanceBeginEditable name="EditRegion3" -->
        <div class="main_body">
        <form id="fr" name "fr" method="post" action="" onsubmit="return KTraDK();">
<h1 align="center">ĐĂNG KÝ TÀI KHOẢN</h1><br/>
      <table width="362" cellpadding="2" cellspacing="0" id="tableDangKy" style="margin-left: 200px;">
            <tr>
          <td colspan="4" class="title">Thông tin đăng nhập</td>
        </tr>
            <tr>
          <td width="5">&nbsp;</td>
          <td width="122">&nbsp;</td>
          <td width="204">&nbsp;</td>
          <td width="13">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td >Tên đăng nhập:</td>
          <td><input type="text" name="txtTenDN" id="txtTenDN" /> </td>
          <td style="text-align: center; color: #FF0000;"> *</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Mật khẩu:</td>
          <td><input type="password" name="txtMK" id="txtMK" /></td>
          <td style="text-align: center; color: #FF0000;">*</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Nhập lại:</td>
          <td><input type="password" name="txtNLMK" id="txtNLMK" /></td>
          <td style="text-align: center; color: #FF0000;">*</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><img src="captcha/captcha.php" id="imgCaptcha" style="cursor: pointer;" onclick="changeCaptcha()" /></td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Mã xác nhận:</td>
          <td><input type="text" name="captcha-form" id="captcha-form" autocomplete="off" />
</td>
          <td style="text-align: center; color: #FF0000;">*</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td colspan="4" class="title">Thông tin cá nhân</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Họ tên:</td>
          <td><input type="text" name="txtHoTen" id="txtHoTen" /></td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Email:</td>
          <td><input type="text" name="txtEmail" id="txtEmail" /></td>
          <td style="text-align: center; color: #FF0000;">*</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>Ngày sinh:</td>
          <td><input type="text" name="txtNgaySinh" id="txtNgaySinh" /></td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="btnDangKy" type="submit" class="blueButton" id="btnDangKy" value="Đăng ký" /></td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
            <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
          </table>
          </form>
    </div>
  <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>