<?

require __DIR__ . '/color-extractor/src/Color.php';
require __DIR__ . '/color-extractor/src/ColorExtractor.php';
require __DIR__ . '/color-extractor/src/Palette.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class ColorImg
{
    public $filePatch;
    public $dbh;

    public function __construct(string $filePatch)
    {
        $this->filePatch = $filePatch;
    }

    /**
     * Основной цвет картинки
     * Метод #1 – 1x1px
     * сжать изображение до размера 1x1px
     *
     * @return string
     */
    public function getMainColorMetod1x1px(): string
    {
        $info = getimagesize($this->filePatch);

        switch ($info[2]) { 
            case 1: 
                $img = imageCreateFromGif($this->filePatch);
                break;					
            case 2: 
                $img = imageCreateFromJpeg($this->filePatch); 
                break;	
            case 3: 
                $img = imageCreateFromPng($this->filePatch); 
                break;
        }
         
        $width = ImageSX($img);
        $height = ImageSY($img);
         
        $thumb = imagecreatetruecolor(1, 1); 
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, 1, 1, $width, $height);
        $color = '#' . dechex(imagecolorat($thumb, 0, 0));

        imageDestroy($img);
        imageDestroy($thumb);

        return $color;
    }

    /**
     * Метод #2 – вычисление среднего цвета	
     * Перебор пикселей и вычисление среднего цвета, 
     * данный метод даёт более светлые тона
     *
     * @return string
     */
    public function getMainColorMetodMedium(): string
    {
        $info = getimagesize($this->filePatch);

        switch ($info[2]) { 
            case 1: 
                $img = imageCreateFromGif($this->filePatch);
                break;					
            case 2: 
                $img = imageCreateFromJpeg($this->filePatch); 
                break;	
            case 3: 
                $img = imageCreateFromPng($this->filePatch); 
                break;
        }
         
        $width = ImageSX($img);
        $height = ImageSY($img);
             
        $total_r = $total_g = $total_b = 0;
        for ($x = 0; $x < $width; $x++) {
            for ($y=0; $y<$height; $y++) {
                $c = ImageColorAt($img, $x, $y);
                $total_r += ($c>>16) & 0xFF;
                $total_g += ($c>>8) & 0xFF;
                $total_b += $c & 0xFF;
            }
        }
         
        $rgb = array(
            round($total_r / $width / $height),
            round($total_g / $width / $height),
            round($total_b / $width / $height)
        );
         
        $color = '#';
        foreach ($rgb as $row) {
            $color .= str_pad(dechex($row), 2, '0', STR_PAD_LEFT);
        }
         
        imageDestroy($img);
        
        return $color;
    }

    /**
     * Метод #3 - ColorExtractor
     * ColorExtractor – «извлекает цвета из изображения, 
     * как это сделал бы человек». Имеет возможность 
     * получить несколько основных цветов.
     * 
     * @return array
     */
    public function getMainColorMetodColorExtractor(): array
    {
        $palette = Palette::fromFilename($this->filePatch);
        $extractor = new ColorExtractor($palette);
        $colors = $extractor->extract(5);

        $color_1 = Color::fromIntToHex($colors[0]);
        $color_2 = Color::fromIntToHex($colors[1]);
        $color_3 = Color::fromIntToHex($colors[2]);

        return [
            $color_1,
            $color_2,
            $color_3
        ];
    }
}