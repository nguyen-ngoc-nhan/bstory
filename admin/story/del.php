<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<script type="text/javascript">
    document.title='Delete Story | VinaEnter Edu';
</script>

<?php
    if(isset($_GET['id'])){
        //get id form url
        $storyId = $_GET['id'];
        //delete file
         $sqlGetStory = "SELECT picture FROM story WHERE story_id={$storyId}";
         $resultGetStory = $mysqli->query($sqlGetStory);
         $arStory = mysqli_fetch_assoc($resultGetStory);
         $oldPicture = $arStory['picture'];
         if($oldPicture!=''){
            $pathUpload = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$oldPicture;
            unlink($pathUpload);
         }
         /*if(!empty())*/
        //handler inser db
        $sqlDelStory = "DELETE FROM story WHERE story_id={$storyId}";
        $resultDelStory = $mysqli->query($sqlDelStory);
            if($resultDelStory==true){
                header('location:/admin/story/index.php?msg=success');
                echo "Xoá danh mục thành công";

            }   else echo "Có lỗi khi xóa";

        } else {
        header('location:/bstory');
    }
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>