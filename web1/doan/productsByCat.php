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
<title>Sản phẩm</title>
<script type="text/javascript">
            function putProID(masp) {
                $("#txtMaSP").val(masp);
                document.form1.submit();
            }
        </script>
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
    <div class="main_body">
      <?php		
		$flag = 0;
		
		$productPerPage = 12;	// số sản phẩm trên 1 trang
		$curPage = 1;
		if(isset($_GET["page"]))
			$curPage=$_GET["page"];
		
		$offset = ($curPage-1)*$productPerPage;
		
		if(isset($_GET["catId"]))
		{
			$p_catId = $_GET["catId"];
			$alllist = Products::loadProductsByCatId($p_catId);
			$list = Products::loadProductsLimit($p_catId,$offset,$productPerPage);
			$flag=1;
		}else
			if(isset($_GET["cId"]))
			{
				$p_cId = $_GET["cId"];
				$alllist = Products::loadProductsByCId($p_cId);
				$list = Products::loadProductsLimitClassify($p_cId,$offset,$productPerPage);
				$flag=2;
			}else
			
			{
				$alllist = Products::loadProductsAll();
				$p_catId = -1;
				$list = Products::loadProductsLimit($p_catId,$offset,$productPerPage);
			}
		$numberProduct= count($alllist); // số lượng sản phẩm load được
		$numberPages= ceil($numberProduct/$productPerPage); // số lượng trang
		$n = count($list); //số lượng sản phẩm load lên
		
		if ($n == 0) {
			echo "Không có sản phẩm.";
		} 
		else {
			for ($i = 0; $i < $n; $i++) {
				$pid=$list[$i]->getProId();
				?>
      <div class="product" onMouseOver="Change_Class('prod_cmd.<?php echo $pid;
 ?>', 'prod_cmd_after')" onMouseOut="Change_Class('prod_cmd.<?php echo $pid;
 ?>', 'prod_cmd_before')">
        <div class="prod_img"> <img class="img_p" src="imgs/products/<?php echo $pid?>/1.jpg" alt="No image" width="200px" height="200px"/></div>
        <div class="prod_info"> <span class="proname"><?php echo $list[$i]->getProName();?></span></br>
          <br/>
          <span class="price"><?php echo number_format($list[$i]->getPrice());?> </span><strong style="color:#F53235;">Đ</strong> </div>
        <div class="prod_cmd_before" id="prod_cmd.<?php echo $pid;?>"> <a href="details.php?proID=<?php echo $pid;?>" class="lbutton">Chi tiết</a>
          <?php if($_SESSION['IsLogin']) { ?>
          <a href="#" onClick="putProID('<?php echo $pid ?>')" class="lbutton">Đặt hàng</a>
          <?php }  else { ?>
          <a href="login.php" class="lbutton">Đặt hàng</a>
          <?php }?>
        </div>
      </div>
      <?php } //end for
				
         } //end else
		?>
      <div class="listPages">
        <hr/>
        <?php 
			for ($page=1; $page <= $numberPages; $page++)
			{
				if($page == $curPage)
					echo "<strong>".$page."</strong> ";
				else
					if($flag == 0)
						echo "<a class='lpage' href='productsByCat.php?page=".$page."'>".$page."</a> ";
					else if($flag == 1)
						echo "<a class='lpage' href='productsByCat.php?catId=".$p_catId."&page=".$page."'>".$page."</a> ";
					else if($flag == 2)
						echo "<a class='lpage' href='productsByCat.php?cId=".$p_cId."&page=".$page."'>".$page."</a> ";

			} //end for
			?>
      </div>
      <form id="form1" name="form1" method="post" action="">
          <input type="hidden" id="txtMaSP" name="txtMaSP" />
        </form>

    </div>
    <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>