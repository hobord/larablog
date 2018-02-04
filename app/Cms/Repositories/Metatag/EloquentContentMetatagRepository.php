<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:08 PM
 */

namespace App\Cms\Repositories\Metatag;

use App\Cms\Models\Metatag;



class EloquentMetatagRepository implements MetatagRepositoryInterface
{
    private $model;

    /**
     * EloquentMetatagRepository constructor.
     * @param Metatag $model
     */
    public function __construct(Metatag $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return Metatag
     */
    public function findById($id): Metatag
    {
        return $this->model->find($id);
    }

    /**
     * @param Metatag $content
     * @return Metatag
     */
    public function save($content): Metatag
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
     * @return mixed
     */
    public function listAll()
    {
        return $this->model->query()
            ->orderBy('group')
            ->orderBy('name')
            ->all();
    }
}