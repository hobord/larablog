<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:03 PM
 */

namespace App\Cms\Repositories\Content;

use App\Cms\Models\Content;

interface ContentRepositoryInterface
{
    /**
     * @param $id
     * @return Content
     */
    public function findById($id): Content;

    public function save($content): Content;

    public function deleteById($id);

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findPublic();
}