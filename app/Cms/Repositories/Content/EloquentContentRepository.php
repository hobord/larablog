<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:08 PM
 */

namespace App\Cms\Repositories\Content;

use App\Cms\Models\Content;



class EloquentContentRepository implements ContentRepositoryInterface
{
    private $model;

    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return Content
     */
    public function findById($id): Content
    {
        return $this->model->find($id);
    }

    public function save($content): Content
    {
       $content->save();
       return $content;
    }

    public function deleteById($id)
    {
        $content = $this->findById($id);
        $content->delete();
    }

    public function findPublic()
    {
        $query = $this->model->newQuery();
        $query->where('status', '=', 'published');
        return $query->get();
    }
}