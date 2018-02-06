<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:08 PM
 */

namespace App\Cms\Repositories\Page;

use App\Cms\Models\Page;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class EloquentPageRepository implements PageRepositoryInterface
{
    /** @var Page $model */
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

    /**
     * @param Page $content
     * @return Page
     */
    public function save($content): Page
    {
       $content->save();
       return $content;
    }

    /**
     * @param $id
     * @throws \Exception
     */
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

    /**
     * @param $args
     * @param $fields
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginatedQuery($args, $fields)
    {
        $query = $this->model->newQuery();

        $where = function (Builder $query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }

            if (isset($args['title'])) {
                $query->where('title', 'like', '%' . $args['title'] . '%');
            }

            if (isset($args['editor_id'])) {
                $query->where('editor_id', '=', $args['editor_id']);
            }

            if (isset($args['categories_id'])) {
                foreach ($args['categories_id'] as $tag_id) {
                    $query->whereHas('categories', function(Builder $q) use ($tag_id) {
                        $q->where('category_id', $tag_id);
                    });
                }
            }

            if (isset($args['tags_id'])) {
                $tags = $args['tags_id'];
                $query->whereHas('categories', function(Builder $q) use ($tags) {
                    $q->whereIn('category_id', $tags);
                });
            }
        };

        $order_by = (array_key_exists('order_by', $args)) ? $args['order_by'] : 'id';
        $order_asc = (array_key_exists('order_asc', $args)) ? $args['order_asc'] : false;

        $limit = (array_key_exists('limit', $args)) ? $args['limit'] : 15;
        $page = (array_key_exists('page', $args)) ? $args['page'] : 0;

        $query = $query->where($where)
            ->orderBy($order_by, ($order_asc)?'asc':'desc');

        return $query->paginate($limit, ['*'], 'page', $page);
    }
}