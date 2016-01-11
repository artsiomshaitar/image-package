<?php
/**
 * Created by PhpStorm.
 * User: artyomshaitor
 * Date: 11.01.16
 * Time: 18:06
 */

namespace IDSrc;

use ErrorException;

class ImageDownloader
{
    private static function upgradeFilter(&$filter)
    {
        foreach($filter as $i => $value)
            $filter[$i] = strtolower($value);

        if(in_array("jpg", $filter) && !in_array("jpeg", $filter))
            $filter[] = 'jpeg';
        elseif(!in_array("jpg", $filter) && in_array("jpeg", $filter))
            $filter[] = 'jpg';

    }

    /**
     * Download image method
     * @param string $imageUrl remote image URL
     * @param array $filter image types. Example ['jpg', 'png', 'gif']
     * @param string $outputFolder folder to save
     * @return bool return true if success and false if error
     * @throws ErrorException if something wrong
     */
    public static function downloadImage($imageUrl, $filter = [], $outputFolder = '/')
    {
        try
        {
            // Temp image
            $remoteImage = file_get_contents($imageUrl);
            $remoteImageName = basename($imageUrl, '?' . $_SERVER['QUERY_STRING']);

            // Checking filter
            if(gettype($filter) != 'array')
                throw new ErrorException("Error exception: \$filter is must be an array");


            // If $imageUrl have wrong URL, throw exception
            if ($remoteImage == false)
                throw new ErrorException("Error exception: \"$imageUrl\" is the wrong URL");

            $type = strtolower(str_replace("image/", "", getimagesize($imageUrl)['mime']));

            self::upgradeFilter($filter);



            // Check image type by filter. If image type is not valid, throw exception
            if(count($filter) > 0 && !in_array($type, $filter))
                throw new ErrorException("Error exception: $type is not valid image type");


            if($outputFolder != '/'){
                $outputFolder =  __DIR__.'/../'.$outputFolder."/";
                if(!is_dir($outputFolder))
                    mkdir($outputFolder, 0777, true);
            }else
                $outputFolder = "";

            file_put_contents($outputFolder.$remoteImageName, $remoteImage);

            return true;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

}