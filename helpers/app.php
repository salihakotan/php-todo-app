<?php

function route($index)
{
    global $config;
    if (isset($config['route'][$index])) {
        return $config['route'][$index];
    }else{
        return false;
    }
}

function view($viewName,$pageData=[])
{
    $data = $pageData;

    if (file_exists(BASEDIR.'/View/'.$viewName.'.php')) require BASEDIR.'/View/'.$viewName.'.php';
        else return false;
}

function assets($assetName)
{
    if (file_exists(BASEDIR.'/public/'.$assetName)) return URL.'public/'.$assetName;
    else return false;
}