<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:08 PM
 */

namespace App\Cms\Repositories\Page;

use App\Cms\Models\Page;



class EloquentPageRepository implements PageRepositoryInterface
{
    private $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return Page
     */
    public function findById($id): Page
    {
        return $this->model->find($id);
    }

    public function save($content): Page
    {
       $content->save();
       return $content;
    }

    public function deleteById($id)
    {
        $content = $this->findById($id);
        $content->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findPublic()
    {
        $query = $this->model->newQuery();
        $query->where('status', '=', 'published');
        return $query->get();
    }
}