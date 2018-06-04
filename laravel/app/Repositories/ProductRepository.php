<?php

namespace App\Repositories;

use App\Entities\ProductEntity;
use App\Models\Product;
use Illuminate\Support\Collection;
use Exception;

class ProductRepository
{
    /**
     * 新規作成、エンティティを返す
     *
     * @param array $record
     * @return ProductEntity
     */
    public function new(array $record): ProductEntity
    {
        return new ProductEntity((new Product())->forceFill($record));
    }

    /**
     * 永続化
     *
     * @return ProductEntity
     * @throws Exception
     */
    public function persist(ProductEntity $entity): ProductEntity
    {
        $record = $entity->getRecord();

        if (!$record->save()) {
            throw new Exception('永続化失敗');
        }
        return $entity;
    }

    /**
     * 商品一覧取得
     *
     * @return Collection
     */
    public function getProductList(): Collection
    {
        return collect(Product::all())
            ->map(function (Product $record) {
                return new ProductEntity($record);
            });
    }

    /**
     * IDをキーとして商品を取得
     *
     * @param int $id
     * @return ProductEntity
     */
    public function getProductById(int $id): ?ProductEntity
    {
        $record = Product::find($id);

        if (is_null($record)) {
            return null;
        }

        return new ProductEntity($record);
    }

    /**
     * IDをキーとして論理削除
     *
     * @param int $id
     * @return bool
     */
    public function softDeleteById(int $id): bool
    {
        $record = Product::find($id);

        if (is_null($record)) {
            return false;
        }
        return (bool)$record->delete();
    }
}
