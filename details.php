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
// đặt hàng
if (isset($_POST["btnDatHang"])) {
	$masp = $_GET["proID"];
	$solg = $_POST["txtSoLuong"];
	CartProcessing::addItem($masp, $solg);
}

$categories = categories::loadAll();
$p_proId = $_GET["proID"];
$product = Products::loadProductByProId($p_proId);

$relatedProduct  = Products::loadProductsByCatId($product->catId);
?>

<?php
	if (!isset($_SESSION['Cart'])) {
		$_SESSION['Cart'] = array();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Taka Graden - Products </title>
		<meta charset="UTF-8">
		<meta name="keywords" content="html,htm5,web">
		<meta name="description" content="Do an web, products, san pham">
		<link href="img/logog.png" rel="shourtcut icon" />
		
		<!-- Style CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
	
  
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
									<li ><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:01202582956">Hotline: 01202582956</a></li>
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
                                <a href="#">
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
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="breadcrumbs">
							<p>
								<a href="index.php">Trang chủ</a> 
								<i class="fa fa-caret-right"></i> 
								<a href="#">Sản phẩm</a> 
								<i class="fa fa-caret-right"></i>
								Xương rồng
							</p>
						</div>
					</div>
				</div>
				<div class="row">
               		<div class="sidebar col-md-3 col-sm-3 col-xs-12">
						<div class="side-box dmsp">
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
						
						<div class="side-box related-prod">
							<div class="side-box-heading">
								<i class="fa fa-star-o" aria-hidden="true"></i>
								<h4>Sản phẩm liên quan</h4>
							</div>
							<div class="side-box-content">
								<table class="related-table">
									<tbody>
                                        <?php 
                                        for($i = 0; $i < 4; $i++){
                                            
                                        ?>
										<tr>
											<td class="product-thumbnail"><a href="details.php?proID=<?php echo $relatedProduct[$i]->proId;?>"><img src="imgs/products/<?php echo $relatedProduct[$i]->proId;;?>/1.jpg" alt="Product1"></a></td>
											<td class="product-info">
												<p><a href=""><?php echo $relatedProduct[$i]->proName?></a></p>
												<span class="price"> <?php echo number_format($relatedProduct[$i]->price) ?> VND</span>
											</td>
										</tr>
                                        <?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9">
                        	<div class="details-product">
                                <div class="col-md-6 images-pro">
                                  <abbr title="Hoa xương rồng"><img src="imgs/products/<?php echo $product->proId;;?>/1.jpg" style="max-width:400px"></abbr>
                                </div>
                                <div class="col-md-6 details-pro">
                                	<h2><?php echo $product->proName ?></h2>
                                    <p class="price-pro">Giá: <span><?php echo number_format($product->price); ?> VND </span></p>
                                    <!-- <p class="price-pro">Giá: <span>50.000VND </span><del>69.000VND</del></p> -->
                                    <p class="in-stock">Tình trạng: <?php echo $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' ?></p>
                                    <?php 
                                    if( $product->quantity > 0 ){
                                    ?>
										<form id="fr"  name="fr" method="post" action="">
											<p class="number">Số lượng: <input type="number" id="txtSoLuong" name="txtSoLuong" min="0" style="width:50px" value="0"/></p>
											<input id="btnDatHang" name="btnDatHang" type="submit" value="Thêm vào giỏ hàng " class="blueButton" />
										</form>
                                    <?php }?>
                                </div>
                         	</div>
							<div class="tab-wrapper">
								<ul class="tab">
									<li>
										<a href="#tab-main-info">Chi tiết sản phẩm</a>
									</li>
									<li>
										<a href="#tab-image">Hình ảnh</a>
									</li>
									<li>
										<a href="#tab-seo">Đánh giá sản phẩm</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-item" id="tab-main-info">
										<?php echo $product->fullDes; ?>
									</div>
									<div class="tab-item" id="tab-image">
										Hình ảnh về cây xương rồng...
									</div>
									<div class="tab-item" id="tab-seo">
										Nội dung đánh giá đang được cập nhật...
									</div>
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
		
	</body>
</html>