<?php

  class Autoloader
  {
    public function __construct(){}

    public static function autoload($file, $ext = FALSE, $dir = FALSE)
    {
        $file = str_replace('\\', '/', $file);

        if($ext === FALSE){
            $path = $_SERVER['DOCUMENT_ROOT'] . '/';
            $filepath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file . '.php';
        }
        else {
            $path = $_SERVER['DOCUMENT_ROOT'] . (($dir) ? '/' . $dir : '');
            $filepath = $path . '/' . $file . '.' . $ext;
        }
      
        if (file_exists($filepath)){
            if($ext === FALSE){
                require_once($filepath);
            }
            else {
                return $filepath;
            }
        }
        else {
            $flag = true;
            return Autoloader::recursive_autoload($file, $path, $ext, $flag);
        }
    }

    public static function recursive_autoload($file, $path, $ext, &$flag)
    {
        if (FALSE !== ($handle = opendir($path)) && $flag){
            while (FAlSE !== ($dir = readdir($handle)) && $flag){
                if (strpos($dir, '.') === FALSE)
                {
                    $path2 = $path .'/' . $dir;
                    $filepath = $path2 . '/' . $file .(($ext === FALSE) ? '.php' : '.' . $ext);
        
                    if (file_exists($filepath))
                    {
                    $flag = FALSE;
                    if($ext === FALSE)
                    {
                        require_once($filepath);
                        break;
                    }
                    else
                    {
                        return $filepath;
                    }
                    }
                    $res = Autoloader::recursive_autoload($file, $path2, $ext, $flag); 
                }
            }
            closedir($handle);
        }
        return $res;
    }
}

\spl_autoload_register('Autoloader::autoload');