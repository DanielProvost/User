<?php

namespace App\Service\Avatar\Helpers;

class FileSystemHelper{

    public function checkAndCreateFolder($path)
    {

        if (!is_dir($path)) {
            mkdir($path, 755, true);
        }
    }


    public function write($path,$content)
    {
        $folders=substr($path,0,strrpos($path,'/'));
        $this->checkAndCreateFolder($folders);
        $file=fopen($path,'w');
        fwrite($file,$content);
        fclose($file);



    }






}