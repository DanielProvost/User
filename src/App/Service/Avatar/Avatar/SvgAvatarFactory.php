<?php

namespace App\Service\Avatar\Avatar;

use App\Service\Avatar\Tools\ColorTools;

class SvgAvatarFactory{

    static public function getAvatar(int $nbColors,int $size){

        $matrix = new AvatarMatrix();
        $matrix->setColors(ColorTools::getRandomColors($nbColors));
        $matrix->setSize($size);
        $svgAvatarRender = new SvgAvatarRenderer('template/avatar.svg.tpl');
        $svg= $svgAvatarRender->render($matrix);

        return $svg;
    }
}