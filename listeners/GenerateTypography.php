<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use JoliTypo\Fixer;
use TightenCo\Jigsaw\Jigsaw;

class GenerateTypography
{
    /**
     * @var Fixer
     */
    public $fixer;

    /**
     * GenerateDocumentList constructor.
     */
    public function __construct()
    {
        $this->fixer = new Fixer(['Ellipsis', 'Dimension', 'Unit', 'Dash', 'SmartQuotes', 'NoSpaceBeforeComma', 'CurlyQuote', 'Trademark']);
    }

    /**
     * @param Jigsaw $jigsaw
     */
    public function handle(Jigsaw $jigsaw)
    {
        collect($jigsaw->getOutputPaths())
            ->reject(function ($path) {
                return !Str::is('*docs*', $path);
            })
            ->each(function ($path) use ($jigsaw) {
                $path = Str::finish('/'.$path, '/').'index.html';
                $file = $jigsaw->readOutputFile($path);

                $this->fixer->setLocale(Str::is('*/ru/*', $path) ? 'ru_RU' : 'en_GB');
                $page = $this->fixer->fix($file);

                file_put_contents($jigsaw->getDestinationPath().$path, $page);
            });
    }
}
