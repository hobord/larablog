<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:03 PM
 */

namespace App\Cms\Repositories\Page;

use App\Cms\Models\Page;

interface PageRepositoryInterface
{
    /**
     * Return Page By id
     * @param $id
     * @return Page
     */
    public function findById($id);

    /**
     * Return Page By id
     * @param Page $model
     * @return Page
     */
    public function save($model);

    /**
     * Return Page By id
     */
    public function deleteById($id);

    public function findPublic();
}