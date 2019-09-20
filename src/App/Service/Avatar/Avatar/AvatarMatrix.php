<?php

namespace App\Service\Avatar\Avatar;

class AvatarMatrix{

    const DEFAULT_SIZE=5;
    const DEFAULT_COLORS = ['brown','black','lightgrey'];



    private $size;
    private $colors;
    private $matrix;

    public function __construct(){
        $this->size = self::DEFAULT_SIZE;
        $this->colors = self::DEFAULT_COLORS;
        $this->matrix = [];
    }

    /**
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param array $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return array
     */
    public function getMatrix()
    {
        return $this->matrix;
    }

    public function build(){

        for($i = 0 ; $i < $this->size ; $i++){
            for($j = 0 ; $j < $this->size/2 ; $j++){
                $color = $this->colors[rand(0, count($this->colors) - 1)];
                $this->matrix[$i][$j] = $color;
                $this->matrix[$i][$this->size-1-$j]=$color;
            }
        }
}


}