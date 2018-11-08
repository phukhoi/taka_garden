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
<title>Untitled Document</title>
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
        require_once '/helper/Context.php';
        require_once '/helper/Utils.php';
        require_once '/entities/User.php';

        if (!Context::isLogged()) {
            Utils::RedirectTo('login.php?retUrl=profile.php');
        }
		
        // đổi mật khẩu

        if (isset($_POST["btnDoiMK"])) {
            $old_pwd = $_POST['txtMKCu'];
            $new_pwd = $_POST['txtMKMoi'];
            $username = $_SESSION['CurrentUser'];

            $n = User::changePassword($username, $old_pwd, $new_pwd);

            if ($n > 0) {
                echo "<script type='text/javascript'>alert('Đổi MK thành công.');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Đổi MK KHÔNG thành công.');</script>";
            }
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
         <form action="" method="post" id="frm">
         <?php 
		 $a =$_SESSION["CurrentUser"];
		 		$list = User::getInfo($a);

		 ?>
                            <table id="tableDangKy" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td colspan="4" class="title">Đổi mật khẩu</td>
                                </tr>
                                <tr>
                                    <td width="15px"></td>
                                    <td width="120px"></td>
                                    <td width="200px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Tên đăng nhập:</td>
                                    <td><strong><?php echo $_SESSION["CurrentUser"]; ?></strong>

                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Mật khẩu cũ:</td>
                                    <td><input type="password" id="txtMKCu" name="txtMKCu" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Mật khẩu mới:</td>
                                    <td><input type="password" id="txtMKMoi" name="txtMKMoi" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Nhập lại:</td>
                                    <td><input type="password" id="txtNLMK" name="txtNLMK" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input name="btnDoiMK" type="submit" class="blueButton" id="btnDoiMK" value="Cập nhật" /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="title">Cập nhật thông tin cá nhân</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Họ tên:</td>
                                    <td>
                                        <input type="text" id="txtHoTen" name="txtHoTen" value="<?php echo $list->getName(); ?>" />
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Email:</td>
                                    <td>
                                        <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $list->getEmail(); ?>" />
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Ngày sinh:</td>
                                    <td>
                                        <input type="text" id="txtNgaySinh" name="txtNgaySinh" value="<?php echo date('j/n/Y', $list->getDob()); ?>" />
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input name="btnCapNhat" type="submit" class="blueButton" id="btnCapNhat" value="Cập nhật" /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;

                                    </td>
                                </tr>
                            </table>
                        </form>
        </div>
        <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>