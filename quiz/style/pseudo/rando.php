<?PHP 
$quiz = GetMsg("QUIZTITLE");
echo <<<EOT

<html>
<head>
<meta name="author" content="krausi">
<style type="text/css">
$css[csso]
</style>
</head>
<body topmargin="6" bgcolor="$colors[bg2]">
<center>$quiz</center>
</body>
</html>

EOT;

?>
