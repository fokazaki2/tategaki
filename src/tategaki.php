<?php 
//====================================================================
// 基本設定項目
//====================================================================

// 使用するフォント名
define ( "FONT_TYPE_G",'font/ipag.ttf' );
define ( "FONT_TYPE_M",'font/ipam.ttf' );
define ( "FONT_MAMELON",'font/Mamelon.otf' );
define ( "FONT_PIGMO00",'font/Pigmo-00.otf' );
define ( "FONT_PIGMO01",'font/Pigmo-01.otf' );
define ( "FONT_MakinasScrap5",'font/Makinas-Scrap-5.otf' );
define ( "FONT_KUDOU",'font/KUDOU.TTF' );

// フォントサイズ
define ( "FONT_SIZE",30 );

// 改行文字数
define ( "RETURN_LEN",5 );

// 方向(true:右から左 false:左から右)
define ( "DIRECTION",true );

// フォントの指定 font_type=m or g
$font_type = FONT_TYPE_M;
if(isset($_REQUEST["type"])){
    if($_REQUEST["type"] == "m"){
        $font_type = FONT_TYPE_M;
    }else if($_REQUEST["type"] == "g"){
        $font_type = FONT_TYPE_G;
    
    }else if($_REQUEST["type"] == "mamelon"){
        $font_type = FONT_MAMELON;
    }else if($_REQUEST["type"] == "pigmo00"){
        $font_type = FONT_PIGMO00;
    }else if($_REQUEST["type"] == "pigmo01"){
        $font_type = FONT_PIGMO01;
    }else if($_REQUEST["type"] == "Makinas-Scrap-5"){
        $font_type = FONT_MakinasScrap5;
    }else if($_REQUEST["type"] == "KUDOU"){
        $font_type = FONT_KUDOU;
    }
    
}
// フォントサイズ
$font_size = FONT_SIZE;
if(isset($_REQUEST["size"])){
    $font_size = $_REQUEST["size"];
}

// 1行の文字数
$return_len = RETURN_LEN;
if(isset($_REQUEST["len"])){
    $return_len = $_REQUEST["len"];
}

// 出力する文字
$txt = mb_convert_encoding("日本語対応！『縦書き出力』記号もある程度いけるはず。","utf-8");
if(isset($_REQUEST["text"])){
    $txt = $_REQUEST["text"];
}




//====================================================================
// ここより実行部
//====================================================================

// 表示する文字列
//"_"　-> "-"
$txt = mb_ereg_replace("_","-",$txt); 

$txt_len = mb_strlen($txt);


$margin_x = $font_size / 5;
$margin_y = $font_size / 4.2;

// 画像サイズ
//$img_width = 
//

// 折り返し考慮
$img_width = (($font_size + $margin_x*2)) * (ceil($txt_len / $return_len));
if($return_len < $txt_len){
    $img_height = ($font_size+($margin_y*1.1)) * $return_len;
}else{
    $img_height = ($font_size+($margin_y*1.1)) * $txt_len;
}

// 生成画像
$img = imagecreatetruecolor ( $img_width, $img_height );

// 背景色
//$bgc = ImageColorAllocate ( $img, 255, 255, 255 );
$backgroundColor = imagecolorallocatealpha( $img, 255,255,255,127);
$frontColor = imagecolorallocatealpha ( $img, 0, 0, 0,0 );


imagealphablending($img, true); // ブレンドモードを設定する
imagesavealpha($img, true); // 完全なアルファチャネルを保存する

imagefill($img, 0, 0, $backgroundColor); // 指定座標から指定色で塗る

// フォントパスの設定
//putenv ( 'GDFONTPATH='.realpath('.') );

// 開始x座標
$x = $margin_x;
$x = ($font_size + $margin_x*2) * (ceil($txt_len / $return_len)-1);
// 開始y座標
$y = $font_size+$margin_y;

if ( DIRECTION ) {
	$direction = -1;
} else {
	$direction = 1;
}


// 文字数分のループを実行
for ( $i = 0; $i < $txt_len ; $i ++ ) {

	// 文字を１文字ずつ取り出す
	$str = mb_substr($txt,$i,1);
	// X座標を算出
	// 最初以外の改行数分のループ処理の時にx座標を計算する
	if ( ($i != 0) && ($i % $return_len == 0) ) {
		// 方向値を使用して減算か加算を行う
		$x += ($font_size + $margin_x*2)*$direction;
        $y = $font_size+$margin_y;
	}


	// 文字を書き出し


    $angle = 0;
    $y_adj = 0;
    $x_adj = 0;
    switch($str){
        case "。":
        case "、":
            $y_adj = $font_size - $margin_y; // y調整
            $x_adj = $margin_x*4;
            break;
        case "-" :
        case "ー" :
            $angle = 270;
            $y_adj = $font_size + $margin_y; // y調整
            $x_adj = $margin_x;
            break;
		case "～":
		case "…":
        case "「" :
        case "」" :
        case "『" :
        case "』" :
        case "｛" :
        case "｝" :
        case "（" :
        case "）" :
        case "＜" :
        case "＞" :
        case "｜" :
        case "－" :
        case "；" :
        case "：" :
        case "＝" :
        case "←" :
        case "→" :
        case "↓" :
        case "↑" :
        case "(" :
        case ")" :
		case "ω":
		case "´":
		case "｀":
		case "･":
            $angle = 270;
            $y_adj = $font_size + ($margin_y*1.2); // y調整
            $x_adj = $margin_x;
            break;

        default : //'/[!-/:-@≠\[-`{-~]/i
            if (preg_match("/^[a-zA-Z0-9!-~]+$/", $str)) {
                $y_adj = $margin_y; // y調整
                $x_adj = $margin_x*2;
            }
    }
	imagettftext ( $img, $font_size, $angle, $x+$x_adj, $y-$y_adj , $frontColor, $font_type, $str );
	$y += $font_size+$margin_y;
}

header ( "Content-type: image/png" );
ImagePng ( $img );
ImageDestroy ( $img );
