<?php

/**
 * Created by PhpStorm.
 * User: mikser
 * Date: 11.08.17
 * Time: 15:57
 * @example https://true-coder.ru/php/php-klass-dlya-resajza-izobrazhenij.html
 */
class AddImage
{
    private $image; //идентификатор самого изображения
    private $width; //исходная ширина
    private $height; //исходная высота
    private $type; //тип изображения (jpg, png, gif)
    private $targetPath = 'upload/';
    private $fileName;
    public $newName;
    public $newIcoName;

    function __construct($file)
    {
        if (@file_exists($file)) exit("Файл существует");
        if (!$this->setType($file["file"]["tmp_name"])) exit("File is not an image");
        $this->moveMainImage($file);
        $this->openImage($this->fileName);
        $this->setSize();
    }

    //функция проверяет, является ли файл изображением и устанавливает его тип
    private function setType($file)
    {
        $mime = mime_content_type($file);
        switch ($mime) {
            case 'image/jpeg':
                $this->type = "jpg";
                return true;
            case 'image/png':
                $this->type = "png";
                return true;
            case 'image/gif':
                $this->type = "gif";
                return true;
            default:
                return false;
        }
    }

    /**
     * Получаем временный файл и перемещаем его с новым именем
     * Записываем новое имя в newName
     * Записываем путь и имя в fileName
     * @param $file
     */
    private function moveMainImage($file)
    {
        $sourcePath = $file['file']['tmp_name'];
        $createName = date("Ymd") . rand(1, 100000) . '.' . $this->type;
        $target = $this->targetPath . $createName;
        $this->fileName = $target;
        $this->newName = $createName;

        move_uploaded_file($sourcePath, $target);

    }

    //создаёт в зависимости от типа на основе файла идентификатор изображения
    private function openImage($file)
    {
        switch ($this->type) {
            case 'jpg':
                $this->image = @imagecreatefromjpeg($file);
                break;
            case 'png':
                $this->image = imagecreatefrompng($file);
                break;
            case 'gif':
                $this->image = @imagecreatefromgif($file);
                break;
            default:
                exit("File is not an image");
        }
    }

    //устанавливает размеры изображения
    private function setSize()
    {
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    private function getSizeByFramework($width, $height)
    {
        if ($this->width <= $width && $this->height <= height)
            return array($this->width, $this->height);
        if ($this->width / $width > $this->height / $height) {
            $newSize[0] = $width;
            $newSize[1] = round($this->height * $width / $this->width);
        } else {
            $newSize[1] = $height;
            $newSize[0] = round($this->width * $height / $this->height);
        }
        return $newSize;
    }

    public function resize($width = false, $height = false)
    {
        /**
         * В зависимости от типа ресайза, запишем в $newSize новые размеры изображения.
         */
        if (is_numeric($width) && is_numeric($height) && $width > 0 && $height > 0) {
            $newSize = $this->getSizeByFramework($width, $height);
        } else if (is_numeric($width) && $width > 0) {
            $newSize = $this->getSizeByWidth($width);
        } else if (is_numeric($height) && $height > 0) {
            $newSize = $this->getSizeByHeight($height);
        } else $newSize = array($this->width, $this->height);
        //создаём новое пустое изображение
        $newImage = imagecreatetruecolor($newSize[0], $newSize[1]);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newSize[0], $newSize[1], $this->width, $this->height);
        $this->image = $newImage;
        $this->setSize();
    }

