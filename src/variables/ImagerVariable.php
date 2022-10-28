<?php
/**
 * Imager plugin for Craft CMS 3.x
 *
 * Image transforms gone wild
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace spacecatninja\imagebosstransformer\variables;

use Craft;

class ImagerVariable
{

    /**
     * Fit dimensions into target dimensions
     *
     * @return array
     */
    public function fitInto($origImgWH, $targImgWH): array
    {
      $imgRatio = $origImgWH['width']/$origImgWH['height'];
    	$targRatio = $targImgWH['width']/$targImgWH['height'];
    	$endImgWH = array();
    	if ($imgRatio > $targRatio) {
    		$endImgWH['width'] = $targImgWH['width'];
    		$endImgWH['height'] = round($targImgWH['width']/$imgRatio);
    	} else {
    		$endImgWH['width'] = round($imgRatio*$targImgWH['height']);
    		$endImgWH['height'] = $targImgWH['height'];
    	}
    	return $endImgWH;
    }
}
