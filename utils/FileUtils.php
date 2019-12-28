<?php
	function renameFile($fileName){
		$arFileName = explode('.', $fileName);
        $extension = end($arFileName);
        $fileName = BASE_NAME.'-'.time().'.'.$extension;
        return $fileName;
	}
?>