    /**
     * Функция для создания миниатюр изображений.
     * Функция getSizeByThumbnail возвращает новые размеры изображения.
     *
     * @param $width integer        Ширина миниатюры
     * @param $height integer    Высота миниатюры
     * @param $c integer            Коэффициент превышения...
     * @return object            Текущий объект класса
     */
    function thumbnail($width, $height, $c = 2)
    {
        if (!is_numeric($width) || $width <= 0) $width = $this->width;
        if (!is_numeric($height) || $height <= 0) $height = $this->height;
        if (!is_numeric($c) || $c <= 1) $c = 2;
        $newSize = $this->getSizeByThumbnail($width, $height, $c);
        $newImage = imagecreatetruecolor($newSize[0], $newSize[1]);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newSize[0], $newSize[1], $this->width, $this->height);
        $this->image = $newImage;
        $this->setSize();
        return $this;
    }

    /**
     * Приватная функция, определяющая размеры нового изображения при создании миниатюры.
     * Функция вписывает изображение в указанную область, стараясь максимально заполнить её.
     * Если после ужатия по одной из сторон, вторая сторона привышает размеры области более чем в $c раз,
     * то ужатие происходит по второй стороне.
     * Если же вторая сторона превышает размер области в 2 * $c раз, то стороны уменьшаются в 2 раза.
     * Если одна из сторон заведомо меньше соответствующей стороны области,
     * проверяется, не превышает ли другая сторона соответствующую сторону области в $c раз и 2 * $c.
     * Если ресайз производится не по ширине, а по высоте, переменные, содержащие размеры исходного изображения
     * и размеры миниатюры, меняются местами.
     * Также местами меняются мирина и высота в возвращаемом массиве.
     *
     * @param $width integer        Максимальная ширина нового изображения
     * @param $height integer    Максимальная высота нового изображения
     * @param $с integer            Коэффициент превышения...
     * @return array            Массив, содержащий размеры нового изображения
     */
    private function getSizeByThumbnail($width, $height, $c)
    {
        if ($this->width <= $width && $this->height <= height)
            return array($this->width, $this->height);
        $realW = $this->width;
        $realH = $this->height;

        $rotate = false;
        if ($width / $realW <= $height / $realH) {
            $t = $realH;
            $realH = $realW;
            $realW = $t;
            $t = $width;
            $width = $height;
            $height = $t;
            $rotate = true;
        }

        $limX = $c * $width;
        $limY = $c * $height;
        $possH = $realH * $width / $realW;

        if ($realW > $width) {
            if ($possH <= $limY) {
                $newSize[0] = $width;
                $newSize[1] = round($possH);
            } else {
                if ($possH <= 2 * $limY) {
                    $newSize[1] = $limY;
                    $newSize[0] = $realW * $newSize[1] / $realH;
                } else {
                    $newSize[0] = $width / 2;
                    $newSize[1] = $realH * $newSize[0] / $realW;
                }
            }
        } else {
            if ($realH <= $limY) {
                $newSize[0] = $realW;
                $newSize[1] = $realH;
            } else {
                if ($realH <= 2 * $limY) {
                    if ($realW * $limY / $realH >= $width / 2) {
                        $newSize[1] = $limY;
                        $newSize[0] = $realW * $limY / $realH;
                    } else {
                        $newSize[0] = $width / 2;
                        $newSize[1] = $realH * $newSize[0] / $realW;
                    }
                } else {
                    $newSize[0] = $width / 2;
                    $newSize[1] = $realH * $newSize[0] / $realW;
                }
            }
        }
        if ($rotate) {
            $t = $newSize[0];
            $newSize[0] = $newSize[1];
            $newSize[1] = $t;
        }
        return $newSize;
    }

    /**
     * Функция, сохраняющая изображение в файл
     *
     * @param $path string        Путь, по которому следует сохранить файл
     * @param $fileName string    Имя нового файла
     * @param $type string        Тип файла (по умолчанию (false) - тот же, что и у исходного изображения)
     * @param $rewrite boolean    Флаг, определяющий, можно ли перезаписывать файлы с одинаковыми именами
     * @param $quality integer    Качество изображения для JPG-файлов
     * @return string            Адрес нового файла
     */
    function save($path = '', $type = false, $rewrite = false, $quality = 100)
    {
        if ($this->image === false) return false;

        $filename = basename($this->fileName, ".$this->type");
        $finalIcoName = trim($filename) . "-ico." . $type;
        $type = strtolower($type);
        switch ($type) {
            case false:
                $savePath = $path . trim($filename) . $this->type;
                switch ($this->type) {
                    case 'jpg':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        if (!is_numeric($quality) || $quality < 0 || $quality > 100) $quality = 100;
                        imagejpeg($this->image, $savePath, $quality);
                        return $savePath;
                    case 'png':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        imagepng($this->image, $savePath);
                        return $savePath;
                    case 'gif':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        imagegif($this->image, $savePath);
                        return $savePath;
                    default:
                        return false;
                }
                break;
            case 'jpg':
                $savePath = $path . $finalIcoName;
                if (!$rewrite && @file_exists($savePath)) return false;
                if (!is_numeric($quality) || $quality < 0 || $quality > 100) $quality = 100;
                imagejpeg($this->image, $savePath, $quality);
                $this->newIcoName = $finalIcoName;
                return $savePath;
            case 'png':
                $savePath = $path . $finalIcoName;
                if (!$rewrite && @file_exists($savePath)) return false;
                imagepng($this->image, $savePath);
                $this->newIcoName = $finalIcoName;
                return $savePath;
            case 'gif':
                $savePath = $path . $finalIcoName;
                if (!$rewrite && @file_exists($savePath)) return false;
                imagegif($this->image, $savePath);
                $this->newIcoName = $finalIcoName;
                return $savePath;
            default:
                return false;
        }
    }
}