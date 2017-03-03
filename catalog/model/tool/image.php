<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {

		if (!is_file(DIR_IMAGE_USER . $filename) || substr(str_replace('\\', '/', realpath(DIR_IMAGE_USER . $filename)), 0, strlen(DIR_IMAGE_USER)) != DIR_IMAGE_USER) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;

		if (!is_file(DIR_IMAGE_USER . $image_new) || (filectime(DIR_IMAGE_USER . $image_old) > filectime(DIR_IMAGE_USER . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE_USER . $image_old);

			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return DIR_IMAGE_USER . $image_old;
			}
						
			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE_USER . $path)) {
					@mkdir(DIR_IMAGE_USER . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE_USER . $image_old);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE_USER . $image_new);
			} else {
				copy(DIR_IMAGE_USER . $image_old, DIR_IMAGE_USER . $image_new);
			}
		}

		
		$image_new = str_replace(' ', '%20', $image_new);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		
		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/user/' . $image_new;
		} else {
			return $this->config->get('config_url') . 'image/user/' . $image_new;
		}
	}

	/**
	 * Get Size Picture
	 */
	public function getSizeImage($size){
		return "?imageView2/2/w/".$size."/h/".$size."/q/100";
	}

	/**
	 * Fill Color To Transparent PNG
	 */
	public function toFillColor($bgColor, $bgSize, $srcUrl){

		//创建图片的实例
		$src = imagecreatefrompng($srcUrl);

		//创建图像
		$dst = @imagecreatetruecolor($bgSize, $bgSize);
		$bgColor = imagecolorallocate($dst, hexdec(substr($bgColor,0,2)), hexdec(substr($bgColor,2,2)), hexdec(substr($bgColor,4,2)));
		imagefill($dst,0,0,$bgColor);

		//获取水印图片的宽高
		list($src_w, $src_h) = getimagesize($srcUrl);
		imagecopy($dst, $src, ($bgSize - $src_w)/2, ($bgSize - $src_h)/2 , 0 ,0 ,$src_w, $src_h);

		//输出图片
		$dstUrl = DIR_IMAGE . 'temp/'.$this->customer->getId().'.png';
		imagepng($dst,$dstUrl);

		imagedestroy($dst);
		imagedestroy($src);
		return $dstUrl;
	}

	/**
	 * Combine Art Print Image
	 */
	public function combineArtPrintImg($srcUrl){
		$srcUrl = $srcUrl.$this->getSizeImage(400);
		$src = imagecreatefrompng($srcUrl);
		$size = 600;
		$sizeWhite = 22;
		$sizeImg = 38;

		//创建图像，灰色背景

		$dst = @imagecreatetruecolor($size, $size);
		$bgColor = imagecolorallocate($dst, 239, 239, 239);
		imagefill($dst,0,0,$bgColor);

		//获取水印图片的宽高
		list($src_w, $src_h) = getimagesize($srcUrl);

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

		//输出图片
		$dstUrl = DIR_IMAGE . 'temp/'.$this->customer->getId().'.png';
		imagepng($dst,$dstUrl);

		imagedestroy($dst);
		imagedestroy($src);

		return $dstUrl;
	}


}
