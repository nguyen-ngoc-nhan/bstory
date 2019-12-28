<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

<script type="text/javascript">
    document.title='Delete Catalogy | VinaEnter Edu';
</script>
<?php
    if(isset($_GET['id'])){
        //get id form url
        $catId = $_GET['id'];
        //handler inser db
        $sqlDelCat = "DELETE FROM cat WHERE cat_id={$catId}";
            $resultDelCat = $mysqli->query($sqlDelCat);
            if($resultDelCat==true){
                header('location:/admin/cat/index.php?msg=success');
                echo "Xoá danh mục thành công";

            }   else echo "Có lỗi khi xóa";

    } else {
        header('location:/bstory');
    }
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>