<?php

class FlxZipArchive extends ZipArchive {

	/*
	 | --------------------------------------------------------------------------
	 | FLXZIPARCHIVE LIBRARY CLASS
	 | --------------------------------------------------------------------------
	 | 
	 | @author Nicolas Heimann
	 |
	 */
	
	/*
	 * Add a Dir with Files and Subdirs to the archive
	 * @param string $location Real Location
	 * @param string $name Name in Archive
	 */

		public function addDir( $location, $name )
		{
			$this -> addEmptyDir($name);
			$this -> addDirDo($location, $name);
		} // EO addDir;


	/* 
	 * Add Files & Dirs to archive
	 * @param string $location Real Location
	 * @param string $name Name in Archive
	 */
		private function addDirDo( $location, $name )
		{
			$name .= '/';
			$location .= '/';

			// Read all Files in Dir
			$dir = opendir( $location );
			while ( $file = readdir($dir) )
			{
				if ($file == '.' || $file == '..') continue;
				// Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
				$do = ( filetype( $location . $file) == 'dir' ) ? 'addDir' : 'addFile';
				$this -> $do( $location . $file, $name . $file );
			}
		} // EO addDirDo();
}