<?php

namespace App\Entities;

use App\Models\Product;

class ProductEntity
{
    /**
     * @var Product
     */
    private $record;

    /**
     * コンストラクタ
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->record = $product;
    }

    /**
     * 商品IDを返す
     *
     * @return int 商品ID
     */
    public function getId(): int
    {
        return $this->record->id;
    }

    /**
     * 商品名を返す
     *
     * @return string 商品名
     */
    public function getName(): string
    {
        return $this->record->name;
    }

    /**
     * 商品名を設定
     *
     * @param string 商品名
     */
    public function setName(string $name)
    {
        $this->record->name = $name;
    }

    /**
     * ジャンルを返す
     *
     * @return string ジャンル
     */
    public function getGenre(): string
    {
        return $this->record->genre;
    }

    /**
     * ジャンルを設定
     *
     * @param string ジャンル
     */
    public function setGenre(string $genre)
    {
        $this->record->genre = $genre;
    }

    /**
     * 値段を返す
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->record->price;
    }

    /**
     * 値段を設定
     *
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->record->price = $price;
    }

    /**
     * 概要を返す
     *
     * @return string ジャンル
     */
    public function getDescription(): ?string
    {
        return $this->record->description;
    }

    /**
     * 概要を設定
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->record->description = $description;
    }

    /**
     * モデルを返す
     *
     * @return Product
     */
    public function getRecord(): Product
    {
        return $this->record;
    }
}
