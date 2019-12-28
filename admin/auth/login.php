
<?php require_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/FileUtils.php'; ?>


<script type="text/javascript">
    document.title='Login | VinaEnter Edu';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Đăng nhập</h2>
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
                                        $name = $_POST['name'];
                                        $pass = $_POST['password'];
                                        $sql = "SELECT * FROM users WHERE username = '{$name}' AND password='{$pass}'";
                                        $result = $mysqli->query($sql);
                                        $arUser = mysqli_fetch_array($result);
                                       if(count($result)>0){
                                        $_SESSION['arUser'] = $arUser;
                                        header('location:../index.php');
                                       }else {
                                        echo "Sai name hoặc password";
                                       }
                                    }                                   
                                   
                                ?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="name" class="form-control" />
                                         <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Đăng nhập</button>
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';?>
                                   
