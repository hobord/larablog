<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:08 PM
 */

namespace App\Cms\Repositories\ContentMetatag;

use App\Cms\Models\ContentMetatag;



class EloquentContentMetatagRepository implements ContentMetatagRepositoryInterface
{
    private $model;

    /**
     * EloquentMetatagRepository constructor.
     * @param ContentMetatag $model
     */
    public function __construct(ContentMetatag $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return ContentMetatag
     */
    public function findById($id): ContentMetatag
    {
        return $this->model->find($id);
    }

    /**
     * @param ContentMetatag $content
     * @return ContentMetatag
     */
    public function save($content): ContentMetatag
    {
       $content->save();
       return $content;
    }

    /**
     * @param mixed $id
     * @throws \Exception
     */
    public function deleteById($id)
    {
        $content = $this->findById($id);
        $content->delete();
    }

    /**
     * Get all metatags of specific content.
     * @param $content_id
     * @param string $content_model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findByContent($content_id, string $content_model)
    {
        // TODO: Implement findByContent() method.
    }
}