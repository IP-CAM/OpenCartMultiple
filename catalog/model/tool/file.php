<?php
class ModelToolFile extends Model {
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
}