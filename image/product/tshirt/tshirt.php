<?php

//��ʼֵ
$dstWidth = 230;
$dstHeight = 320;
$srcWidth = 374;
$srcHeight = 556;
$sizeTotal = 600;

$startY = 150;

//������ҪͼƬ����
if($dstHeight/$dstWidth > $srcHeight/$srcWidth){
	//���տ��
	$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/".$dstWidth."/h/".$dstWidth."/q/100";
	$srcHeight = floor($dstWidth*($srcHeight/$srcWidth));
	$srcWidth = $dstWidth;
}else{
	//���ո߶�
	$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/".$dstHeight."/h/".$dstHeight."/q/100";
	$srcWidth = floor($dstHeight*($srcWidth/$srcHeight));
	$srcHeight = $dstHeight;
}


//����ͼƬ��ʵ��
echo $src_path;
$src = imagecreatefrompng($src_path);

//��ȡ��ͼ
$dst_path = "tshirt_1.png";
$dst = imagecreatefromstring(file_get_contents($dst_path));

imagecopy($dst, $src, ($sizeTotal - $srcWidth)/2, $startY, 0, 0, $srcWidth, $srcHeight);

//���ͼƬ
header('Content-Type: image/png');
imagepng($dst,'1.png');

imagedestroy($dst);
imagedestroy($src);

/*
$src_path = "http://olvhfy18m.bkt.gdipper.com/0/1/d868c9xyw4p9m7la19c29ms4i.png?imageView2/2/w/400/h/400/q/100";

$size = 600;
$sizeWhite = 20;
$sizeImg = 40;


//����ͼ�񣬻�ɫ����

$dst = @imagecreatetruecolor($size, $size);
$bgColor = imagecolorallocate($dst, 239, 239, 239);
imagefill($dst,0,0,$bgColor); 

//��ȡˮӡͼƬ�Ŀ��
list($src_w, $src_h) = getimagesize($src_path);

//��ɫ����
$bgWhite = imagecolorallocate($dst, 255, 255, 255);
imagefilledrectangle($dst, 
		($size - $src_w - $sizeWhite*2 - $sizeImg *2)/2, 
		($size - $src_h - $sizeWhite*2 - $sizeImg *2)/2, 
		$size/2 + $sizeWhite + $src_w/2 + $sizeImg, 
		$size/2 + $sizeWhite + $src_h/2 + $sizeImg, 
	$bgWhite);

//��ɫ��
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

//ͼƬĬ�ϱ���
$bgImg = imagecolorallocate($dst, 42, 202, 174);
imagefilledrectangle($dst, 
		($size - $src_w - $sizeImg *2)/2, 
		($size - $src_h - $sizeImg *2)/2, 
		$size/2 + $src_w/2 + $sizeImg, 
		$size/2 + $src_h/2 + $sizeImg, 
	$bgImg);

//ͼƬ
imagecopy($dst, $src, ($size - $src_w)/2, ($size - $src_h)/2 , 0 ,0 ,$src_w, $src_h);



**/
?>