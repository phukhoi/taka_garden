<?php
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
session_start();

if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
}
require_once './entities/categories.php';
require_once './entities/classify.php';
require_once './helper/Utils.php';
require_once './entities/Products.php';
require_once './helper/CartProcessing.php';
require_once './helper/Context.php';
require_once './helper/SessionFunction.php';
require_once './entities/Order.php';
require_once './entities/OrderDetail.php';

if (!Context::isLogged()) {
    // Utils::RedirectTo('login.php?retUrl=cart.php');
}
// đặt hàng
if (isset($_POST["txtMaSP"])) {
	$masp = $_POST["txtMaSP"];
	$solg = 1;
	CartProcessing::addItem($masp, $solg);
}

$categories = categories::loadAll();

$listProduct1 = Products::loadProductsByCatId(1);
$listProduct3 = Products::loadProductsByCatId(2);
$listProduct2 = Products::loadProductsByCatId(3);


?>
<?php
	if (!isset($_SESSION['Cart'])) {
		$_SESSION['Cart'] = array();
    }
    
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

<!DOCTYPE html>
<html>
	<head>
		<title> Taka Graden </title>
		<meta charset="UTF-8">
		<meta name="keywords" content="html,htm5,web">
		<meta name="description" content="Do an web, home, trang chu">
		<link href="img/logog.png" rel="shourtcut icon" />
		
		<!-- Style CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
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
    </head>
	<body class="main">
		<!-- Header -->
		<header class="header">
			<div class="header-top">
            	<div class="container">
					<div class="top-header">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<ul class="topbar-left">
									<li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:01202582956">Hotline: 01202582956</a></li>
									<li class="hidden-xs"><i class="fa fa-facebook-square" aria-hidden="true"></i> <a target="_blank" href="https://www.facebook.com/takagarden/">www.facebook.com/takagarden</a></li>
								</ul>
							</div>
							
							<div class="col-md-6 col-sm-6 col-xs-6">
								<ul class="topbar-right">
								<?php
											
									if (!Context::isLogged()) {
									?>
                                    <li><i class="fa fa-user" aria-hidden="true"></i><a
                                            href="cart.php"><?php echo CartProcessing::countQuantity(); ?> Sản phẩm</a>
                                    </li>
									<li><i class="fa fa-user" aria-hidden="true"></i><a href="login.php">Đăng nhập</a></li>
									<li style="margin-right: 0;"><i class="fa fa-lock" aria-hidden="true"></i><a href="register.php">Đăng ký</a></li>
									<!-- <a href="login.php" class="ucmd">Đăng nhập</a> <span style="float:left;">|</span> <a href="register.php" class="ucmd">Đăng ký</a> -->
									<?php
									} else {
										?>
										<li><i class="fa fa-user" aria-hidden="true"></i><a href="cart.php"><?php echo CartProcessing::countQuantity();?> Sản phẩm</a></li>
										<li><i class="fa fa-user" aria-hidden="true"></i><a href="profile.php">Chào,  <?php echo $_SESSION["CurrentUser"]; ?>!</a></li>
										<li><i class="fa fa-user" aria-hidden="true"></i><a href="logout.php">Thoát</a></li>
										<!-- <a href="cart.php" class="ucmd"><?php echo CartProcessing::countQuantity();?> Sản phẩm</a> <span style="float:left;">|</span> <a href="profile.php" class="ucmd">Hi, <?php echo $_SESSION["CurrentUser"]; ?>!</a> <span style="float:left;">|</span> <a href="logout.php" class="ucmd">Thoát</a> -->
										<?php
									}
									?>
									
								</ul>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <div class="header-logo">
            	<div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="logo"><a href="index.php"><abbr title="Logo"><img src="img/logo-small.png" /></abbr></a> </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="search">
                                <form class="search-form" action="#" method="get">
                                    <input class="s-input" type="text" placeholder="Tìm kiếm sản phẩm..." />
                                    <button class="btn-search" type="submit">
                                    	<span>Tìm kiếm</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-3 hidden-xs">
                            <div class="box-cart">
                            	<ul>
                                	<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>Yêu thích</a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Giỏ hàng</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-menu hidden-xs">
                <div class="container">
                    <nav class="main-navigation">
                        <ul>
                            <li>
                                <a href="index.php">
                                    <span class="nav-caption">Trang chủ</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php">
                                    <span class="nav-caption">Giới thiệu</span>
                                </a>
                            </li>
                            <li class="submenu">
                                <a href="#" id="idMenu">
                                    <span class="nav-caption">Sản phẩm</span>
                                </a>
                                <ul class="sub_menu" >
                                    
                                    <?php
                                        for ($i = 0, $n = count($categories); $i < $n; $i++) 
                                        {
                                            $name = $categories[$i]->getCatName();
                                            $id = $categories[$i]->getCatId();
                                    ?>
                                    <li><a href="productsByCat.php?catId=<?php echo $id; ?>"><?php echo $name; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <a href="blog.php">
                                    <span class="nav-caption">Tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="blog.php">
                                    <span class="nav-caption">Khuyến mãi</span>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                    <span class="nav-caption">Liên hệ</span>
                                </a>
                            </li>
                        </ul>		
                    </nav>
                </div>
             </div>
		</header>
		<!-- /Header -->
		
		<!-- Content -->
		<div class="content">
        	<div class="content-top">
                <div class="container">
                    <div class="row">
                        <div class="sidebar col-md-3 col-sm-3 col-xs-12">
                        	<div class="side-box-heading">
                            	<i class="fa fa-folder-open-o" aria-hidden="true"></i>
                            	<h4>Danh mục sản phẩm</h4>
                            </div>
                            <div class="side-box-content">
                            	<ul>
                                <?php
                            
                                    for ($i = 0, $n = count($categories); $i < $n; $i++) 
                                    {
                                        $name = $categories[$i]->getCatName();
                                        $id = $categories[$i]->getCatId();
                                ?>
                                <li><a href="productsByCat.php?catId=<?php echo $id; ?>"><?php echo $name; ?></a></li>
                                <?php
                                    }
                                    ?>
									<li><a href="#">Sản phẩm bán chạy</a></li>
									<li><a href="#">Sản phẩm nổi bật</a></li>
									<li><a class="purple" href="#">Tất cả sản phẩm</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="slider col-md-9 col-sm-9 hidden-xs">
						  <div class="slideshow">
							  <img src="img/slider/slider_1.jpg" />
							  <img src="img/slider/slider_2.jpg" />
							  <img src="img/slider/slider_3.jpg" />
							</div>
                    	</div>
                    </div>
                </div>
            </div>
			<div class="content-service">
				<div class="container">
                    <div class="row">
						 <div class="col-md-4 col-sm-4 col-xs-12">
							<div class="item_service">
								<div class="img_service">
									<img src="img/service/service1.png" alt="Giao hàng trong 24h">
								</div>
								<div class="content_service">
									<p>Giao hàng trong 24h</p>
									<span>Miễn phí giao hàng đơn hàng trên 500k</span>
								</div>
							</div>
						 </div>
						 <div class="col-md-4 col-sm-4 col-xs-12">
							<div class="item_service">
								<div class="img_service">
									<img src="img/service/service2.png" alt="Sản phẩm 100% chính hãng">
								</div>
								<div class="content_service">
									<p>Khuyến mãi cửa hàng</p>
									<span>Trị giá đơn hàng trên 1.000.000đ </span>
								</div>
							</div>
						 </div>
						 <div class="col-md-4 col-sm-4 col-xs-12">
							<div class="item_service">
								<div class="img_service">
									<img src="img/service/service3.png" alt="Đặt hàng nhanh chóng" title="Đặt hàng nhanh chóng">
								</div>
								<div class="content_service">
									<p>Đặt hàng nhanh chóng</p>
									<span>Gọi ngay:
										<a href="tel:01202582956">
											01202582956
										</a>
										&nbsp;để đặt hàng
									</span>
								</div>
							</div>
						 </div>
					</div>
				</div>
			</div>
			
			<div class="content-product senda">

				<div class="container">
                    <div class="row">
						 <div class="col-md-12 col-sm-12 col-xs-12">
                         <?php flash( 'message' ); ?>
                         <?php
                        // lập hoá đơn
                            if (isset($_POST['btnLapHD'])) {
								
                                $date = time();
                                $user = $_SESSION['CurrentUser'];
                                if( $user == null ){
                                    $note = $_POST['order_note'];
                                }else{
                                    $note = '';
                                }
                                $total = 0;
                                foreach ($_SESSION['Cart'] as $masp => $solg) {
                                    $p = Products::loadProductByProId($masp);
                                    if( $p->onsale ){
                                        $amount = $p->salesprice * $solg;
                                    }else{
                                        $amount = $p->getPrice() * $solg;
                                    }
                                    $total += $amount;
                                    Products::UpdateQuantity($masp,$solg);
                                }
                                $o = new Order(-1, $date, $user, $total, $note);
                                // var_dump($o);die();
                                $o->add();
                                // thêm nhiều dòng chi tiết hoá đơn
								
                                foreach ($_SESSION['Cart'] as $masp => $solg) {
                                    $p = Products::loadProductByProId($masp);
                                    if( $p->onsale ){
                                        $amount = $p->salesprice * $solg;
                                        $detail = new OrderDetail(-1, $o->getOrderID(), $masp, $solg, $p->salesprice, $amount);
                                    }else{
                                        $amount = $p->getPrice() * $solg;
                                        $detail = new OrderDetail(-1, $o->getOrderID(), $masp, $solg, $p->getPrice(), $amount);
                                    }
                                    $detail->add();
                                }

                                // huỷ giỏ hàng
                                unset($_SESSION['Cart']);
                                flash( 'message', 'Đặt hàng thành công!', 'text-success' );
                                
                                // nạp lại trang hiện tại

                                $query = $_SERVER['PHP_SELF'];
                                $path = pathinfo($query);
                                $url = $path['basename'];
                               // Utils::RedirectTo($url);
								//echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP META
								echo '<div class="" id="msg-flash">Đặt hàng thành công!</div>';
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
                                $total = 0;
								if( !empty( $_SESSION['Cart'] ))  
                                foreach ($_SESSION['Cart'] as $masp => $soluong){
                                $p = Products::loadProductByProId($masp);
                                ?>
                                <tr align="center">
                                <td><?php echo $p->getProName(); ?></td>
                                <td><?php if( $p->onsale ){ echo number_format($p->salesprice); }else{ echo number_format($p->getPrice() ); }?></td>
                                <td><input type="text" id="sl_<?php echo $masp; ?>" name="sl_<?php echo $masp; ?>" style="width: 60px" value="<?php echo $soluong; ?>" /></td>
                                <td><?php if( $p->onsale ){ echo number_format($p->salesprice * $soluong); }else{ echo number_format($p->getPrice() * $soluong); }?></td>
                                <td><img src="imgs/delete-icon.png" width="16" height="16" alt="Delete" style="cursor: pointer" onclick="putProID('X', <?php echo $masp; ?>);"></td>
                                <td><img src="imgs/save-icon.png" width="16" height="16" alt="Update" style="cursor: pointer" onclick="putProID('S', <?php echo $masp; ?>);"></td>
                                </tr>
                                <?php 
                                if( $p->onsale ){
                                    $total += $p->salesprice * $soluong;

                                }else{

                                    $total += $p->getPrice() * $soluong;
                                }
                                }?>
                            </tbody>
                            </table>
                            
                            <?php if($total != 0) {?>
                                <?php if( !Context::isLogged() ){ ?>
                                <div class="col-md-12 pleft-40">
                                    <div class="col-md-6">
                                        <p>Nếu chưa có tài khoản, bạn vui lòng để lại thông tin liên hệ (tên, số điện thoại) để shop liên hệ giao hàng</p>
                                    </div>
                                    <div class="col-md-6 order-note">
                                        <textarea name='order_note' rows='4' placeholder="Thông tin liên hệ"></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                                <input type="submit" id="btnLapHD" name="btnLapHD" value="Lập hoá đơn" class="blueButton" style="margin-left:50px;" />
                                <?php } ?>
                        </form>
                        </div>
						 </div>
					</div>
				</div>
			</div>

			
		</div>
		<!-- /Content -->
		
        <!-- Footer -->
        <footer id="footer" class="container">
			<div id="main-footer">
				<div class="row">
					<!-- Contact Us -->
					<div class="col-lg-3 col-md-4 col-sm-6 contact-footer-info">
						<h4><i class="fa fa-pagelines" aria-hidden="true"></i>Về chúng tôi</h4>
						<ul class="list-menu info">
							<li><i class="fa fa-map-marker" aria-hidden="true"></i>371 Nguyễn Kiệm, TP.HCM</li>
							<li><i class="fa fa-phone" aria-hidden="true"></i>01202582956</li>
							<li><i class="fa fa-envelope-o" aria-hidden="true"></i>takagraden@gmail.com</li>
							<li><i class="fa fa-skype" aria-hidden="true"></i>takagraden</li>
						</ul>
					</div>
					<!-- /Contact Us -->
					
					<!-- Information -->
					<div class="col-lg-3 col-md-2 col-sm-6">
						<h4><i class="fa fa-pagelines" aria-hidden="true"></i>Tài khoản</h4>
						<ul class="list-menu">
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Đơn hàng </a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Sản phẩm yêu thích</a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Đăng nhập tài khoản</a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Tìm kiếm sản phẩm</a></li>
						</ul>
					</div>
					<!-- /Information -->
					
					
					<div class="col-lg-3 col-md-3 col-sm-6">
						<h4><i class="fa fa-pagelines" aria-hidden="true"></i>Hỗ trợ khách hàng</h4>
						<ul class="list-menu">
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Hướng dẫn đặt hàng</a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Hướng dẫn thanh toán</a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Chính sách vận chuyển</a></li>
							<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Chính sách đổi trả</a></li>
						</ul>
					</div>
					
					<!-- Like us on Social -->
					<div class="col-lg-3 col-md-3 col-sm-6 facebook-iframe">
						<h4><i class="fa fa-pagelines" aria-hidden="true"></i>Hình thức thanh toán</h4>
						<ul class="list-menu">
							<img src="img/payment.png"/>
						</ul>
						<h4><i class="fa fa-pagelines" aria-hidden="true"></i>Mạng xã hội</h4>
						<ul class="footer-social">
							<li class="fb">
								<a href="#" target="_blank">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</li>
							<li class="tt">
								<a href="#" target="_blank">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</li>
							<li class="ins">
								<a href="#" target="_blank">
									<i class="fa fa-instagram" aria-hidden="true"></i>
								</a>
							</li>
							<li class="yt">
								<a href="#" target="_blank">
									<i class="fa fa-youtube" aria-hidden="true"></i>
								</a>
							</li>
							<li class="gp">
								<a href="#" target="_blank">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- /Like us on Social -->
					
				</div>
						
			</div>
			<div id="copyright">&copy; Bản quyền thuộc về <b>Taka Graden</b></div>
        </footer>
		<!-- /Footer -->
        
        <!-- Backtotop -->
        <div class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
		<!-- /Backtotop -->
            
		<!-- Javascript -->
		<script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/main-script.js"></script>

        <!-- InstanceBeginEditable name="head" -->
        <script type="text/javascript">
            function putProID(cmd, masp) {
                $("#hCmd").val(cmd);
                $("#hProId").val(masp);

                document.fr.submit();
            }
        </script>
        <script type="text/javascript">
            $("#total").html("Tổng tiền: <?php echo number_format($total); ?>");
        </script>
        <!-- InstanceEndEditable -->
	</body>
</html>