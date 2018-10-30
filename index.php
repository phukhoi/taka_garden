<?php 
	require "/functions.php";	
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
									<li><i class="fa fa-user" aria-hidden="true"></i><a href="#">Đăng nhập</a></li>
									<li style="margin-right: 0;"><i class="fa fa-lock" aria-hidden="true"></i><a href="#">Đăng ký</a></li>
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
                                <a href="home.html">
                                    <span class="nav-caption">Trang chủ</span>
                                </a>
                            </li>
                            <li>
                                <a href="home.html">
                                    <span class="nav-caption">Giới thiệu</span>
                                </a>
                            </li>
                            <li class="submenu">
                                <a href="category.html" id="idMenu">
                                    <span class="nav-caption">Sản phẩm</span>
                                </a>
                                <ul class="sub_menu" >
                                    <li><a href="category.html">Sen đá</a>
                                    </li>
                                    <li><a href="category.html">Xương Rồng</a>
                                    </li>
                                    <li><a href="category.html">Terrarium</a>
                                    </li>
                                    <li><a href="category.html">Chậu</a>
                                    </li>
                                    <li><a href="category.html">Phụ kiện trang trí</a>
                                    </li>
                                    <li><a href="category.html">Sản phẩm bán chạy</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <span class="nav-caption">Tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">
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
									<li><a href="category.html">Sen đá</a></li>
									<li><a href="category.html">Xương rồng</a></li>
									<li><a href="category.html">Terrarium</a></li>
									<li><a href="category.html">Chậu</a></li>
									<li><a href="category.html">Phụ kiện trang trí</a></li>
									<li><a href="category.html">Sản phẩm bán chạy</a></li>
									<li><a href="category.html">Sản phẩm nổi bật</a></li>
									<li><a class="purple" href="category.html">Tất cả sản phẩm</a></li>
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
							<div class="prod-title">
								<h2>Sen đá</h2>
							</div>
							<div class="prod-content">
								<div class="row">
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            	<span class="label_news "><span class="bf_">Mới</span></span>
												<img src="img/products/Sen da/Sen da 1.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Sen thơm</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            	
												<img src="img/products/Sen da/Sen Đất xanh.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Sen Đất xanh</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            	<span class="sale_count"><span class="bf_">- 7% </span></span>
												<img src="img/products/Sen da/Sen Đô La.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Sen Đô La</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
												<img src="img/products/Sen da/Sen Thược Dược.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Sen Thược Dược</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						 </div>
					</div>
				</div>
			</div>
			
			<div class="content-product xuongrong">

				<div class="container">
                    <div class="row">
						 <div class="col-md-12 col-sm-12 col-xs-12">
							<div class="prod-title">
								<h2>Xương rồng</h2>
							</div>
							<div class="prod-content">
								<div class="row">
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                             <span class="sale_count"><span class="bf_">- 10% </span></span>
												<img src="img/products/Xuong rong/Gymno.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Gymno</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                           		
												<img src="img/products/Xuong rong/Thiên nga.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Thiên nga</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
												<img src="img/products/Xuong rong/Thần long mini.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Thần long mini</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            	<span class="label_news "><span class="bf_">Mới</span></span>
												<img src="img/products/Xuong rong/Trứng chim.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Trứng chim</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						 </div>
					</div>
				</div>
			</div>
			
			<div class="content-product terrarium">
				<div class="container">
                    <div class="row">
						 <div class="col-md-12 col-sm-12 col-xs-12">
							<div class="prod-title">
								<h2>Terrarium</h2>
							</div>
							<div class="prod-content">
								<div class="row">
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
                                        	
											<div class="item-thumb">
												<img src="img/products/Terrarium/Terrarium Red Car.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Terrarium Red Car</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            <span class="label_news "><span class="bf_">Mới</span></span>
												<img src="img/products/Terrarium/Terrarium Vespa.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Terrarium Vespa</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                            
												<img src="img/products/Terrarium/Terrarium Yell Car.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Terrarium Yell Car</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-3 col-sm-3 col-xs-6">
										<div class="prod-item">
											<div class="item-thumb">
                                           		 	
                                                 <span class="sale_count"><span class="bf_">- 5% </span></span>
												<img src="img/products/Terrarium/Terrarium Pink Car.jpg" alt="Product1">
											</div>
											<div class="item-info">
												<h5><a href="products.html">Terrarium Pink Car</a></h5>
												<span class="price">50.000 VND</span>
											</div>
										</div>
									</div>
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