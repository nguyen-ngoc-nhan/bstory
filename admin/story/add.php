<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/FileUtils.php'; ?>

<script type="text/javascript">
    document.title='Add Story | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Truyện</h2>
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
                                    $name="";
                                    $previewText="";
                                    $detailText="";
                                    if(isset($_POST['submit'])){
                                        $name = $_POST['name'];
                                        $catId = $_POST['cat_id'];
                                        $previewText = $_POST['preview_text'];
                                        $detailText = $_POST['detail_text'];

                                        $arFile = $_FILES['picture'];


                                        $fileName = $arFile['name'];

                                        if($fileName!=''){
                                            //change file name
                                            $fileName = renameFile($fileName);

                                            $tmpName = $arFile['tmp_name'];
                                            $pathUpload = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$fileName;
                                            move_uploaded_file($tmpName,$pathUpload);
                                        }

                                        //Insert into database
                                        $sqlAddStory = "INSERT INTO story (name, preview_text,detail_text,picture,cat_id) VALUES ('{$name}','{$previewText}','{$detailText}','{$fileName}',{$catId})";
                                        $resultAddStory = $mysqli->query($sqlAddStory);
                                        if($resultAddStory){
                                            header('location:/admin/story?msg=success');
                                        }else {
                                            echo "Có lỗi trong quá trình thêm, vui lòng thử lại";
                                        }

                                    }
                                ?>
                                <form role="form" action="" enctype="multipart/form-data" method="POST" id="frmAdd">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $name?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat_id">
                                        <?php 
                                            $sqlCat = "SELECT cat_id, name FROM cat ORDER BY cat_id DESC";
                                             $result = $mysqli->query($sqlCat);
                                             $selected = "";
                                             while($arCat = mysqli_fetch_array($result)){
                                                $itemCatId = $arCat['cat_id'];
                                                $nameCat = $arCat['name'];
                                                if($catId==$itemCatId){
                                                    $selected = "selected='selected'";
                                                }else{
                                                    $selected ="";
                                                }
                                        ?>
                                                <option <?php echo $selected;?> value="<?php echo $itemCatId?>"><?php echo $nameCat;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea id="txt1" class="form-control" rows="3" name="preview_text" value="<?php echo $previewText?>"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="txt2" class="form-control" rows="5" name="detail_text"  value="<?php echo $detailText?>"></textarea>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                       $('#frmAdd').validate({
                                            rules:{
                                                name:{
                                                    required : true,
                                                },
                                                cat_id:{
                                                    required : true,
                                                },
                                                

                                            },
                                            messages:{
                                                name:{
                                                    required: "Bạn chưa nhập tên!",
                                                },
                                                cat_id:{
                                                    required: "Bạn chưa chọn catId!",
                                                },
                                                }

                                        });
                                    });
                                    CKEDITOR.replace('txt1');
                                    CKEDITOR.replace('txt2');
                                </script>



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