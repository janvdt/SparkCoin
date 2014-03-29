<?php

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=export.xls");
header("Content-Transfer-Encoding: binary ");

echo strip_tags($_POST['tableData'],'<table><th><tr><td>');  

?>
