
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>

<script type="text/javascript">
    document.title='Add Catalogy | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    $name = "";
                                    if(isset($_POST['submit'])){
                                        $name = $_POST['tentruyen'];
                                        $sqlAddCat = "INSERT INTO cat(name) VALUES('$name')";
                                        $resultAddCat = $mysqli->query($sqlAddCat);
                                        if($resultAddCat==true){
                                            header('location:/admin/cat/index.php?msg=success');
                                            echo "Thêm danh mục thành công";

                                        }   else echo "Có lỗi khi thêm";
                                    }                                   
                                   
                                ?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="tentruyen" class="form-control" value="<?php echo $name;?>" />
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>