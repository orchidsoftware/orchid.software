<?php

use App\Listeners\GenerateDocumentList;
use App\Listeners\GeneratePFDDocument;
use App\Listeners\GenerateSitemap;
use App\Listeners\GenerateTypography;
use TightenCo\Jigsaw\Jigsaw;

/* @var $container \Illuminate\Container\Container */
/* @var $events \TightenCo\Jigsaw\Events\EventBus */

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->afterBuild(GenerateDocumentList::class);
$events->afterBuild(GenerateTypography::class);
$events->afterBuild(GenerateSitemap::class);
//$events->afterBuild(GeneratePFDDocument::class);
