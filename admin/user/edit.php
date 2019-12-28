<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>

<script type="text/javascript">
    document.title='Edit User | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa Người dùng</h2>
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
                                    $idUser = $_GET['id'];
                                }
                                    $sqlUser = "SELECT * FROM users  WHERE id={$idUser}";
                                        $resultUser = $mysqli->query($sqlUser);
                                        $arUser = mysqli_fetch_array($resultUser);
                                        $nameOld = $arUser['username'];
                                        $fullNameOld = $arUser['fullname'];

                                         $name = "";
                                         $fullName = "";
                                         if($arUser['username']=='admin'||$_SESSION['arUser']['username']!='admin'){
                                            header('location:index.php?msg="Bạn không có quyền sửa admin!"');
                                         }
                                    if(isset($_POST['submit'])){
                                        $name = $_POST['name'];
                                        $fullName = $_POST['fullname'];
                                        $password = $_POST['password'];
                                        $sqlEditUser = "UPDATE users SET username='{$name}',password='{$password}',fullname='{$fullName}' WHERE id={$idUser}";
                                        $resultEditUser = $mysqli->query($sqlEditUser);
                                        if($resultEditUser==true){
                                            header('location:/bstory/admin/user/index.php?msg=success');
                                            echo "Thêm danh mục thành công";

                                        }   else {
                                            $nameOld = $name;
                                            $fullNameOld = $fullName;
                                            echo "Có lỗi khi sửa, vui lòng thử lại!";
                                        }
                                    }                                   
                                   
                                ?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $nameOld;?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $fullNameOld;?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"  />
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