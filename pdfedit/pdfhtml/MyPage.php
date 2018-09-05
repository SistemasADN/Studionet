<?php
if(strpos($_SERVER['DOCUMENT_ROOT'], 'AppServ')){
    include $_SERVER['DOCUMENT_ROOT']."/bailemacarena/pdfedit/koolreport/autoload.php";
}else{
    include $_SERVER['DOCUMENT_ROOT']."/pdfedit/koolreport/autoload.php";
}
class MyPage extends \koolreport\KoolReport
{
    use \koolreport\export\Exportable;
}
?>
