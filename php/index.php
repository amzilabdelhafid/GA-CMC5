<?php

$title = "Index";
$description = "Description";

$view = "index";

if(isset($urlArray[1]) and !empty($urlArray[1]))
{
    if (file_exists(ROOT . DS . 'views' . DS . $urlArray[0] . DS . strtolower($urlArray[1]) . '.php'))
    {
        $view = $urlArray[1];
    }
}



switch ($view)
{
    case 'index':
       
			// $realisation=new realisation;
			// $realisationList=$realisation->GetList(array(),'id_realisation',false,8);
			 
    break;

    case 'detail':

    break;
}

