<?php

namespace App\Behaviors\Many;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Behaviors\Many;
use Orchid\Platform\Platform\Fields\TD;
use Orchid\Platform\Http\Forms\Posts\BasePostForm;
use Orchid\Platform\Http\Forms\Posts\UploadPostForm;


class Package extends Many
{

    /**
     * @var string
     */
    public $name = 'Packages';

    /**
     * @var string
     */
    public $slug = 'package';

    /**
     * Slug url /news/{name}.
     *
     * @var string
     */
    public $slugFields = '';

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules() : array
    {
        return [];
    }

    /**
     * HTTP data filters
     *
     * @return array
     */
    public function filters() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function fields() : array
    {
        return [];
    }

    /**
     * Grid View for post type.
     */
    public function grid() : array
    {
        return [];
    }

    /**
     * @return array
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function modules() : array
    {
        return [
            BasePostForm::class,
            UploadPostForm::class,
        ];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @param $array
     *
     * @return mixed
     */
    public function toSearchableArray($array)
    {
        return [
            'id' => $array['id'],
            'slug' => $array['slug'],
            'name' => $array['content']['description'],
        ];
    }

}
