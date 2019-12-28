<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>

<script type="text/javascript">
    document.title='Edit Catalogy | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa Danh mục</h2>
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
                                if(isset($_GET['id'])){
                                    $idCat = $_GET['id'];
                                }
                                    $sqlCat = "SELECT cat_id, name FROM cat  WHERE cat_id={$idCat}";
                                        $resultCat = $mysqli->query($sqlCat);
                                        $arCat = mysqli_fetch_array($resultCat);
                                        $nameOld = $arCat['name'];

                                         $name = "";
                                    if(isset($_POST['submit'])){
                                        $name = $_POST['tendanhmuc'];
                                        $sqlEditCat = "UPDATE cat SET name='{$name}' WHERE cat_id={$idCat}";
                                        $resultEditCat = $mysqli->query($sqlEditCat);
                                        if($resultEditCat==true){
                                            header('location:/admin/cat/index.php?msg=success');
                                            echo "Thêm danh mục thành công";

                                        }   else {
                                            $nameOld = $name;
                                            echo "Có lỗi khi sửa, vui lòng thử lại!";
                                        }
                                    }                                   
                                   
                                ?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="tendanhmuc" class="form-control" value="<?php echo $nameOld;?>" />
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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