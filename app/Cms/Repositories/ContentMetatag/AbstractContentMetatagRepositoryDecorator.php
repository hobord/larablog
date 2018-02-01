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
    protected $contentRepository;

    public function __construct(ContentMetatagRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function findById($id): ContentMetatag
    {
        return $this->contentRepository->findById($id);
    }

    public function save($content): ContentMetatag
    {
        return $this->contentRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->contentRepository->deleteById($id);
    }

    public function findByContent($content_id, string $content_model)
    {
        return $this->contentRepository->findByContent($content_id, $content_model);
    }
}