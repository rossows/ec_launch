<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Entities\ProductEntity;
use Illuminate\Support\Collection;
use Exception;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductService constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * 商品一覧取得
     *
     * @return Collection 商品一覧リスト
     */
    public function getProductList(): Collection
    {
        return $this->productRepository->getProductList();
    }

    /**
     * 商品登録
     *
     * @param array $records 商品情報
     * @throws Exception
     */
    public function storeProduct(array $records)
    {
        $entity = $this->productRepository->new($records);

        try {
            $this->productRepository->persist($entity);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * IDをキーとして商品を取得
     *
     * @param int $id
     * @return ProductEntity
     */
    public function getProductById(int $id): ?ProductEntity
    {
        $entity = $this->productRepository->getProductById($id);

        if (is_null($entity)) {
            return null;
        }
        return $entity;
    }

    /**
     * 商品情報更新
     *
     * @param  array $records
     * @throws Exception
     */
    public function updateProduct(array $records)
    {
        $entity = $this->getProductById($records['id']);
        $entity->setName($records['name']);
        $entity->setGenre($records['genre']);
        $entity->setPrice($records['price']);
        $entity->setDescription($records['description']);

        $this->productRepository->persist($entity);
    }

    /**
     * IDに紐づく商品を削除する
     *
     * @param int $id 商品ID
     * @return boolean
     */
    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->softDeleteById($id);
    }
}
