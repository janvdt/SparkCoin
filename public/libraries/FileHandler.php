<?php

class FileHandler {
	
	/*
	 |--------------------------------------------------------------------------
	 | FILEHANDLER LIBRARY CLASS
	 |--------------------------------------------------------------------------
	 |
	 | This class provides simple file action handling methods such as upload,
	 | download, etc...
	 |
	 */
	 	protected static $file 			= ''; // Actual file name
	 	protected static $dir 			= '';	// File directory (without filename)
	 	protected static $f_path 		= ''; // Complete file path (with filename)
	 	protected static $f_dir			= '';	// fopen value
	 	protected static $f_size		= ''; // File size
	 	protected static $path_parts	= '';	// Path info (array with extension, base, ...)
	 	protected static $ext			= ''; // Extension


	/* ===================================
	 * HELPER METHODS
	 * =================================== */

		public static function set_params( $dir, $file )
		{
			self::$dir  	= $dir;
			self::$file 	= $file;
			self::$f_path 	= $dir . $file;

			if ( self::$f_dir = fopen( self::$f_path, 'r') )
			{
				self::$f_size 		= filesize( self::$f_path );
				self::$path_parts = pathinfo( self::$f_path );
				self::$ext 			= strtolower( self::$path_parts["extension"] );
				
				return true;
			}
			else
			{
				return false;
			}
		}


	/* ===================================
	 * FILE ACTIONS
	 * =================================== */

	/*
	 * Provides a simple file download (pdf, zip, jpeg, gif or png)
	 *
	 * @param string file:	name of the file to download
	 * @param string dir: 	targetted directory
	 *
	 * @return download file
	 */

		public static function download( $dir, $file )
		{	
			// Make sure it's a file before doing anything!
			if ( self::set_params( $dir, $file ) == true && is_file( self::$f_path) )
			{
				// required for IE
				if (ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}

				// Get the file mime type using the file extension
				switch ( self::$ext )
				{
					case 'pdf':
						$mime = 'application/pdf';
						break;
					case 'zip':
						$mime = 'application/zip';
						break;
					case 'jpeg':
					case 'jpg':
						$mime = 'image/jpg';
						break;
					case 'gif':
						$mime = 'image/gif';
						break;
					case 'png':
						$mime = 'image/png';
						break;
					default:
						$mime = 'application/force-download';
				}

				header('Pragma: public'); 	// required
				header('Expires: 0');		// no cache
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime ( self::$f_path)) . ' GMT');
				header('Cache-Control: private', false);
				header('Content-Type: ' . $mime);
				header('Content-Disposition: attachment; filename="' . self::$file . '"');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: ' . self::$f_size );	// provide file size
				header('Connection: close');
				readfile(self::$f_path);	// push it out
				
				exit();
			}
		}


	/*
	 * Enables a user to download multiple files in a directory
	 *
	 * @param array file_names:	array containing all files in a directory
	 * @param string zipname: 		name for the zip archive (without extension)
	 * @param string dir: 			targetted directory
	 * @param string allowed_ext: allowed extensions for download (multiple extension should be pipelined, e.g. "jpg|png|gif")
	 *
	 * @return download zip archive
	 */

		public static function download_multiple( $file_names, $zipname, $dir )
		{
			$zipfile = $zipname.'.zip';	
			$zip 		= new ZipArchive();
			
			// Create the file and throw the error if unsuccessful
			if ( $zip -> open( $zipfile, ZIPARCHIVE::CREATE ) !== TRUE )
			{
		    	exit("cannot open <$zipfile>\n");
			}

			// Add each files of $file_name array to archive
			foreach ( $file_names as $files )
			{
		  		$zip -> addFile( $dir.$files, $files );
			}

			$zip -> close();

			// Then send the headers to foce download the zip file
			header("Content-type: application/zip"); 
			header("Content-Disposition: attachment; filename=$zipfile"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
			readfile("$zipfile");
			exit;
		}


	/*
	 * Enables a user to download all files (including subfolders and subfiles) in a directory
	 * Requires the FlxZipArchive class
	 * @return download zip archive
	 */

		public static function download_all( $dir, $zipname )
		{
			$dir 				= $dir;
			$zipfile 		= $zipname . '.zip';
			$download_file = true;

			$za  = new FlxZipArchive;
			$res = $za -> open( $zipfile, ZipArchive::CREATE );
			
			if ($res === TRUE) 
			{
			    $za -> addDir( $dir, basename($dir) );
			    $za -> close();
			}
			else
			{
				echo 'Could not create a zip archive';
			}

			if ( $download_file )
			{
			    ob_get_clean();
			    header("Pragma: public");
			    header("Expires: 0");
			    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			    header("Cache-Control: private", false);
			    header("Content-Type: application/zip");
			    header("Content-Disposition: attachment; filename=" . basename($zipfile) );
			    header("Content-Transfer-Encoding: binary");
			    header("Content-Length: " . filesize($zipfile));
			    readfile($zipfile);
			}
		}

}