<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

<script type="text/javascript">
    document.title='Delete User | VinaEnter Edu';
</script>

<?php
    if(isset($_GET['id'])){
        //get id form url
        $userId = $_GET['id'];
        //handler inser db
        $sqlUser = "SELECT * FROM users  WHERE id={$idUser}";
        $resultUser = $mysqli->query($sqlUser);
        $arUser = mysqli_fetch_array($resultUser);
        if($arUser['username']=='admin'||$_SESSION['arUser']['username']!='admin'){
            header('location:index.php?msg="Bạn không có quyền sửa admin!"');
         }
        $sqlDelUser = "DELETE FROM users WHERE id={$userId}";
            $resultDelUser = $mysqli->query($sqlDelUser);
            if($resultDelUser==true){
                header('location:/admin/user/index.php?msg=success');
                echo "Xoá danh mục thành công";

            }   else echo "Có lỗi khi xóa";

    } else {
        header('location:/bstory');
    }
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>