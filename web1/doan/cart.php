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
<title>Giỏ hàng</title>
<style type="text/css">
.cart {
	border-collapse: collapse;
	border: solid 1px #626262;
	margin: 5px auto;
	font-size: 16px;
}
.cart th {
	background-color: #626262;
	color: #FFFFFF;
	font-weight: bold;
	line-height: 30px;
}
.cart td {
	color: #626262;
}
</style>
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
<script type="text/javascript">
            function putProID(cmd, masp) {
                $("#hCmd").val(cmd);
                $("#hProId").val(masp);

                document.fr.submit();
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
   		require_once '/helper/CartProcessing.php';
		require_once '/helper/Context.php';
        if (!Context::isLogged()) {
            Utils::RedirectTo('login.php?retUrl=cart.php');
        }
		// cập nhật giỏ hàng (xoá/sửa)

        if (isset($_POST['hCmd'])) {
            $cmd = $_POST['hCmd']; // X/S
            $masp = $_POST['hProId'];

            if ($cmd == 'X') {
                CartProcessing::removeItem($masp);
            } else if ($cmd == 'S') {
                //$sl = $_POST["sl_".$masp];
                $sl = $_POST["sl_$masp"];
                CartProcessing::updateItem($masp, $sl);
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
    <?php
    // lập hoá đơn

        require_once '/entities/Order.php';
        require_once '/entities/OrderDetail.php';
        require_once '/entities/Products.php';

        if (isset($_POST['btnLapHD'])) {
            $date = time();
            $user = $_SESSION['CurrentUser'];

            $total = 0;
            foreach ($_SESSION['Cart'] as $masp => $solg) {
                $p = Products::loadProductByProId($masp);
                $amount = $p->getPrice() * $solg;
                $total += $amount;
				Products::UpdateQuantity($masp,$solg);
            }
            $o = new Order(-1, $date, $user, $total);
            $o->add();
            // thêm nhiều dòng chi tiết hoá đơn

            foreach ($_SESSION['Cart'] as $masp => $solg) {
                $p = Products::loadProductByProId($masp);

                $amount = $p->getPrice() * $solg;
                $detail = new OrderDetail(-1, $o->getOrderID(), $masp, $solg, $p->getPrice(), $amount);
                $detail->add();
            }

            // huỷ giỏ hàng

            unset($_SESSION['Cart']);

            // nạp lại trang hiện tại

            $query = $_SERVER['PHP_SELF'];
            $path = pathinfo($query);
            $url = $path['basename'];
            Utils::RedirectTo($url);
        }
        ?>
    <div class="main_body">
      <form id="fr"  name="fr" method="post" action="">
        <input type="hidden" id="hCmd" name="hCmd" />
        <input type="hidden" id="hProId" name="hProId" />
        <div style="margin: 10px 0  0 25px;"> 
        <strong id="total" class="bold13orange" style="margin-left:50px;">Tổng tiền: 0 <br/></strong></div>
        <table class="cart" width="90%" border="1" cellspacing="0" cellpadding="4">
          <tbody>
            <tr>
              <th width="30%" scope="col">Sản phẩm</th>
              <th width="15%" scope="col">Giá</th>
              <th width="15%" scope="col">Số lượng</th>
              <th width="20%" scope="col">Thành tiền</th>
              <th width="10%" scope="col">Xóa</th>
              <th width="10%" scope="col">Cập nhật</th>
            </tr>
            <?php 
			require_once '/entities/Products.php';
			$total = 0;
			foreach ($_SESSION['Cart'] as $masp => $soluong){
			$p = Products::loadProductByProId($masp);
			?>
            <tr align="center">
              <td><?php echo $p->getProName(); ?></td>
              <td><?php echo number_format($p->getPrice()); ?></td>
              <td><input type="text" id="sl_<?php echo $masp; ?>" name="sl_<?php echo $masp; ?>" style="width: 60px" value="<?php echo $soluong; ?>" /></td>
              <td><?php echo number_format($p->getPrice() * $soluong); ?></td>
              <td><img src="imgs/delete-icon.png" width="16" height="16" alt="Delete" style="cursor: pointer" onclick="putProID('X', <?php echo $masp; ?>);"></td>
              <td><img src="imgs/save-icon.png" width="16" height="16" alt="Update" style="cursor: pointer" onclick="putProID('S', <?php echo $masp; ?>);"></td>
            </tr>
            <?php 
			$total += $p->getPrice() * $soluong;
			}?>
          </tbody>
        </table>
        <script type="text/javascript">
			$("#total").html("Tổng tiền: <?php echo number_format($total); ?>");
		</script>
        <?php if($total != 0) {?>
	        <input type="submit" id="btnLapHD" name="btnLapHD" value="Lập hoá đơn" class="blueButton" style="margin-left:50px;" />
            <?php } ?>
      </form>
    </div>
    <!-- InstanceEndEditable --> </div>
  <div id="footer">Content for  class "footer" Goes Here</div>
</div>
</body>
<!-- InstanceEnd --></html>