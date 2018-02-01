<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:03 PM
 */

namespace App\Cms\Repositories\ContentMetatag;

use App\Cms\Models\ContentMetatag;

interface ContentMetatagRepositoryInterface
{
    /**
     * Return ContentMetatag By id
     * @param mixed $id
     * @return ContentMetatag
     */
    public function findById($id);

    /**
     * Return ContentMetatag By id
     * @param ContentMetatag $model
     * @return ContentMetatag
     */
    public function save($model);

    /**
     * Return ContentMetatag By id
     * @param mixed $id
     */
    public function deleteById($id);

    /**
     * Get all metatags of specific content.
     * @param $content_id
     * @param string $content_model
     * @return mixed
     */
    public function findByContent($content_id, string $content_model);
}