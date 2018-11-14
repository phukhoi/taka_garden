<?php
require_once DOCUMENT_ROOT . '/entities/Products.php';
require_once DOCUMENT_ROOT . '/entities/categories.php';
$cate = categories::loadAll();
$p_proId = $_GET["id"];
$product = Products::loadProductByProId($p_proId);
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
                            <input type="text" name="ProName" class="form-control"
                                   value="<?php echo $product->proName; ?>">
                            <input type="hidden" name="type" class="form-control" value="edit">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $product->proId; ?>">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="Quantity" class="form-control"
                                   value="<?php echo $product->quantity; ?>">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="Price" class="form-control"
                                   value="<?php echo $product->price; ?>">
                        </div>
                        <div class="form-group">
                            <label>TinyDes</label>
                            <textarea id="editor1" name="TinyDes" rows="10"
                                      cols="80"><?php echo $product->tinyDes; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>FullDes</label>
                            <textarea id="editor2" name="FullDes" rows="10"
                                      cols="80"><?php echo $product->fullDes; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" name="catId">
                                <?php if (isset($cate)) { ?>
                                    <?php for ($i = 0; $i < count($cate); $i++) { ?>
                                        <option value="<?php echo $cate[$i]->getCatId(); ?>" <?php if ($cate[$i]->getCatId() == $product->catId) { ?> selected<?php } ?>>
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
                            <button type="submit" class="btn btn-success">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



