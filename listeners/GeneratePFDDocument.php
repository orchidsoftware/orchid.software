<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use Parsedown;
use Spipu\Html2Pdf\Html2Pdf;
use TightenCo\Jigsaw\Jigsaw;

class GeneratePFDDocument
{
    /**
     * @param Jigsaw $jigsaw
     *
     * @throws \Spipu\Html2Pdf\Exception\Html2PdfException
     */
    public function handle(Jigsaw $jigsaw)
    {
        $languages = require 'navigation.php';

        foreach ($languages as $lang => $pages) {
            $this->generateBook($jigsaw, $pages, $lang);
        }
    }

    /**
     * @param Jigsaw $jigsaw
     * @param array  $rawPages
     * @param string $lang
     *
     * @throws \Spipu\Html2Pdf\Exception\Html2PdfException
     */
    private function generateBook(Jigsaw $jigsaw, array $rawPages, string $lang)
    {
        $html = '';

        $pages = [];
        array_walk_recursive($rawPages, function ($item) use (&$pages) {
            $pages[] = $item;
        });

        foreach ($pages as $page) {
            $page = Str::endsWith($page, '/') ? $page.'index.md' : $page.'.md';

            $page = $jigsaw->readSourceFile($page);

            $parse = new Parsedown();
            $html .= $parse->text($page);
        }

        $html2pdf = new Html2Pdf('P', 'A4', $lang);
        $html2pdf->writeHTML(utf8_encode($html));
        $content = $html2pdf->output($lang.'.pdf', 'S');
        $jigsaw->writeOutputFile($lang.'.pdf', $content);
    }
}
