<?php
/**
 * Created by PhpStorm.
 * User: artyomshaitor
 * Date: 11.01.16
 * Time: 21:28
 */

require 'src/ImageDownloader.php';

use IDSrc\ImageDownloader;

class ImageDownloaderTest extends PHPUnit_Framework_TestCase {

    public function testDownloading(){

        $existingImage = "https://d3oaxc4q5k2d6q.cloudfront.net/m/fca28d008748/img/marketing/homepage/testimonial-background.jpg";
        $notExistingImage = 'https://d3oaxc4q5k2d6q.cloudfront.net/m/fca28d008748/img/marketing/homepage/testimonial-background1.jpg';

        $loader = new ImageDownloader();

        $this->assertEquals(true, $loader->downloadImage($existingImage)); // Загрузка существующего изображения в корень
        $this->assertEquals(true, $loader->downloadImage($existingImage, [], 'testFolder')); // Загрузка существующего изображения в папку testFolder
        $this->assertEquals(true, $loader->downloadImage($existingImage, ['jpg', 'png'])); // Загрузка существующего изображения, удовлетворяющего фильтру

        $this->setExpectedException('ErrorException');

        $this->assertEquals(false, $loader->downloadImage($existingImage, ['png'])); // Попытка загрузки существующего изображения, неудовлетворяющего фильтру
        $this->assertEquals(false, $loader->downloadImage($notExistingImage)); // Попытка загрузки несущетсвующего изображения

    }

}
