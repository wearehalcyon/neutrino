<?php
namespace App\Utils;

use Illuminate\Support\Str as BaseStr;

class SlugMaker extends BaseStr
{
    public static function slug($title, $separator = '-', $language = 'en', $dictionary = ['@' => 'at'])
    {
        if ($title === '/') {
            return $title;
        }

        $segments = explode('/', $title);

        $slugSegments = array_map(function ($segment) use ($separator, $language, $dictionary) {
            return parent::slug($segment, $separator, $language, $dictionary);
        }, $segments);

        return implode('/', $slugSegments);
    }
}
