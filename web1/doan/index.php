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
<title>Trang chủ</title>
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
<script src="js/scrollproduct/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/scrollproduct/jquery.kinetic.min.js"></script>
<script src="js/scrollproduct/jquery.mousewheel.min.js"></script>
<script src="js/scrollproduct/jquery.smoothdivscroll-1.3-min.js"></script>
<link rel="stylesheet" type="text/css" href="css/smoothDivScroll.css">


<script type="text/javascript">
	function putProID(masp) {
		$("#txtMaSP").val(masp);
		document.form1.submit();
	}
</script>
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
		require_once '/entities/Products.php';
		require_once '/helper/CartProcessing.php';
 		// đặt hàng
        if (isset($_POST["txtMaSP"])) {
            $masp = $_POST["txtMaSP"];
            $solg = 1;
            CartProcessing::addItem($masp, $solg);
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
        <form id="form1" name="form1" method="post" action="">
          <input type="hidden" id="txtMaSP" name="txtMaSP" />
        </form>
    <div class="main_body">
      <?php
		$list1 = Products::loadProductsNew(); // 10 san pham moi
		$n1 = count($list1);
		$list2 = Products::loadProductsView(); // 10 san pham xem nhieu nhat
		$n2 = count($list2);
		$list3 = Products::loadProductsTopSale(); // 10 san pham ban chay
		$n3 = count($list3);
		?>
          
        
      <h1 >Máy mới</h1>
      <div class="productScroll">
        <?php
      for ($i = 0; $i < $n1; $i++) {	
	  $pId =$list1[$i]->getProId();	?>
        <div class="product" onMouseOver="Change_Class('prod_cmd1.<?php echo $pId;
 ?>', 'prod_cmd_after')" onMouseOut="Change_Class('prod_cmd1.<?php echo $pId;
 ?>', 'prod_cmd_before')">
          <div class="prod_img"> <img class="img_p" src="imgs/products/<?php echo $pId;?>/1.jpg" alt="No image" width="200px" height="200px"/></div>
          <div class="prod_info"> <span class="proname"><?php echo $list1[$i]->getProName();?></span></br>
            <br/>
            <span class="price"><?php echo number_format($list1[$i]->getPrice());?> </span> <strong style="color:#F53235;">Đ</strong> </div>
          <div class="prod_cmd_before" id="prod_cmd1.<?php echo $pId;?>"> <a href="details.php?proID=<?php echo $pId;?>" class="lbutton">Chi tiết</a>
            <?php if($_SESSION['IsLogin']) { ?>
            <a href="#" onClick="putProID('<?php echo $pId; ?>')" class="lbutton">Đặt hàng</a>
            <?php }  else { ?>
            <a href="login.php" class="lbutton">Đặt hàng</a>
            <?php }?>
          </div>
        </div>
        <?php }?>
      </div>
      
      
      
      
      <h1>Xem nhiều nhất</h1>
      <div class="productScroll">
        <?php
      for ($i = 0; $i < $n2; $i++) {	
	  $pId2 =	$list2[$i]->getProId();?>
        <div class="product" onMouseOver="Change_Class('prod_cmd2.<?php echo $pId2;
 ?>', 'prod_cmd_after')" onMouseOut="Change_Class('prod_cmd2.<?php echo $pId2;
 ?>', 'prod_cmd_before')">
          <div class="prod_img"> <img class="img_p" src="imgs/products/<?php echo $pId2;?>/1.jpg" alt="No image" width="200px" height="200px"/></div>
          <div class="prod_info"> <span class="proname"><?php echo $list2[$i]->getProName();?></span></br>
            <br/>
            <span class="price"><?php echo number_format($list2[$i]->getPrice());?> </span><strong style="color:#F53235;">Đ</strong> </div>
          <div class="prod_cmd_before" id="prod_cmd2.<?php echo $pId2;?>"> <a href="details.php?proID=<?php echo $pId2;?>" class="lbutton">Chi tiết</a>
            <?php if($_SESSION['IsLogin']) { ?>
            <a href="#" onClick="putProID('<?php echo $pId2; ?>')" class="lbutton">Đặt hàng</a>
            <?php }  else { ?>
            <a href="login.php" class="lbutton">Đặt hàng</a>
            <?php }?>
          </div>
        </div>
        <?php }?>
      </div>

      
      <h1>Bán chạy</h1>
      
      <div class="productScroll">
        <?php
      for ($i = 0; $i < $n3; $i++) {	
	  $pId3 =$list3[$i]->getProId();	?>
        <div class="product" onMouseOver="Change_Class('prod_cmd3.<?php echo $pId3;
 ?>', 'prod_cmd_after')" onMouseOut="Change_Class('prod_cmd3.<?php echo $pId3;
 ?>', 'prod_cmd_before')">
          <div class="prod_img"> <img class="img_p" src="imgs/products/<?php echo $pId3;?>/1.jpg" alt="No image" width="200px" height="200px"/></div>
          <div class="prod_info"> <span class="proname"><?php echo $list3[$i]->getProName();?></span></br>
            <br/>
            <span class="price"><?php echo number_format($list3[$i]->getPrice());?> </span> <strong style="color:#F53235;">Đ</strong> </div>
          <div class="prod_cmd_before" id="prod_cmd3.<?php echo $pId3;?>"> <a href="details.php?proID=<?php echo $pId3;?>" class="lbutton">Chi tiết</a>
            <?php if($_SESSION['IsLogin']) { ?>
            <a href="#" onClick="putProID('<?php echo $pId3; ?>')" class="lbutton">Đặt hàng</a>
            <?php }  else { ?>
            <a href="login.php" class="lbutton">Đặt hàng</a>
            <?php }?>
          </div>
        </div>
        <?php }?>
      </div>
      
    </div>
    <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>