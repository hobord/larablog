<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:03 PM
 */

namespace App\Cms\Repositories\Metatag;

use App\Cms\Models\Metatag;

interface MetatagRepositoryInterface
{
    /**
     * Return Metatag By id
     * @param mixed $id
     * @return Metatag
     */
    public function findById($id);

    /**
     * Return Metatag By id
     * @param Metatag $model
     * @return Metatag
     */
    public function save($model);

    /**
     * Return Metatag By id
     * @param mixed $id
     */
    public function deleteById($id);

    /**
     * @return mixed
     */
    public function listAll();

}