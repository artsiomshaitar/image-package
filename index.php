<?php
/**
 * Created by PhpStorm.
 * User: artyomshaitor
 * Date: 11.01.16
 * Time: 16:34
 */

require_once 'ImageDownloader.php';

$imageDownloader = new ImageDownloader();

var_dump($imageDownloader->downloadImage('https://pp.vk.me/c627525/v627525809/2bb9d/hHjUzVKFYyk.jpg', ['jpg', 'gif', 'png']));

