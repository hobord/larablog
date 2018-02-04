<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:17 PM
 */

namespace App\Cms\Repositories\ContentMetatag;

use App\Cms\Models\ContentMetatag;

abstract class AbstractContentMetatagRepositoryDecorator implements ContentMetatagRepositoryInterface
{
    protected $contentMetatagRepository;

    public function __construct(ContentMetatagRepositoryInterface $contentMetatagRepository)
    {
        $this->contentMetatagRepository = $contentMetatagRepository;
    }

    public function findById($id): ContentMetatag
    {
        return $this->contentMetatagRepository->findById($id);
    }

    public function save($content): ContentMetatag
    {
        return $this->contentMetatagRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->contentMetatagRepository->deleteById($id);
    }

    public function findByContent($content_id, string $content_model)
    {
        return $this->contentMetatagRepository->findByContent($content_id, $content_model);
    }
}