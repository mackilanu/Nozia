<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>
	<?php
         require_once("../../Scripts/Includes/bootstrap.php");
	?>
</head>
<body>
<?php
    require_once("../../Scripts/navbar.php");
?>
 <object data="../files/pdftest.pdf" type="application/pdf" width="100%" height="700">
  <p>Alternative text - include a link <a href="myfile.pdf">to the PDF!</a></p>
</object>
</body>
</html>