<?php
require_once DOCUMENT_ROOT . '/entities/Products.php';
require_once DOCUMENT_ROOT . '/entities/Order.php';

$id = $_GET["id"];
$order = Order::loadOrderbyId($id);
// load order detail
$orderDetail = Order::loadOrderDetail($id);
print_r($orderDetail);die();


?>

<?php 

if(isset($_POST['editOrder'])){
    
    header("Refresh:0");
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>User</label>
                            <input type="text" name="user" class="form-control"
                                   value="<?php echo $order->userID; ?>" disabled>
                            <input type="hidden" name="type" class="form-control" value="edit">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $order->orderID; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="orderDate" class="form-control" disabled
                                   value="<?php echo $order->orderDate; ?>">
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" class="form-control"
                                   value="<?php echo $order->total; ?>">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea type="text" rows="5" name="note" class="form-control"
                                   value="<?php echo $order->note; ?>"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="0" <?php if($order->status == 0) echo 'selected'; ?> >Pending</option>
                                <option value="1" <?php if($order->status == 1) echo 'selected'; ?>>Completed</option>
                                <option value="2" <?php if($order->status == 2) echo 'selected'; ?>>Cancel</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="editOrder" class="btn btn-success">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



