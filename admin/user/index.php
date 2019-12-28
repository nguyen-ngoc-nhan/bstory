
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CommonConstant.php'; ?>

<script type="text/javascript">
    document.title='User | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý người dùng</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        
        <div class="row">
            <div class="col-md-12">
               
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
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
                                        <th>Username</th>
                                        <th>Fullname</th>
                                         <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sqlUser = "SELECT * FROM users ";
                                        $resultUser = $mysqli->query($sqlUser);
                                        while($arUser = mysqli_fetch_array($resultUser)){
                                            $userId = $arUser['id'];
                                            $userName = $arUser['username'];
                                            $userFullname = $arUser['fullname'];
                                            $urlDel = "/admin/user/del.php?id={$userId}";
                                            $urlEdit = "/admin/user/edit.php?id={$userId}";
                                    ?>
                                    <tr class="<?php echo $cl?> gradeX">
                                        <td><?php echo $userId ?></td>
                                        <td><?php echo $userName; ?></td>
                                        <td><?php echo $userFullname; ?></td>
                                         <td class="center">
                                            <?php
                                                if($userName!='admin'||$_SESSION['arUser']['username']=='admin'){
                                            ?>
                                            <a href="<?php echo $urlEdit?>" title="" class="btn btn-primary"><i class="fa fa-edit" onclick=""></i> Sửa</a>
                                        <?php }?>
                                            <?php 
                                                if($userName!='admin'){
                                            ?>
                                            <a href="<?php echo $urlDel;?>" title="" class="btn btn-danger"><i class="fa fa-pencil" onclick="return confirm('Bạn có chắc muốn xóa không?')"></i> Xóa</a>
                                            <?php }?>
                                        </td>
                                   <?php }?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px"></div>
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
         $("#user-admin").addClass('active-menu');
    });
</script>