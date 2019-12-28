
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CommonConstant.php'; ?>

<script type="text/javascript">
    document.title='Catalogy | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
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
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="addCat.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <?php
                                    if(isset($_GET['msg'])){
                                        echo "Success!";
                                    }
                                ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                         <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sqlCat = "SELECT cat_id, name FROM cat ORDER BY cat_id DESC";
                                        $result = $mysqli->query($sqlCat);
                                        while($arCat = mysqli_fetch_array($result)){
                                            $catId = $arCat['cat_id'];
                                            $name = $arCat['name'];
                                            $urlDel = "/bstory/admin/cat/del.php?id={$catId}";
                                            $urlEdit = "/bstory/admin/cat/edit.php?id={$catId}";
                                    ?>
                                    <tr class="<?php echo $cl?> gradeX">
                                        <td><?php echo $catId ?></td>
                                        <td><?php echo $name; ?></td>
                                         <td class="center">
                                            <a href="<?php echo $urlEdit?>" title="" class="btn btn-primary"><i class="fa fa-edit" onclick=""></i> Sửa</a>

                                            <a href="<?php echo $urlDel;?>" title="" class="btn btn-danger"><i class="fa fa-pencil" onclick="return confirm('Bạn có chắc muốn xóa không?')"></i> Xóa</a>
                                        </td>
                                   <?php }?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px"></div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Trang trước</a></li>

                                            <li class="" aria-controls="dataTables-example" tabindex="0">
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
         $("#cat-admin").addClass('active-menu');
    });
</script>