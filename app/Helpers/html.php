<?php

function javascript_ts($path)
{
    try{
        $ts = '?v=' . File::lastModified(public_path() . $path);
    }
    catch (Exception $e){
        $ts = '';
    }
    return '<script src="' . $path . $ts . '" defer></script>';
}