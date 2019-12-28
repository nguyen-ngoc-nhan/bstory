<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/FileUtils.php'; ?>

<script type="text/javascript">
    document.title='Edit Story | VinaEnter Edu';
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
                                    $idStory = $_GET['id'];
                                }
                               

                                $sqlStory = "SELECT * FROM story  WHERE story_id={$idStory}";
                                $resultStory = $mysqli->query($sqlStory);
                                $arStory = mysqli_fetch_array($resultStory);
                                $nameOld = $arStory['name'];
                                $previewTextOld = $arStory['preview_text'];
                                $detailTextOld = $arStory['detail_text'];

                                $name = "";
                                
                                if(isset($_POST['submit'])){
                                    
                                   

                                    $name = $_POST['name'];
                                    $catId = $_POST['cat_id'];
                                    $previewText = $_POST['preview_text'];
                                    $detailText = $_POST['detail_text'];

                                    $arFile = $_FILES['picture'];


                                    $fileName = $arFile['name'];

                                    if($fileName!=''){
                                         $oldPicture = $arStory['picture'];
                                        if($oldPicture!=''){
                                        $pathUpload1 = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$oldPicture;
                                        unlink($pathUpload1);
                                    }
                                        //change file name
                                        $fileName = renameFile($fileName);

                                        $tmpName = $arFile['tmp_name'];
                                        $pathUpload = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$fileName;
                                        move_uploaded_file($tmpName,$pathUpload);
                                   
                                       
                                    }else $fileName = $arStory['picture'];

                                    //Insert into database
                                    $sqlEditStory = "UPDATE story SET name='{$name}', preview_text='{$previewText}',detail_text='{$detailText}',picture='{$fileName}', cat_id={$catId} WHERE story_id={$idStory}";
                                    $resultEditStory = $mysqli->query($sqlEditStory);
                                    if($resultEditStory){
                                        header('location:/admin/story?msg=success');
                                    }else {
                                        $nameOld = $name;
                                        $previewTextOld = $previewText;
                                        $detailTextOld = $detailText;
                                        echo "Có lỗi trong quá trình chỉnh sửa, vui lòng thử lại";
                                    }

                                }
                                ?>
                                <form role="form" action="" enctype="multipart/form-data"  method="POST">
                                   <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $nameOld?>" />
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
                                        <img src="/files/<?php echo $arStory['picture']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea id="txt1" class="form-control" rows="3" name="preview_text" value="<?php echo $previewTextOld?>"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="txt2" class="form-control" rows="5" name="detail_text"  value="<?php echo $detailTextOld?>"></textarea>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Edit</button>
                                </form>

                                <script type="text/javascript">
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