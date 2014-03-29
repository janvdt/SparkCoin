<?php

class FileUpload {

/*
 | ---------------------------------------------
 | PUBLICALLY ACCESSIBLE
 | ---------------------------------------------
 */
	public function renameFile()
	{
		$ext = $this->getFileExt( $_FILES['file']['name'] );
		$timestamp = time();
		
		$filename_on_server = $timestamp.'.'.$ext;
		return $filename_on_server;
	}
	
	public function setDirectory( $dir, $fileName )
	{
		$dir .= $fileName;
		return $dir;
	}

	
  /* SIMPLE UPLOAD */
	public function uploadFile( $dir )
	{
		$validate_file = $this -> checkFileExtension();
			
		if ( $validate_file === true )
		{
			if ( move_uploaded_file( $_FILES['file']['tmp_name'], $dir ) )
				return true;
			else
				return "An error occured while uploading the file: ".$_FILES['file']['error'].".";
		}
		else
		{
			return $validate_file;
		}
	}
	
	
  /* ADVANCED UPLOAD */
  	public function advancedFileUpload( $temp_dir, $dest_dir, $width, $height )
  	{
	  	// Get extension to create the new image
	  	$ext = $this -> getFileExt( $temp_dir );
	  	
	  	switch($ext)
	  	{
		  	case 'gif':
		  		$img_src = imagecreatefromgif($temp_dir);
		  		break;
		  	case 'jpg':
		  		$img_src = imagecreatefromjpeg($temp_dir);
		  		break;
		  	case 'jpeg':
		  		$img_src = imagecreatefromjpeg($temp_dir);
		  		break;
		  	case 'png':
		  		$img_src = imagecreatefrompng($temp_dir);
		  		break;
	  	}
	  	
	  	// Resample new image
	  	$size = getimagesize($temp_dir);
	  	$orig_x = imagesx($img_src);
	  	$orig_y = imagesy($img_src);
	  	
	  	if ( $orig_x > $width || $orig_y > $height )
	  	{
		  	if ( $orig_y >= $orig_x )
		  	{
		  		// Scale based on height
			  	$new_h = $height;
			  	$new_w = round($new_h * $size[0] / $size[1]);
		  	}
		  	else
		  	{
		  		// Scale based on width
			  	$new_w = $width;
			  	$new_h = round($new_w * $size[1] / $size[0]);
		  	}
	  	}
	  	else
	  	{
	  		$new_w = $orig_x;
	  		$new_h = $orig_y;
	  	}
	  	
	  	$img_dst = imagecreatetruecolor( $new_w, $new_h );
	  	imagecopyresized( $img_dst, $img_src, 0, 0, 0, 0, $new_w, $new_h, $orig_x, $orig_y );
	  	
	  	// Save new image
	  	switch($ext)
	  	{
		  	case 'gif':
		  		imagegif($img_dst, $dest_dir);
		  		break;
		  	case 'jpg':
		  		imagejpeg($img_dst, $dest_dir);
		  		break;
		  	case 'jpeg':
		  		imagejpeg($img_dst, $dest_dir);
		  		break;
		  	case 'png':
		  		imagepng($img_dst, $dest_dir);
		  		break;
	  	}
	  	
	  	// Clean up image storage
		unlink($temp_dir);
		imagedestroy($img_src);
		imagedestroy($img_dst);
   }
	

/*
 | ---------------------------------------------
 | PRIVATLY ACCESSIBLE
 | ---------------------------------------------
 */
	private function checkFileExtension()
	{
		$type = $_FILES["file"]["type"];
		$size = $_FILES["file"]["size"]; //In bytes
		$sizeMB = round($size / 1048576, 1);
		
		if ( (($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/jpg") || ($type == "image/png")) )
		{
			if ($size <= 2097152) // 2MB
				return true;
			else
				return "Image size: ".$sizeMB."MB (only 2MB are allowed)";
		}
		else
		{
			return "Invalid file type: you can only upload an image.";
		}
	}
	
	
	private function getFileExt( $filename )
	{
		$filename = strtolower($filename) ; 
	 	$exts = split("[/\\.]", $filename) ; 
	 	$n = count($exts)-1; 
	 	$exts = $exts[$n]; 
	 	
	 	return $exts;
	}
}