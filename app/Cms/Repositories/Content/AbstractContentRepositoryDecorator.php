<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:17 PM
 */

namespace App\Cms\Repositories\Content;


use App\Cms\Models\Content;

abstract class AbstractContentRepositoryDecorator implements ContentRepositoryInterface
{
    protected $contentRepository;

    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function findById($id): Content
    {
        return $this->contentRepository->findById($id);
    }
    public function save($content): Content
    {
        return $this->contentRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->contentRepository->deleteById($id);
    }

    public function findPublic()
    {
        return $this->contentRepository->findPublic();
    }
}