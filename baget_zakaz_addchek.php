<?
if ( $_SERVER["REMOTE_ADDR"]=='' || $_SERVER["REMOTE_ADDR"]=='' || $_SERVER["REMOTE_ADDR"]=='' ) {
    $ident=$_GET['id'];
    if (preg_match("/^[\dl]+$/",$ident))
	{
		$z=explode('l',$ident);
	}
    else
	{
        $fp = fopen('lo/g.txt', 'a');
        $towrite=date("j.m.Y G:i").' ! '.$_SERVER["REMOTE_ADDR"].' ! '.$ident.' ! zakaz_addchek bad id';
        fwrite($fp, $towrite);
        fwrite($fp, "\r\n");
        fclose($fp);
        exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
    }
    if ($z[16]==0)
	{
        $z[16]=time();
        $ident=implode("l",$z);
    }
    $fp = fopen('bagechek/'.$z[16], 'a');
    fwrite($fp, $ident);
    fwrite($fp, "\r\n");
    fclose($fp);
    exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id='.$ident.'">');
}
else
{
    exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}
