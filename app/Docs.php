<?php

namespace App;

use Orchid\Platform\Core\Models\Post;

class Docs extends Post
{
    /**
     * @var string
     */
    protected $postType = 'docs';

    /**
     * Get the indexable data array for the model.
     *
     * @param $array
     *
     * @return mixed
     */
    public function toSearchableArray()
    {
        return [
          'id' => $this->id,
          'slug' => $this->slug,
          'text' => $this->getOption('markdown'),
          'locale' => $this->getOption('locale'),
        ];
    }
}
