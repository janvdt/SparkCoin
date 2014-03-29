/* jQuery/JavaScript Document
 * Enables the user to download an .xsl version
 * of the Html tables
 */
 
 function exportToExcel() {
    var data;
    
    /* Set data */
    data = '<table>' + $("table").html().replace(/<a\/?[^>]+>/gi, '') + '</table>';
    
    /* Set post form */
    var form = "<form method='post' action='libs/download_xsl.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='" + data + "' ></form>";
    
    /* Process */
	$('body')
		.prepend(form);
	
	$('#ReportTableData')
		.submit()
		.remove();
		
	return false;
 }