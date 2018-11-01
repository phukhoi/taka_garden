<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                   <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a   href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  href="products.php"><i class="fa fa-car fa-3x"></i></i> Products</a>
                    </li>	
                      <li  >
                        <a class="active-menu" href="orders.php"><i class="fa fa-table fa-3x"></i> Orders s</a>
                    </li>
                    <li  >
                        <a  href="user.php"><i class="fa fa-user fa-3x"></i> Users</a>
                    </li>		
                     <li  >
                        <a   href="registeration.html"><i class="fa fa-laptop fa-3x"></i> Registeration</a>
                    </li>	
					                   
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i>Control <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li>	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Table Orders</h2>   
                        
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Orders Tables
                        </div>
                         <?php
                        require_once '../help/DataProvider.php';
                      require_once '../class/Order.php';
					   require_once '../class/OrderDetail.php';
                        $list = Order::loadAll();
                            $n = count($list);

                      ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>OrderDate</th>
                                            <th>UserID</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Saled</th>
                                        </tr>
                                    </thead>
                                      <?php
    for ($i = 0; $i < $n; $i++) {
        ?>
                                    <tbody>
                                        <tr class="odd gradeX"> 
                                            <td><?php echo $list[$i]->getOrderID(); ?></td>
                                            <td><?php echo date('j/n/Y', $list[$i]->getOrderDate()); ?></td>
                                            <td><?php echo $list[$i]->getUserID(); ?></td>
                                            <td class="center"><?php echo  $list[$i]->getTotal(); ?> USD</td>
                                            <td class="center">&nbsp;</td>
                                            <td class="center">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                        <?php
                                }
                                ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            <div class="row">
                  <!--   Kitchen Sink -->
                   <?php
                    $list1 = OrderDetail::loadAll();
                            $a = count($list1);
                      ?>
                        <div class="panel-heading">
                           OrderDetails
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>OrderID</th>
                                            <th>ProID</th>
                                            <th>Quanti ty</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                            <?php
    for ($k = 0; $k < $a; $k++) {
        ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $list1[$k]->getId(); ?></td>
                                            <td><?php echo $list1[$k]->getOrderID(); ?></td>
                                            <td><?php echo $list1[$k]->getProID(); ?></td>
                                            <td><?php echo $list1[$k]->getQuantity(); ?></td>
                                            <td><?php echo $list1[$k]->getPrice(); ?> USD</td>
                                            <td><?php echo $list1[$k]->getAmount(); ?> USD</td>
                                        </tr>
                                    </tbody>
                                           <?php
                                }
                                ?>
                                </table>
                            </div>
                        </div>
                    
                     <!-- End  Kitchen Sink -->
               
            </div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
