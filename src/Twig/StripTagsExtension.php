<?php


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StripTagsExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('strip_tags', [$this, 'stripTags']),
        ];
    }

    public function stripTags($string)
    {
        return strip_tags($string);
    }
}
