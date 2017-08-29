<?php

namespace App\Core\Behaviors\Many;

use Orchid\CMS\Behaviors\Many;
use Orchid\CMS\Http\Forms\Posts\BasePostForm;
use Orchid\CMS\Http\Forms\Posts\UploadPostForm;


class NewsType extends Many
{
    /**
     * @var string
     */
    public $name = 'Новости';

    /**
     * @var string
     */
    public $description = 'Базовый тип новости';

    /**
     * @var string
     */
    public $slug = 'news';

    /**
     * @var string
     */
    public $icon = 'fa fa-newspaper-o';

    /**
     * Slug url /news/{name}.
     * @var string
     */
    public $slugFields = 'name';

    /**
     * Rules Validation.
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'                    => 'sometimes|integer|unique:posts',
            'content.*.name'        => 'required|string',
            'content.*.body'        => 'required|string',
            'content.*.title'       => 'required|string|max:255',
            'content.*.description' => 'required|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name'        => 'tag:input|type:text|name:name|max:255|required|title:Название|help:Главный заголовок',
            'body'        => 'tag:wysiwyg|name:body|max:255|required|rows:10',
            'source'      => 'tag:input|type:url|name:source|title:Источник статьи|help:Ссылка не индексируется',
            'title'       => 'tag:input|type:text|name:title|max:255|required|title:Заголовок статьи|help:Вверхней части странице',
            'description' => 'tag:textarea|name:description|max:255|required|rows:5|title:Краткое описание',
            'keywords'    => 'tag:tags|name:keywords|max:255|required|title:Ключевые слова|help:Записывайте через запятую',
            'robot'       => 'tag:robot|name:robot|max:255|required|title:Индексация|help:Разрешить поисковым роботам индесацию страницы',
        ];
    }

    /**
     * Grid View for post type.
     */
    public function grid()
    {
        return [
            'name'       => 'Название',
            'publish_at' => 'Дата публикации',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return array
     */
    public function modules()
    {
        return [
            BasePostForm::class,
            UploadPostForm::class,
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function display()
    {
        return collect([
            'name' => 'Новости',
            'icon' => '',
            'time' => false,
        ]);
    }

}
