<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Kết quả tìm kiếm</h2>
            </div
        </div>
        <!-- /. ROW  -->
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                
                               
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Lượt đọc</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                       if(isset($_POST['search'])){
                                            $name = $_POST['name'];
                                            $sqlSearch = "SELECT s.*,c.name as nameCat FROM story as s INNER JOIN cat as c ON c.cat_id=s.cat_id WHERE s.name = '{$name}'";
                                            $resultSearch = $mysqli->query($sqlSearch);
                                            

                                             while($arSearch = mysqli_fetch_array($resultSearch)){
                                            $storyId = $arSearch['story_id'];
                                            $name = $arSearch['name'];
                                            $counter = $arSearch['counter'];
                                            $nameCat = $arSearch['nameCat'];
                                            $picture = $arSearch['picture'];
                                            $urlDel = "/admin/story/del.php?id={$storyId}";
                                            $urlEdit = "/admin/story/edit.php?id={storyId}";
                                           
                                    ?>
                                    <tr class="<?php echo $cl?> gradeX">
                                        <td><?php echo $storyId?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $nameCat;?></td>
                                        <td class="center"><?php echo $counter;?></td>
                                        <td class="center">
                                            <?php
                                                if($picture != ''){
                                            ?>
                                            <img src="/files/<?php echo $picture?>" alt="" height="80px" width="100px" />
                                        <?php } else{?>
                                            <strong>Không có hình</strong>
                                        <?php }?>
                                        </td>

                                        <td class="center">
                                            <a href="<?php echo $urlEdit?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="<?php echo $urlDel?>" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    <?php } }?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ 1 đến 5 của 24 truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Trang trước</a></li>
                                            <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li>
                                            <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Trang tiếp</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function(){
         $("#story-admin").addClass('active-menu');
    });
</script>