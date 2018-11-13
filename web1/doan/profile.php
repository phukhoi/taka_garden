<?php
session_start();

if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
}
require_once '/entities/categories.php';
require_once '/entities/classify.php';
require_once '/helper/Utils.php';
require_once '/entities/Products.php';
require_once '/helper/CartProcessing.php';
require_once '/helper/Context.php';



$categories = categories::loadAll();

?>
<?php
	if (!isset($_SESSION['Cart'])) {
		$_SESSION['Cart'] = array();
	}
?>
<?php 
if(isset($_POST["btnSearch"]))
{
	$value = str_replace("'","",$_POST['txtSearch']);
	$value = str_replace("  ","",$value);
	$value = str_replace(" ","%",$value);

	$url ="search.php?nsx=".$_POST['selectHSX']."&value=".$value."&gia=".$_POST['selectGia'];
	Utils::RedirectTo($url);
}
?>
<!-- InstanceBeginEditable name="EditRegion4" -->

        <?php
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
                            <div class="logo"><a href="home.html"><abbr title="Logo"><img src="img/logo-small.png" /></abbr></a> </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="search">
                                <form id="frSearch" name="frSearch" class="search-form" action="" method="post">
                                    <input class="s-input" name="txtSearch" type="text" id="txtSearch" placeholder="Tìm kiếm sản phẩm..." />
                                    <button id="btnSearch" name="btnSearch" class="btn-search" type="submit">
                                    	<span>Tìm kiếm</span>
                                    </button>
									<input name="selectHSX" type="text" value='0' class="hidden" id="selectHSX" >
									<input name="selectGia" type="text" value='100000000' class="hidden" id="selectGia" >
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
				<form id="form1" name="form1" method="post" action="">
				<input type="hidden" id="txtMaSP" name="txtMaSP" />
				</form>		
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
		<script type="text/javascript">
			function putProID(masp) {
				$("#txtMaSP").val(masp);
				document.form1.submit();
			}
		</script>
	</body>
</html>