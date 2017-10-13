<?php

namespace PHPAvatarStylizer;

class PHPAvatarStylizer {

	public $version = '1.0.0';
	
	public $bgColor = '#000000';
	
	public $txtColor = '#FFFFFF';
	
	public $showInverse = FALSE;
	
	/**
	 * The constructor.
	 * @param boolean $showInverse
	 */
	public function  __construct($showInverse = FALSE)
	{
		$this->showInverse = $showInverse;
	}
	
	/*
	* Get color from avatar
	* @param: string $imagePath
	* @return: string inverse color in html code 
	*/
	
	public function getColorFromImage($imagePath,$x = 0,$y = 0)
	{
		if (isset($imagePath))
		{
			// Resize image to get most significant colors
			$arrayHex = array();
			$PREVIEW_WIDTH    = 150;  
			$PREVIEW_HEIGHT   = 150;
			$size = GetImageSize($imagePath);
			$w = $size[0];
			$h = $size[1];
			$scale=1;
			if ($size[0]>0)
			$scale = min($PREVIEW_WIDTH/$size[0], $PREVIEW_HEIGHT/$size[1]);
			if ($scale < 1)
			{
				$width = floor($scale*$size[0]);
				$height = floor($scale*$size[1]);
				// Set the headlines area coordinates and measures
				$areaW = floor($scale*$w);
				$areaH = floor($scale*$h);
				$areaX = floor($scale*$x);
				$areaY = floor($scale*$y);
			}
			else
			{
				$width = $size[0];
				$height = $size[1];
				$areaW = $w;
				$areaH = $h;
				$areaX = $x;
				$areaY = $y;
			}
			$im = imagecreatetruecolor($width, $height);
			if ($size[2]==1)
			$imageOrig=imagecreatefromgif($imagePath);
			if ($size[2]==2)
			$imageOrig=imagecreatefromjpeg($imagePath);
			if ($size[2]==3) {
			$imageOrig=imagecreatefrompng($imagePath);
			$white = imagecolorallocate($im,  255, 255, 255);
			imagefilledrectangle($im, 0, 0, $width, $height, $white);
			}
			imagecopyresampled($im, $imageOrig, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); 
			// crop the image to fit the area selected
			$area = array('x'=>$areaX,'y'=>$areaY,'width'=>$areaW,'height'=>$areaH);
			$im = imagecrop($im,$area);
			$imgWidth = imagesx($im);
			$imgHeight = imagesy($im);
			for ($y=0; $y < $imgHeight; $y++)
			{
				for ($x=0; $x < $imgWidth; $x++)
				{
					$index = imagecolorat($im,$x,$y);
					$Colors = imagecolorsforindex($im,$index);
					$Colors['red']=intval((($Colors['red'])+15)/32)*32;  
					$Colors['green']=intval((($Colors['green'])+15)/32)*32;
					$Colors['blue']=intval((($Colors['blue'])+15)/32)*32;
					if ($Colors['red']>=256)
					$Colors['red']=240;
					if ($Colors['green']>=256)
					$Colors['green']=240;
					if ($Colors['blue']>=256)
					$Colors['blue']=240;
					$arrayHex[]=substr("0".dechex($Colors['red']),-2).substr("0".dechex($Colors['green']),-2).substr("0".dechex($Colors['blue']),-2);
				}
			}
			$arrayHex=array_count_values($arrayHex);
			natsort($arrayHex);
			$colorsKeys = array_keys(array_reverse($arrayHex,true));
			$this->bgColor = '#'.$colorsKeys[0];
			$this->txtColor = (!$this->showInverse?PHPAvatarStylizer::getBrightness($colorsKeys[0]):PHPAvatarStylizer::getColorInverse($colorsKeys[0]));
			imagedestroy($imageOrig);
			imagedestroy($im);
		}
		else die();
	}
	
	/*
	* Get the inverse color
	* @param: string $color html code (ex: #dd2200)
	* @return: string inverse color in html code 
	*/
	
	private function getColorInverse($color){
		$color = str_replace('#', '', $color);
		$inverseColor = '';
		if (strlen($color) != 6){ return '000000'; }
		$eachRGB = '';
		for ($x=0;$x<3;$x++){
			$eachRGB = hexdec(substr($color,(2*$x),2));
			$c = 255 - $eachRGB;
			if($c > 125 && $c < 135) {
				$c = 200;
			}
			$c = ($c < 0) ? 0 : dechex($c);
			$inverseColor .= (strlen($c) < 2) ? '0'.$c : $c;
		}
		return '#'.$inverseColor;
	}
	
	/*
	* Get the brightness of a color
	* @param: string $hex html code (ex: #dd2200)
	* @return: string $brightness in html code 
	*/
	
	private function getBrightness($hex) {
		// returns brightness value from 0 to 255

		// strip off any leading #
		$hex = str_replace('#', '', $hex);

		$c_r = hexdec(substr($hex, 0, 2));
		$c_g = hexdec(substr($hex, 2, 2));
		$c_b = hexdec(substr($hex, 4, 2));

		$color = (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
	
		if ($color > 135) return '#000000';
		else return '#FFFFFF';
	
	}

}