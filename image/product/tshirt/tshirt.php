<?php

//初始值
$dstWidth = 230;
$dstHeight = 320;
$srcWidth = 374;
$srcHeight = 556;
$sizeTotal = 600;

$startY = 150;

//计算需要图片比例
if($dstHeight/$dstWidth > $srcHeight/$srcWidth){
	//按照宽度
	$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/".$dstWidth."/h/".$dstWidth."/q/100";
	$srcHeight = floor($dstWidth*($srcHeight/$srcWidth));
	$srcWidth = $dstWidth;
}else{
	//按照高度
	$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/".$dstHeight."/h/".$dstHeight."/q/100";
	$srcWidth = floor($dstHeight*($srcWidth/$srcHeight));
	$srcHeight = $dstHeight;
}


//创建图片的实例
echo $src_path;
$src = imagecreatefrompng($src_path);

//获取大图
$dst_path = "tshirt_1.png";
$dst = imagecreatefromstring(file_get_contents($dst_path));

imagecopy($dst, $src, ($sizeTotal - $srcWidth)/2, $startY, 0, 0, $srcWidth, $srcHeight);

//输出图片
header('Content-Type: image/png');
imagepng($dst,'1.png');

imagedestroy($dst);
imagedestroy($src);

/*
$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/400/h/400/q/100";

$size = 600;
$sizeWhite = 20;
$sizeImg = 40;


//创建图像，灰色背景

$dst = @imagecreatetruecolor($size, $size);
$bgColor = imagecolorallocate($dst, 239, 239, 239);
imagefill($dst,0,0,$bgColor); 

//获取水印图片的宽高
list($src_w, $src_h) = getimagesize($src_path);

//白色背景
$bgWhite = imagecolorallocate($dst, 255, 255, 255);
imagefilledrectangle($dst, 
		($size - $src_w - $sizeWhite*2 - $sizeImg *2)/2, 
		($size - $src_h - $sizeWhite*2 - $sizeImg *2)/2, 
		$size/2 + $sizeWhite + $src_w/2 + $sizeImg, 
		$size/2 + $sizeWhite + $src_h/2 + $sizeImg, 
	$bgWhite);

//灰色边
$bgGrey = imagecolorallocate($dst, 194, 194, 194);
imagefilledrectangle($dst, 
		($size - $src_w - $sizeWhite*2 - $sizeImg *2)/2, 
		$size/2 + $sizeWhite + $src_h/2 + $sizeImg,
		$size/2 + $sizeWhite + $src_w/2 + $sizeImg,
		$size/2 + $sizeWhite + $src_h/2 + $sizeImg, 
	$bgGrey);

imagefilledrectangle($dst, 
	$size/2 + $sizeWhite + $src_w/2 + $sizeImg, 
	($size - $src_h - $sizeWhite*2 - $sizeImg *2)/2,
	$size/2 + $sizeWhite + $src_w/2 + $sizeImg,
	$size/2 + $sizeWhite + $src_h/2 + $sizeImg, 
$bgGrey);

//图片默认背景
$bgImg = imagecolorallocate($dst, 42, 202, 174);
imagefilledrectangle($dst, 
		($size - $src_w - $sizeImg *2)/2, 
		($size - $src_h - $sizeImg *2)/2, 
		$size/2 + $src_w/2 + $sizeImg, 
		$size/2 + $src_h/2 + $sizeImg, 
	$bgImg);

//图片
imagecopy($dst, $src, ($size - $src_w)/2, ($size - $src_h)/2 , 0 ,0 ,$src_w, $src_h);



**/
?>