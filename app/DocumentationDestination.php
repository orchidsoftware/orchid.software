<?php

namespace App;

use Spatie\Export\Destination;

class DocumentationDestination implements Destination
{
    public function __construct(protected Destination $destination) {}

    public function clean()
    {
        $this->destination->clean();
    }

    public function write(string $path, string $contents)
    {
        // The exporter mistakes the .x suffix for a file extension.
        if (preg_match('~^/?(?:en|ru)/docs/\d+\.x/?$~D', $path)) {
            $path = rtrim($path, '/').'/index.html';
        }

        $this->destination->write($path, $contents);
    }
}
