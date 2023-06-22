<?
if ($_SERVER["REMOTE_ADDR"]=='') {
        $ident=$_GET['id'];
        if (preg_match("/^[\dl]+$/",(string) $ident))
        {
            $z=explode('l',(string) $ident);
        }
        else
        {
            $fp = fopen('lo/g.txt', 'a');
            $towrite=date("j.m.Y G:i").' ! '.$_SERVER["REMOTE_ADDR"].' ! '.$ident.' ! zakaz_delchek bad id';
            fwrite($fp, $towrite);
            fwrite($fp, "\r\n");
            fclose($fp);
            exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
        }
        $fp = fopen('bagechek/'.$z[16].'.tmp', 'w');
        $chekcont=file('bagechek/'.$z[16]);
        if ((is_countable($chekcont) ? count($chekcont) : 0)>0)
        {
            for ($i = 0; $i < (is_countable($chekcont) ? count($chekcont) : 0); $i++)
            {
                $towrite=rtrim($chekcont[$i]);
                if ($towrite!=$ident)
                {
                    fwrite($fp, $towrite); fwrite($fp, "\r\n");
                }
            }
        }
        fclose($fp);
        unlink('bagechek/'.$z[16]);
        rename('bagechek/'.$z[16].'.tmp', 'bagechek/'.$z[16]);
        if ((is_countable($chekcont) ? count($chekcont) : 0)<=1)
		{
            $z[16]=0;
            $ident=implode("l",$z);
        }
        exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id='.$ident.'">');
    }
    else
	{
        exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
    }
