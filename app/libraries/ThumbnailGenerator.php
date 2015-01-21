<?php
/**
 * Created by PhpStorm.
 * User: dhamez
 * Date: 1/19/15
 * Time: 9:05 PM
 */

namespace Tristan\ThumbnailGenerator;

class ThumbnailGenerator {

    public $destination;
    public $width;
    public $pdf_storage;

    public static $supported_doc_types = array('pdf','doc','docx','xls','xlsx','ppt','pptx','odt');
    public static $supported_image_types = array('jpg','jpeg','png','gif');
    public static $default_file_thumbs = array(
            'mp3' => 'document-frequency-icon.png',
            'aac' => 'document-frequency-icon.png',
            'rar' => 'document-compress-icon.png',
            'zip' => 'document-compress-icon.png',
            'html'=> 'document-network-icon.png',
            'psd' => 'document-adobe-photoshop-icon.png',
            'ai'  => 'document-adobe-illustrator-icon.png',
            'mp4' => 'document-film-icon.png',
            'avi' => 'document-film-icon.png',
            'flv' => 'document-film-icon.png',
            'mpeg'=> 'document-film-icon.png',
            'exe' => 'document-application-icon.png',
            'msi' => 'document-application-icon.png',
            'txt' => 'document-compare-icon.png'
        );

    public function __construct($destination = null){
        if($destination == null){
            $this->destination = public_path("documents/thumbs/");
        } else {
            $this->destination = public_path($destination);
        }
        $this->pdf_storage = public_path("documents/pdf/");
    }

    public function generateThumbnail($source, $width = 256){
        $this->width = $width;
        $source = public_path($source);

        $file = new \Symfony\Component\HttpFoundation\File\File($source);
        $extension = strtolower($file->getExtension());

        if(in_array($extension, ThumbnailGenerator::$supported_image_types)){
            $path = $this->imageToThumb($file);
        } else if(in_array($extension, ThumbnailGenerator::$supported_doc_types)){
            if($extension != 'pdf'){
                $file = $this->convertToPDF($file);
                $path = $this->pdfToThumbnail($file);
                unlink($file->getPathname());
            } else {
                $path = $this->pdfToThumbnail($file);
            }
        } else {
            $extension = $file->getExtension();
            if(isset(ThumbnailGenerator::$default_file_thumbs[$extension])){
                $icon = ThumbnailGenerator::$default_file_thumbs[$extension];
            } else {
                $icon = 'document-empty-icon.png'; // Default icon
            }

            $theme_folder = \Config::get('crm.themes.admin.folder');

            $path = '/admin/'.$theme_folder.'/assets/layout/img/icos/'.$icon;
        }
        return $path;
    }

    private function convertToPDF($file){
        $command = "libreoffice --headless --convert-to pdf '{$file->getPathname()}' --outdir '{$this->pdf_storage}'";
        exec($command);
        $file = new \Symfony\Component\HttpFoundation\File\File($this->pdf_storage.$this->generateFileName($file).".pdf");
        return $file;
    }

    private function pdfToThumbnail($file){
        $im = new \Imagick($file->getPathname());
        $im->setiteratorindex(0);
        $im->setimageopacity(1.0);
        $im->setImageBackgroundColor('white');
        $im->setimageformat("png");
        $im->scaleimage($this->width,0);

//        $dimensions = $im->getimagegeometry();
//        $height = $dimensions['height'];
//        if($height > $this->width)
//            $im->scaleImage(0,$this->width);

        $im->setimagecompression(\Imagick::COMPRESSION_UNDEFINED);
        $im->setimagecompressionquality(0);

        $pathname = $this->destination.$this->generateFileName($file).'_thumb.png';

        unlink($pathname);
        $im->writeImage($pathname);
        $im->destroy();

        return str_replace(public_path(),'',$pathname);
    }

    private function imageToThumb($file){
        $im = new \Imagick($file->getPathname());
        $im->setimageformat("png");
        $im->scaleimage($this->width,0);

//        $dimensions = $im->getimagegeometry();
//        $height = $dimensions['height'];
//        if($height > $this->width)
//            $im->scaleImage(0,$this->width);

        $im->setimagecompression(\Imagick::COMPRESSION_UNDEFINED);
        $im->setimagecompressionquality(0);

        $pathname = $this->destination.$this->generateFileName($file).'_thumb.png';

        unlink($pathname);
        $im->writeImage($pathname);
        $im->destroy();

        return str_replace(public_path(),'',$pathname);
    }

    private function generateFileName($file){
        $filename = $file->getFilename();
        $extension = ".".$file->getExtension();
        $filename = str_replace($extension,'',$filename);
        return $filename;
    }
}