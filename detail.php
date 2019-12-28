<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/header.php'; ?> 
<?php
    $id_story = $_GET['id'];
    $query = "SELECT * FROM story WHERE story_id = {$id_story}";
    $ketqua = $mysqli->query($query);
    $arStory = mysqli_fetch_assoc($ketqua);

      # code...
?> 
<script type="text/javascript">
    document.title='<?php echo $arStory['name'];?>';
</script>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h1><?php echo $arStory['name'];?></h1>
      <div class="clr"></div>
      <p>Ngày đăng: <?php echo $arStory['created_at'];?>. Lượt đọc: <?php echo $arStory['counter']?></p>
      <div class="vnecontent">
          <p><?php echo $arStory['detail_text'];?></p>
      </div>
    </div>
    
    <div class="article">
      <h2><span>3</span> Truyện liên quan</h2>
      <div class="clr"></div>
      <?php
        $queryLQ = "SELECT * FROM story WHERE story_id != {$id_story} AND cat_id = {$arStory['cat_id']} LIMIT 3";
        $ketquaLQ = $mysqli->query($queryLQ);
        while ($arStoryLQ = mysqli_fetch_assoc($ketquaLQ)) {
          $urlSeo = '/story/'.utf8ToLatin($arStoryLQ['name']).'-'.$arStoryLQ['story_id'].'.html';
      ?>
      <div class="comment"> 
        <?php
          if($arStoryLQ['picture']!=''){
        ?>
        <a href="<?php echo $urlSeo?>"><img src="<?php echo '/files/'.$arStoryLQ['picture']?>" width="40" height="40" alt="" class="userpic" /></a>
      <?php }?>
        <h3><a href="<?php echo $urlSeo?>" title=""><?php echo $arStoryLQ['name'];?></a></h3>
        <p><?php echo $arStoryLQ['preview_text'];?></p>
      </div>
      <?php }?>
      
    </div>
  </div>
  <div class="sidebar">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/story/inc/footer.php'; ?>
  
