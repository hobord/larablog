<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:17 PM
 */

namespace App\Cms\Repositories\Page;


use App\Cms\Models\Page;

abstract class AbstractPageRepositoryDecorator implements PageRepositoryInterface
{
    protected $contentRepository;

    public function __construct(PageRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function findById($id): Page
    {
        return $this->contentRepository->findById($id);
    }
    public function save($content): Page
    {
        return $this->contentRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->contentRepository->deleteById($id);
    }

    public function findPublic()
    {
        return $this->findPublic();
    }
}