# Image Downloader
Composer package that can download images from a remote to the server

## Installation

Install the latest version with

```bash
$ composer require artyomshaitor/image-package
$ composer update
```

## Usage

```php
use SRC\ImageDownloader;

require __DIR__ . '/vendor/autoload.php';

$loader = new ImageDownloader();
$loader->downloadImage("https://pp.vk.me/c7003/v7003346/15ecb/fBZpkWNulu4.jpg"); // simple image downloading
$loader->downloadImage("https://pp.vk.me/c7003/v7003346/15ecb/fBZpkWNulu4.jpg",['jpg', 'png']); // download only image with ".jpg" or ".png" types 
$loader->downloadImage("https://pp.vk.me/c7003/v7003346/15ecb/fBZpkWNulu4.jpg", [], 'images'); // download image to 'images' folder
```

### Requirements

- Image Downloader works with PHP 5.3 or above.

### Author

Artyom Shaitor - <artyomshaitor@gmail.com> - <http://twitter.com/artyom_shaitor><br />
my VK page - <http://vk.com/artyomshaitor>

### License

Image Downloader is licensed under the MIT License.
