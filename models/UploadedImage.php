<?php
namespace app\models;
use Yii;
use yii\web\UploadedFile;
use yii\base\Model;
use app\models\ImageResize;

class UploadedImage  extends Model
{
    public $imageMax;
    public $imageMin;
    /**
     * @inheritdoc 'skipOnEmpty' => false,'maxFiles' => 100
     */
    public function rules()
    {
        return [
            [['imageMax','imageMin'], 'file',  'extensions' => 'png, jpg, gif, svg'],
        ];
    }

    // Загружаем изображения 1024x768, 1152x864, 1280х960;
    public function isUpload($file=false, $width=1280, $height=960, $minWidth = 600, $minHeight= false, $options='auto',$m_options='auto')
    {
        if ($this->validate()) {

            if(empty($this->imageMax->extension)) return false;
            $fileDir = $file . '.' . $this->imageMax->extension;
            $this->imageMax->saveAs($fileDir);

            // Ресайз;
            if(!empty($width)) {
                $imageResize = new ImageResize($fileDir);
                $imageResize->resizeImage($width, $height, $options);
                $imageResize->saveImage($fileDir, 100);
                if(!empty($minWidth)) {
                    // Для обложки;
                    $fileDirMin = $file . '_min.' . $this->imageMax->extension;
                    $imageResize->mCopy($fileDir, $fileDirMin, $minWidth, $minHeight, $m_options);

                }

            }

            return true;
        } else {

            return false;
        }
    }


}