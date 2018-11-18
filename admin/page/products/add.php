<?php
require_once DOCUMENT_ROOT . '/entities/Products.php';
require_once DOCUMENT_ROOT . '/entities/categories.php';
$cate = categories::loadAll();
// $pro = new Products();
if (isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'add') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    $param = [
        'ProName' => $_POST['ProName'],
        'CatID' => $_POST['CatID'],
        'Price' => $_POST['Price'],
        'TinyDes' => $_POST['TinyDes'],
        'FullDes' => $_POST['FullDes'],
        'Quantity' => $_POST['Quantity']
    ];
    $pro_new = Products::saveProducts($param);
    header("Location: /admin&act=products&alert=success");
    die();
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
                            <label>ProName</label>
                            <input type="text" name="ProName" class="form-control">
                            <input type="hidden" name="type" class="form-control" value="add">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="Quantity" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="Price" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                            <label>TinyDes</label>
                            <textarea id="editor1" name="TinyDes" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>FullDes</label>
                            <textarea id="editor2" name="FullDes" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" name="CatID">
                                <?php if (isset($cate)) { ?>
                                    <?php for ($i = 0; $i < count($cate); $i++) { ?>
                                        <option value="<?php echo $cate[$i]->getCatId(); ?>">
                                            -- <?php echo $cate[$i]->getCatName(); ?></option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="0">NULL</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



