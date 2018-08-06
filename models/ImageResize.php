<?php
namespace app\models;

use yii\base\Model;
use Yii;
/*
 *  Простой ImageResize version 1.4.0
 *  Опция: (options: exact, portrait, landscape, auto, crop);
 * */

class ImageResize extends Model
{
    private $image;
    private $width;
    private $height;
    private $imageResized;
    private $path;

    function __construct($fileName)  {
        //Открытие изобраение;
        $this->image = $this->openImage($fileName);
        $this->path = $fileName;
        //Сохраняем ширину и высоту;
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);
    }
    private function openImage($file) {
        //Получить расширение файла;
        $extension = strtolower(strrchr($file, '.'));

        switch($extension) {
            case '.jpg':
            case '.jpeg':
                $img = @imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = @imagecreatefromgif($file);
                break;
            case '.png':
                $img = @imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

    public function resizeImage($newWidth, $newHeight, $option = "auto") {

        //Получаем оптимальную ширину и высоту - зависит от параметра $option;
        $optionArray = $this->getDimensions($newWidth, $newHeight, $option);
        $optimalWidth  = $optionArray['optimalWidth'];
        $optimalHeight = $optionArray['optimalHeight'];
        //Создаем холст изображения с измененными сторонами;
        $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
        //Если параметр $option = 'crop'(обрезка), то создаем соответствующий холст
        if ($option == 'crop') {
            $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
        }
    }
    // Копирование изображения;
    public function mCopy($file, $copy, $width = false, $height = false, $option = "auto", $quality = 100) {
        // ;
        if (!file_exists($file)) return false;
        // Копирование файла;
        copy($file,$copy);
        // Уменьшение размера копии;
        if ($width)
            $this->resizeImage($width, $height, $option);
        $this->saveImage($copy, $quality);
    }
    private function getDimensions($newWidth, $newHeight, $option) {

        switch ($option) {
            case 'exact':
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
                break;
            case 'portrait':
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
                break;
            case 'landscape':
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                break;
            case 'auto':
                $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    private function getSizeByFixedHeight($newHeight) {
        $ratio = $this->width / $this->height;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    private function getSizeByFixedWidth($newWidth) {
        $ratio = $this->height / $this->width;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }
    //Масштабировать
    private function getSizeByAuto($newWidth, $newHeight) {
        //Изображение является пейзажом;
        if ($this->height < $this->width) {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        }
        //Изображение является портретом;
        elseif ($this->height > $this->width) {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        }
        //Квадрат;
        else {
            if ($newHeight < $newWidth) {
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            } else if ($newHeight > $newWidth) {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
            } else {
                //Квадрат будет изменен на квадрат;
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
            }
        }

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    //Вычесления масштаб кадрирования изображения;
    private function getOptimalCrop($newWidth, $newHeight) {

        $heightRatio = $this->height / $newHeight;
        $widthRatio  = $this->width /  $newWidth;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $this->height / $optimalRatio;
        $optimalWidth  = $this->width  / $optimalRatio;

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    //Кадрирования изображения;
    private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight) {
        //Находим центр - это необходимо для обрезки;
        $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
        $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

        $crop = $this->imageResized;
        //imagedestroy($this->imageResized);

        //Теперь обрезаем от центра до указанного размера;
        $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
        imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
    }


    //Сохранения избражения;
    public function saveImage($savePath, $imageQuality="100") {
        //Получаем расширение;
        $extension = strrchr($savePath, '.');
        $extension = strtolower($extension);

        switch($extension) {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath);
                }
                break;

            case '.png':
                //Переводим шкалу качества с 0 - 100 в 0 - 9;
                $scaleQuality = round(($imageQuality/100) * 9);

                //Инвертируем качество;
                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                    imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
                break;

            default:
                //Нет расширение - не сохраняем;
                break;
        }
        //Освобождаем память, уничтожая переменную с изображением;
        imagedestroy($this->imageResized);
    }

}