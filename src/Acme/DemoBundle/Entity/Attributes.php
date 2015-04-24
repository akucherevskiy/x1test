<?php
namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Range;

class Attributes
{
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 100,
     *      max = 500,
     *      minMessage = "Sorry! No less than {{ limit }}",
     *      maxMessage = "Sorry! No more than {{ limit }}"
     * )
     */
    public $width;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 100,
     *      max = 500,
     *      minMessage = "Sorry! No less than {{ limit }}",
     *      maxMessage = "Sorry! No more than {{ limit }}"
     * )
     */
    public $height;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[#a-f0-9]{6}/i",
     *     match=true,
     *     message="Use Hex!"
     * )
     */
    public $bgColor;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[#a-f0-9]{6}/i",
     *     match=true,
     *     message="Use Hex!"
     * )
     */
    public $textColor;

    /**
     * @param $width
     */
    public function setWidth($width){
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getWidth(){
        return $this->width;
    }

    /**
     * @param $height
     */
    public function setHeight($height){
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getHeight(){
        return $this->height;
    }

    /**
     * @param $bgColor
     */
    public function setBgColor($bgColor){
        $this->bgColor = $bgColor;
    }

    /**
     * @return mixed
     */
    public function getBgColor(){
        return $this->bgColor;
    }

    /**
     * @param $textColor
     */
    public function setTextColor($textColor){
        $this->textColor = $textColor;
    }

    /**
     * @return mixed
     */
    public function getTextColor(){
        return $this->textColor;
    }
}

