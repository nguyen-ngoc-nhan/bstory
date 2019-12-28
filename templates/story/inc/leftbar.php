<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
    <?php 
        $query = "SELECT * FROM cat";
        $ketqua = $mysqli->query($query);
        while($arCat = mysqli_fetch_assoc($ketqua)){
          $name=$arCat['name'];
          $catId = $arCat['cat_id'];
          $urlSeo = '/cat/'.utf8ToLatin($name).'-'.$catId.'.html';
    ?>
    <li><a href="<?php echo $urlSeo?>"><span>&raquo; &nbsp;</span><?php echo $arCat['name'];?></a></li>
   <?php }?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
    <?php 
      $query2 = "SELECT * FROM story ORDER BY story_id DESC LIMIT 3";
      $ketqua2 = $mysqli->query($query2);
      while ($arStory = mysqli_fetch_assoc($ketqua2)) {
        $nameStory = $arStory['name'];
        $id_story = $arStory['story_id'];
         $urlSeo1 = '/story/'.utf8ToLatin($nameStory).'-'.$id_story.'.html';
        # code...
    ?>
    <li><a href="<?php echo $urlSeo1?>"><?php echo $arStory['name'];?></a><br />
      <?php echo $arStory['preview_text']?></li>
    <?php }?>
  </ul>
</div>