<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Exception;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * 商品一覧画面表示
     */
    public function index()
    {
        $productList = $this->productService->getProductList();
        $data = [
            'productList' => $productList,
        ];

        return view('product.index', $data);
    }

    /**
     * 商品登録画面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * 商品新規登録
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $records = [
            'name'        => $request->input('name', ''),
            'genre'       => $request->input('genre', ''),
            'price'       => $request->input('price', ''),
            'description' => $request->input('description', ''),
        ];

        try {
            $this->productService->storeProduct($records);
            $request->session()->flash('info', '商品を登録しました。');
        } catch (Exception $e) {
            $request->session()->flash('error', '登録に失敗しました。');
        }
        return redirect(route('product::index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * 商品情報編集
     *
     * @param  Request  $request
     * @param  int      $id      商品ID
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $id)
    {
        $entity = $this->productService->getProductById($id);

        if (is_null($entity)) {
            $request->session()->flash('error', '予期せぬエラーが発生しました。');
            redirect(route('product::index'));
        }

        $data = [
            'productEntity' => $entity,
        ];

        return view('product.edit', $data);
    }

    /**
     * 商品情報更新
     *
     * @param  Request  $request
     * @param  int      $id      商品ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $records = [
            'id'          => $id,
            'name'        => $request->input('name', ''),
            'genre'       => $request->input('genre', ''),
            'price'       => $request->input('price', ''),
            'description' => $request->input('description', ''),
        ];

        //更新
        try {
            $this->productService->updateProduct($records);
        } catch (Exception $e) {
            $request->session()->flash('error', '予期せぬエラーが発生しました。');
            redirect(route('product::index'));
        }
        $request->session()->flash('info', '商品を更新しました。');
        return redirect(route('product::index'));
    }

    /**
     * 商品削除
     *
     * @param  Request  $request
     * @param  int      $id      商品ID
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        $result = $this->productService->deleteProduct($id);

        if ($result) {
            $request->session()->flash('info', '商品を削除しました。');
        } else {
            $request->session()->flash('error', '商品の削除に失敗しました。');
        }
        return redirect(route('product::index'));
    }
}
