<?php

$START = GetMsg("START");
$AGAIN = GetMsg("AGAIN");
$CLOSER = GetMsg("CLOSER");
$MSTART = GetMsg("MSTART");
$MAGAIN = GetMsg("MAGAIN");
$MCLOSER = GetMsg("MCLOSER");

echo <<<EOT
<html>
<head>
<meta name="author" content="krausi,basti,stefan">
<meta name="GENERATOR" content="ccls">
<title></title>
<style type="text/css">
$css[cssmain]
</style>
</head>
<body background ="style/$style/hggif/hgmain.gif" text="#000000" bgcolor="$colors[bg1]" marginwidth="24" marginheight="24" topmargin="24" leftmargin="24">
<center>
<br>
<table border="0" cellpadding="0" cellspacing="0">
     <colgroup>
        <col width="10">
        <col width="*">
        <col width="10">
     </colgroup>
    <tr>
      <td height="10" background="style/$style/hggif/trol.gif"></td>
      <td height="10" background="style/$style/hggif/tro.gif"></td>
      <td height="10" background="style/$style/hggif/tror.gif"></td>
    </tr>
    <tr>
      <td background="style/$style/hggif/trlr.gif"></td>
      <td>
        <table cellpadding="0" cellspacing="0">
          <colgroup>
            <col width="137">
            <col width="27">
            <col width="137">
            <col width="27">
            <col width="137">            
        </colgroup>
         <tr>
                     <td height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten"><a href="start.php?style=$style">$START</a></div>
            			    </td>
                      <td>&nbsp;</td>
                     <td class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten"><a href="quizmenu.php?style=$style">$AGAIN</a></div>
            			    </td>  
                      <td>&nbsp;</td>
                     <td class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten"><a href="javascript:self.close()">$CLOSER</a></div>
            			    </td>                                                              
                      
         </tr>
         <tr>
                      <td height="27" colspan="5"></td>
         </tr>
         <tr>
                     <td height="27">
								        <div align="center">$MSTART</div>
            			    </td>
                      <td>&nbsp;</td>
                      <td>
                         <div align="center">$MAGAIN</div>
            			    </td>  
                      <td>&nbsp;</td>
                     <td>
								        <div align="center">$MCLOSER</div>
            			    </td>         
         </tr>
        </table> 
        
      </td>
      <td background="style/$style/hggif/trrr.gif"></td>
    </tr>
    <tr>
      <td height="10" background="style/$style/hggif/trul.gif"></td>
      <td height="10" background="style/$style/hggif/tru.gif"></td>
      <td height="10" background="style/$style/hggif/trur.gif"></td>
    </tr>
</table>
</body>
</html>

EOT;

?>