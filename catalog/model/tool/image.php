<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {

		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$image_old = $filename;
		$image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $image_new) || (filectime(DIR_IMAGE . $image_old) > filectime(DIR_IMAGE . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE . $image_old);
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return DIR_IMAGE . $image_old;
			}
						
			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $image_old);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $image_new);
			} else {
				copy(DIR_IMAGE . $image_old, DIR_IMAGE . $image_new);
			}
		}

		$image_new = str_replace(' ', '%20', $image_new);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		if ($this->request->server['HTTPS']) {

			return $this->config->get('config_ssl') . 'image/' . $image_new;
		} else {

			return $this->config->get('config_url') . 'image/' . $image_new;
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

    /**
     * combine T-shirt
     */
    public function combineTshirt($srcUrl,$srcWidth, $srcHeight,$bgImg){
        //initialize
        $dstWidth = 230;
        $dstHeight = 320;
        $sizeTotal = 600;
        $startY = 150;

        $dataParam = $this->getParamOfImg($srcWidth,$srcHeight,$dstWidth,$dstHeight,$sizeTotal,$srcUrl,$startY);

        //创建图片的实例
        $src = imagecreatefrompng($dataParam['src_path']);

        //获取大图
        $dst = imagecreatefromstring(file_get_contents($bgImg));

        imagecopy($dst, $src, ($sizeTotal - $dataParam['srcWidth'])/2, $startY, 0, 0, $dataParam['srcWidth'], $dataParam['srcHeight']);

        //输出图片
        $dstUrl = DIR_IMAGE . 'temp/'.$this->customer->getId().'.png';
        imagepng($dst,$dstUrl);

        imagedestroy($dst);
        imagedestroy($src);

        return $dstUrl;
    }

	/**
	 * CombinePhoneCase
	 */
	public function combinePhoneCase($srcUrl,$srcWidth, $srcHeight,$bgImg){
		$dstWidth = 210;
		$dstHeight = 450;
		$sizeTotal = 600;
		$startY = 80;

		$dataParam = $this->getParamOfImg($srcWidth,$srcHeight,$dstWidth,$dstHeight,$sizeTotal,$srcUrl,$startY);
		//获取SrcPath
		$src = imagecreatefrompng($dataParam['src_path']);

		//获取大图
		$dst = imagecreatefromstring(file_get_contents($bgImg));

		imagecopy($dst, $src, $dataParam['startX'], $dataParam['startY'], 0, 0, $dataParam['srcWidth'], $dataParam['srcHeight']);

		//输出图片
		$dstUrl = DIR_IMAGE . 'temp/'.$this->customer->getId().'.png';
		imagepng($dst,$dstUrl);

		imagedestroy($dst);
		imagedestroy($src);

		return $dstUrl;
	}

	/**
	 * CombinePhoneCase
	 */
	public function combinePillow($srcUrl,$srcWidth, $srcHeight,$bgImg){
		$dstWidth = 370;
		$dstHeight = 370;
		$sizeTotal = 600;
		$startY = 110;

		$dataParam = $this->getParamOfImg($srcWidth,$srcHeight,$dstWidth,$dstHeight,$sizeTotal,$srcUrl,$startY);
		//获取SrcPath
		$src = imagecreatefrompng($dataParam['src_path']);

		//获取大图
		$dst = imagecreatefromstring(file_get_contents($bgImg));

		imagecopy($dst, $src, $dataParam['startX'], $dataParam['startY'], 0, 0, $dataParam['srcWidth'], $dataParam['srcHeight']);

		//输出图片
		$dstUrl = DIR_IMAGE . 'temp/'.$this->customer->getId().'.png';
		imagepng($dst,$dstUrl);

		imagedestroy($dst);
		imagedestroy($src);

		return $dstUrl;
	}


    /**
     * Caculate the Parameters Of Image
     */
    public function getParamOfImg($srcWidth,$srcHeight,$dstWidth,$dstHeight,$sizeTotal,$srcUrl,$startY){

        //计算需要图片比例
        if($dstHeight/$dstWidth > $srcHeight/$srcWidth){
            //按照宽度
            $srcHeight = floor($dstWidth*($srcHeight/$srcWidth));
            $srcWidth = $dstWidth;
        }else{
            //按照高度
            $srcWidth = floor($dstHeight*($srcWidth/$srcHeight));
            $srcHeight = $dstHeight;
        }

		$imgWidth = $srcHeight>$srcWidth?$srcHeight:$srcWidth;
		$src_path = $srcUrl."?imageView2/2/w/".$imgWidth."/h/".$imgWidth."/q/100";

        $data = array(
            'src_path' => $src_path,
            'srcHeight' => $srcHeight,
            'srcWidth' => $srcWidth,
            'startX' => ($sizeTotal - $srcWidth)/2,
			'startY' => ($dstHeight - $srcHeight)/2 + $startY,
        );
        return $data;
    }

}
