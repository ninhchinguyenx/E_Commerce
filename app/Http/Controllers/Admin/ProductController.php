<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Prodcut\StoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.product.';
    public function index()
    {
        $categories = Category::query()->pluck('name', 'id');
        $tags = Tag::query()->pluck('name', 'id');
        $colors = ProductColor::query()->pluck('name', 'id');
        $sizes = ProductSize::query()->pluck('name', 'id');
        $products = Product::orderBy('id', 'desc')->paginate(15);
        return view(self::PATH_ROOT . 'index', compact('categories', 'tags', 'colors', 'sizes','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        list(
            $dataProduct,
            $dataProductVariants,
            $dataProductTags,
            $dataDeleteGalleries,
            $dataProductGalleries,
        ) = $this->handleData($request);
        try {
            
            DB::transaction( function () use ($dataProduct, $request, $dataProductVariants, $dataProductGalleries) {
                // Tạo product mới
               
                $product = Product::query()->create($dataProduct); 
                
                foreach($dataProductVariants as $item){
                    if (!is_array($item)) {
                        $item = (array) $item; // Chuyển đổi thành mảng nếu cần
                    }
                    // Thêm 'product_id' vào $item
                    $item['product_id'] = $product->id;
                    ProductVariant::query()->create($item);
                }

                foreach ($dataProductGalleries as $item) {
                    if (!is_array($item)) {
                        $item = (array) $item; // Chuyển đổi thành mảng nếu cần
                    }         
                    // Thêm 'product_id' vào $item
                    $item['product_id'] = $product->id;
                    ProductGallery::query()->create($item);
                }
                $product->tags()->attach($request->tags);
                toastr()->success('Tạo mới sản phẩm thành công.');
                return redirect()->route('products.index');
            });
           
        } catch (\Throwable $th) {
                return back()->with('error', sprintf(
                    $th->getMessage(),
                ));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::findorFail($product->id);
        $product->load(['category','product_gallery','tags']);
        $categories = Category::query()->pluck('name', 'id');
        $tags = Tag::query()->pluck('name', 'id');
        $colors = ProductColor::query()->pluck('name', 'id');
        $sizes = ProductSize::query()->pluck('name', 'id');
        $productTags = $product->tags->pluck('id')->all();
        return view(self::PATH_ROOT . 'edit', compact('categories', 'tags', 'colors', 'sizes','product','productTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {      
        list(
            $dataProduct,
            $dataProductVariants,
            $dataProductTags,
            $dataDeleteGalleries,
            $dataProductGalleries,
        ) = $this->handleData($request);
        try {
            DB::transaction(function () use ($request,$id, $dataProduct, $dataDeleteGalleries,$dataProductTags, $dataProductGalleries, $dataProductVariants){
                $product = Product::findorFail($id);
                
                $product->tags()->sync($dataProductTags);

                if ($request->hasFile('img_thumbnail')) {
                    Storage::delete($product->img_thumbnail);
                    $dataProduct['img_thumbnail'] = Storage::put('admin/product/thumbnail', $request->file('img_thumbnail'));
                }
                $product->update($dataProduct);

                foreach($dataProductGalleries as $item){
                    if (!is_array($item)) {
                        $item = (array) $item; // Chuyển đ��i thành mảng nếu cần
                    }         
                    // Thêm 'product_id' vào $item
                    $item['product_id'] = $product->id;
                    ProductGallery::query()->updateOrCreate(['id' => $item['id']], $item);
                }
                foreach($dataProductVariants as $item){
                    if (!is_array($item)) {
                        $item = (array) $item; // Chuyển đ��i thành mảng nếu cần
                    }         
                    // Thêm 'product_id' vào $item
                    $item['product_id'] = $product->id;
                    ProductVariant::query()->updateOrCreate(
                        [
                            'product_id' => $item['product_id'],
                            'product_size_id' => $item['product_size_id'],
                            'product_color_id' => $item['product_color_id'], 
                        ]
                        , $item);
                }
                if(!empty($dataDeleteGalleries)){
                    foreach ($dataDeleteGalleries ?? [] as $id ) {
                        $gallery = ProductGallery::findOrFail($id);
                        Storage::delete($gallery->img_url);
                        $gallery->delete();
                    }
                }

            });
            toastr()->success('Sửa sản phẩm thành công.');
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
            // toastr()->error('Sửa sản phẩm thất bại vui lòng kiểm tra lại.');
            // return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function handleData(Request $request){

        $dataProduct = $request->except(['product_variants', 'tags', 'gallery']);
        
        $dataProduct['is_active'] ??= 1;
        $dataProduct['is_hot_deal'] ??= 1;
        $dataProduct['is_good_deal'] ??=1;
        $dataProduct['is_new'] ??=1;
        
        if ($request->hasFile('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = Storage::put('admin/product/thumbnail', $request->file('img_thumbnail'));
        }
        $dataProduct['slug'] = Str::slug($dataProduct['name'], '-');
        $dataDeleteGalleries = $request->removed_images;

        $dataProductGalleriesTmp = $request->gallery;
        $dataProductGalleries = [];
        foreach($dataProductGalleriesTmp ?? [] as $image){
                $dataProductGalleries[] = [    
                    'id' =>  isset($image->id) ? $image->id : null,   // tồn tạ khi update
                    'img_url' => Storage::put('admin/product/galleries', $image)
                ];
            
        }
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);

            // current_image xuất hiện khi update
            $image = !empty($item['img_url'])
                ? Storage::put('/admin/product/variants', $item['img_url']) : ($item['current_image'] ?? null);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'img_url' => $image
            ];
        }
        $dataProductTags = $request->tags;
        
        return [$dataProduct, $dataProductVariants, $dataProductTags, $dataDeleteGalleries, $dataProductGalleries];
    }
}
