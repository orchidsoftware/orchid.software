<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\Jigsaw;

class GenerateNotFound
{

    /**
     * @param Jigsaw $jigsaw
     */
    public function handle(Jigsaw $jigsaw)
    {
        collect($jigsaw->getOutputPaths())
            ->reject(function ($path) {
                return !Str::is('*404*', $path);
            })
            ->each(function ($path) use ($jigsaw) {
                $path = Str::finish($path, '/').'index.html';
                $file = $jigsaw->readOutputFile($path);
                $jigsaw->writeOutputFile('404.html',$file);
            });

    }
}
