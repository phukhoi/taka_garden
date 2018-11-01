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
<title>Chi tiết sản phẩm</title>
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
		require_once '/entities/Products.php';
		require_once '/helper/CartProcessing.php';
        // đặt hàng

        if (isset($_POST["btnDatHang"])) {
            $masp = $_GET["proID"];
            $solg = $_POST["txtSoLuong"];
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
    <div class="main_body">
      <?php
		$p_proId = $_GET["proID"];
        $product = Products::loadProductByProId($p_proId);
		Products::AddView($p_proId);
		?>
      <div class="image_proid">
        <center>
          <div id="div1"> <img id="big" src="imgs/products/<?php echo $p_proId?>/1.jpg" width="400" height="400" alt"No image!"/> </div>
          <div> 
            <script type="text/javascript">
				for (var i = 1; i <= 5; i++ ) {
					var html = "<img class='thumbs' src='imgs/products/<?php echo $p_proId?>/"+ i +".jpg' width='80' height='80' onclick='changeImage(this.src)' />";
					document.write(html);
				}
			</script> 
          </div>
        </center>
      </div>
      <strong style="font-size:20px;"><?php echo $product->getProName()?></strong>
      <div class="TinyDes_proid">
        <hr class="hrd" width="100px"/>
        <span>Giá:</span> <span style="color:#09E730;"><?php echo number_format($product->getPrice())?> Đ</span><br/>
        <span>Số lượng:</span> <?php echo $product->getQuantity()?><br/>
        <span>Số lượt xem:</span> <?php echo $product->getView()?><br/>
        <hr class="hrd" width="200px"/>
        <?php echo $product->getTinyDes();?> <br/>
        <?php if ($_SESSION["IsLogin"] && $product->getQuantity() >0) {?>
        <form id="fr"  name="fr" method="post" action="">
          <input type="number" id="txtSoLuong" name="txtSoLuong" min="0" value="0">
          <br/>
          <input type="submit" id="btnDatHang" name="btnDatHang"  value="Đặt hàng" class="blueButton"/>
        </form>
        <?php } ?>
      </div>
      
      <?php 
	  
	  $listCungLoai=Products::loadProductsCungLoai($product->getClassify(),$p_proId);
	  $ncl = count($listCungLoai);
	  ?>
      <div class="spCungLoai">
      <strong>Các sản phẩm cùng loại</strong>
<br/>
	  <?php 
	  for($i=0; $i<$ncl; $i++){
		  ?>
          		 <a href="details.php?proID=<?php echo $listCungLoai[$i]->getProId();?>" style="cursor:pointer;">

          <div class="product">
         <img src="imgs/products/<?php echo $listCungLoai[$i]->getProId();?>/1.jpg" width="150" height="150" alt=""/>
         <br/>
         <span style="clear:both; color:rgba(0,51,255,1); font-size:10px;"><?php echo $listCungLoai[$i]->getProName();?></span>
         </div></a>
	<?php  } ?>
      </div>
      
      
            <?php 
	  
	  $listCungNSX=Products::loadProductsCungNSX($product->getCatId(),$p_proId);
	  $ncnsx = count($listCungNSX);
	  ?>

      <div class="spCungNsx">
            <strong>Các sản phẩm cùng Nhà Sản Xuất</strong>
<br/>

       <?php 
	  for($i=0; $i<$ncnsx; $i++){
		  ?>
          		 <a href="details.php?proID=<?php echo $listCungNSX[$i]->getProId();?>" style="cursor:pointer;">

          <div class="product">
         <img src="imgs/products/<?php echo $listCungNSX[$i]->getProId();?>/1.jpg" width="150" height="150" alt=""/>
         <br/>
         <span style="clear:both; color:rgba(0,51,255,1); font-size:10px;"><?php echo $listCungLoai[$i]->getProName();?></span>
         </div></a>
	<?php  } ?>
      </div>
      
      <div class="FullDes_proid">
        <hr class="hrd"/>
        <?php echo $product->getFullDes();?> </div>
    </div>
    <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>