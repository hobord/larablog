<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:17 PM
 */

namespace App\Cms\Repositories\Metatag;

use App\Cms\Models\Metatag;

abstract class AbstractMetatagRepositoryDecorator implements MetatagRepositoryInterface
{
    protected $metatagRepository;

    public function __construct(MetatagRepositoryInterface $metatagRepository)
    {
        $this->metatagRepository = $metatagRepository;
    }

    public function findById($id): Metatag
    {
        return $this->metatagRepository->findById($id);
    }

    public function save($content): Metatag
    {
        return $this->metatagRepository->save($content);
    }

    public function deleteById($id)
    {
        return $this->metatagRepository->deleteById($id);
    }

    public function listAll()
    {
        return $this->metatagRepository->listAll();
    }
}