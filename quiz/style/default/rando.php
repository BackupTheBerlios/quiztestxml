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
<body topmargin="6" bgcolor="$colors[bg1]" background="style/$style/hggif/hgor.gif">
<div align="center">$quiz</div>
</body>
</html>

EOT;

?>
