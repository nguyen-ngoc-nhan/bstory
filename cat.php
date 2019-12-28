<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/header.php'; ?>
<?php 
    $id_cat = $_GET['id'];
    $query = "SELECT * FROM cat WHERE cat_id={$id_cat}";
    $ketqua = $mysqli->query($query);
    $arCat = mysqli_fetch_assoc($ketqua);

?>
<script type="text/javascript">
    document.title='<?php echo $arCat['name'];?>';
</script>
<div class="content_resize">
  <div class="mainbar">
     <h1><?php echo $arCat['name'];?></h1>
    <?php
      $query1 = "SELECT * FROM story WHERE cat_id={$id_cat}";
      $ketqua1 = $mysqli->query($query1);
      while ($arStory=mysqli_fetch_assoc($ketqua1)) {
        $id_story = $arStory['story_id'];
        $name = $arStory['name'];
        $date_create = $arStory['created_at'];
        $counter = $arStory['counter'];
        $picture = $arStory['picture'];
        $preview_text = $arStory['preview_text'];
        $urlSeo = '/story/'.utf8ToLatin($name).'-'.$id_story.'.html';
          # code...
        # code...
    ?>
    <div class="article">
      <h2><a href="<?php echo $urlSeo?>"><?php echo $name;?></a></h2>
      <p class="infopost">Ngày đăng: <?php echo $date_create;?>. Lượt đọc: <?php echo $counter;?></p>
      <div class="clr"></div>
      <div class="img">
        <?php
          if($picture !=''){
        ?>
        <a href="<?php echo $urlSeo?>"><img src="<?php echo '/files/'.$picture?>" width="161" height="192" alt="" class="fl" /></a>
        <?php }?>
      </div>
      <div class="post_content">
        <p><?php echo $preview_text;?>></p>
        <p class="spec"><a href="<?php echo $urlSeo?>" class="rm">Chi tiết</a></p>
      </div>
      <div class="clr"></div>
    </div>
    <?php }?>
    
    <p class="pages"><small>Trang 1 / 2</small> <span>1</span> <a href="#">2</a> <a href="#">&raquo;</a></p>
  </div>
  <div class="sidebar">
  <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/footer.php'; ?>
