<?php

function site_head($title) {
	print("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");
	print("<html xmlns=\"http://www.w3.org/1999/xhtml\">");
	print("<head>");
	print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />");
	print("<link href=\"../style.css\" rel=\"stylesheet\" type=\"text/css\" />");
	print("<title>$title</title>");
	print("</head>");
	print("<body>");
}


function site_footer() {
	print("</body>");
	print("</html>");
}
?>
