<?php 
$type = "m";
$size = "20";
$len = "30";
$text = "";
$str="";
if(isset($_POST["type"])){
    $type = $_POST["type"];
    $size = $_POST["size"];
    $len = $_POST["len"];
    $text = $_POST["text"];

    $str = sprintf("?type=%s&size=%s&len=%s&text=%s",$type,$size,$len,urlencode($text));
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>縦書き文字列出力エンジン| Qualia Systems Inc.</title>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  </head>
  <body>
          <h1 style="text-align: center">縦書き文字列出力エンジン</h1>
        <h2 style="text-align: center">縦書き文字の画像を作ろう！!!</h2>

    <div class="container">
    <form action="." method="post">
        <div class="form-group">
            <label>Font Type(type)</label>
            <select name="type" class="form-control">
  <option value="m" <?php if($type=="m") echo "selected"; ?> >JPA 明朝(m)</option>
  <option value="g" <?php if($type=="g") echo "selected"; ?> >JPA ゴシック(g)</option>
  <option value="mamelon" <?php if($type=="mamelon") echo "selected"; ?> >マメロン</option>
  <option value="pigmo00" <?php if($type=="pigmo00") echo "selected"; ?> >ピグモ 00</option>
<option value="pigmo01" <?php if($type=="pigmo01") echo "selected"; ?> >ピグモ 01</option>
<option value="Makinas-Scrap-5" <?php if($type=="Makinas-Scrap-5") echo "selected"; ?> >マキナス Scrapスクラップ</option>
<option value="KUDOU" <?php if($type=="KUDOU") echo "selected"; ?> >3丁目フォント</option>
  

</select>
        </div>
        <div class="form-group">
            <label>Font Size</label>
            <input type="number" name="size" class="form-control" value="<?php echo $size; ?>">
        </div>
        <div class="form-group">
            <label>１列あたりの文字数</label>
            <input type="number" name="len" class="form-control" value="<?php echo $len; ?>">
        </div>
        <div class="form-group">
        <label for=" introduction" class="control-label">変換したい文字列</label>
          <textarea name="text" id="introduction" cols="45" rows="8"
            placeholder="変換したい文字列を記入してください。" class="form-control"><?php echo $text; ?></textarea>
          <!-- 注意書きは以下 -->
          <p class="help-block">※1200文字以内で書いてください</p>
      </div>   
        <button type="submit">作成！</button>
    </form>
   <img src="tategaki.php<?php echo $str ?>" style="border: 5px #ffd800 solid;">
</div>


  </body>
</html>

