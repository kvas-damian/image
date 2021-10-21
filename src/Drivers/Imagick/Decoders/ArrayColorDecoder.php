<?php

namespace Intervention\Image\Drivers\Imagick\Decoders;

use ImagickPixel;
use Intervention\Image\Drivers\Abstract\Decoders\AbstractDecoder;
use Intervention\Image\Drivers\Imagick\Color;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\DecoderInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Traits\CanValidateColorArray;

class ArrayColorDecoder extends AbstractDecoder implements DecoderInterface
{
    use CanValidateColorArray;

    public function decode($input): ImageInterface|ColorInterface
    {
        if (! $this->isValidColorArray($input)) {
            $this->fail();
        }

        list($r, $g, $b, $a) = $input;

        $pixel = new ImagickPixel(
            sprintf('rgba(%d, %d, %d, %.2F)', $r, $g, $b, $a)
        );

        return new Color($pixel);
    }
}