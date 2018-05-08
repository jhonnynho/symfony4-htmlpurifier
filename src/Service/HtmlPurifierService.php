<?php

namespace App\Service;

use HTMLPurifier;
use HTMLPurifier_Bootstrap;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    public function purifyHtml(string $html): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('CSS.AllowedProperties', $this->allowedStylesProperties());
        $config->set('HTML.Allowed', $this->allowedHtmlTags());
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($html);

        return $clean_html;
    }

    /**
     * @return array
     */
    private function allowedStylesProperties() : array {
        return array(
            'text-decoration',
            'text-align',
            'list-style-type',
            'padding-left'
        );
    }

    /**
     * @return string
     */
    private function allowedHtmlTags() : string {
        return "p[style],a[href|title|target|rel],span[style],strong,em,ol[style],li,ul[style]";
    }
}