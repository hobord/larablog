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
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function findById($id): Page
    {
        return $this->pageRepository->findById($id);
    }
    public function save($content): Page
    {
        return $this->pageRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->pageRepository->deleteById($id);
    }

    public function findPublic()
    {
        return $this->findPublic();
    }
}