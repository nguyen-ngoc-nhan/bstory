<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/utils/CommonConstant.php'; ?>

<?php 
//Tổng số dòng
    $queryTSD = "SELECT COUNT(*) as TSD FROM story";
    $resultTSD = $mysqli->query($queryTSD);
    $arTmp = mysqli_fetch_assoc($resultTSD);
    $tongSoDong = $arTmp['TSD'];
    //Số truyện 1 trang
    $row_count = ROW_COUNT;
    //tổng số trang
    $tongSoTrang = ceil($tongSoDong/$row_count);
    //trang hiện tại 
    $current_page = 1;
    if(isset($_GET['page'])){
      $current_page = $_GET['page'];
    }
    //offset
    $offset = ($current_page-1)*$row_count;
?>

<script type="text/javascript">
    document.title='Story | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý truyện</h2>
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
                                <div class="col-sm-6">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="timkiem.php">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="name" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
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
                                        $sqlStory = "SELECT s.*,c.name as nameCat FROM story as s INNER JOIN cat as c ON c.cat_id=s.cat_id ORDER BY s.story_id DESC LIMIT {$offset},{$row_count} ";
                                        $resultStory = $mysqli->query($sqlStory);
                                        while($arStory = mysqli_fetch_array($resultStory)){
                                            $storyId = $arStory['story_id'];
                                            $name = $arStory['name'];
                                            $counter = $arStory['counter'];
                                            $nameCat = $arStory['nameCat'];
                                            $picture = $arStory['picture'];
                                            $urlDel = "/admin/story/del.php?id={$storyId}";
                                            $urlEdit = "/admin/story/edit.php?id={$storyId}";
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
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px"></div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                           <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">Trang trước</span>
                                          </a>
                                        </li>

                                        <li class="page-item page">

                                            <?php 
                                            for($i=1; $i<=$tongSoTrang; $i++){
                                            ?>
                                            <?php
                                              if($i != $current_page){
                                            ?>
                                               <a class="page-link" href="index.php?page=<?php echo $i?>"><?php echo $i;?></a>
                                            <?php } else {?>
                                                 
                                                  <span> <?php echo $i;?></span> 
                                            <?php } ?>
                                        <?php } ?>
                                        </li>
                                        <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">Trang tiếp</span>
                                          </a>
                                        </li>
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