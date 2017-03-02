<?php

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class ModelToolFile extends Model {

    private $accessKey = 'kBKRCQj2RNGLTnOOoIaRr8bzrs_cb0v7opoT_PPm';
    private $secretKey = 'vSLfnegtSkLgVyfUtoqOPLZjXPXDV-OSUwVFo9tM';
    private $bucket = 'mengchuang';
	private function mkpath($dir){
		if(!is_dir($dir)){
			if(!$this->mkpath(dirname($dir))){
				return false;
			}
			if(!mkdir($dir,0777)){
				return false;
			}
		}
		return true;
	}

	public function checkDirExit($dir){
		if(!is_dir($dir)){
			$this-> mkpath($dir);
		}
	}

	/**
	 * 拷贝文件
	 * @param $src
	 * @param $dstFolder
	 * @param $filename
	 */
	public function copyImage($src, $dstFolder, $filename){
		if(!is_dir($dstFolder)){
			$this-> mkpath($dstFolder);
		}
		copy($src, $dstFolder.'/'.$filename);
	}

    /**
     * 获得七牛TOKEN
     */
    public function getQiniuToken(){
        require_once DIR_LIBRARY. '/qiniu/autoload.php';
        // 构建鉴权对象
        $auth = new Auth($this->accessKey, $this->secretKey);
        // 要上传的空间
        return $auth->uploadToken($this->bucket);
    }

	/**
	 * 上传图片
	 */
	public function uploadToQiniu($fileSrc,$dir){

		$key =$dir.substr(md5(time()),0,20).'.png';
		// 初始化 UploadManager 对象并进行文件的上传。
		$uploadMgr = new UploadManager();

		// 调用 UploadManager 的 putFile 方法进行文件的上传。
		list($ret, $err) = $uploadMgr->putFile($this->getQiniuToken(), $key, $fileSrc);
		if ($err == null) {
			return $key;
		}else{
			return "fail";
		}
	}

	/**
	 * 删除图片
	 */
	public function deleteFile($fileUrl){
		@unlink($fileUrl);
	}


}