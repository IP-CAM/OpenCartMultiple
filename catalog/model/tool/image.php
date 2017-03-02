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


}
