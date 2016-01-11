<?php
/**
 * Created by PhpStorm.
 * User: artyomshaitor
 * Date: 11.01.16
 * Time: 18:06
 */


class ImageDownloader
{

    /*
    private $connector;
    private $imagelist;


    public function __construct($host = "kasatkatest.ml", $user = "u333817651", $password = "7290020a", $port = null, $folder = "public_html"){
        $this->connector = new Connector($host, $user, $password, $port, $folder);
    }


    public function loadImagesFromRemote($types){
        $list = $this->connector->getImagesList($types);
        var_dump($list);
    }
    */

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
            if(!in_array($type, $filter))
                throw new ErrorException("Error exception: $type is not valid image type");

            $folder = ($outputFolder != '/')? $_SERVER['DOCUMENT_ROOT'].'/'.$outputFolder : $_SERVER['DOCUMENT_ROOT'];

            if(!is_dir($folder))
                if(!mkdir($folder))
                    throw new ErrorException("Error exception: \"{$outputFolder}\" is not a valid folder");



            file_put_contents($folder.'/'.$remoteImageName, $remoteImage);

            return true;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

}