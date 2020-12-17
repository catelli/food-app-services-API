<?php

namespace App\Http\Repository;

use App\Models\Product;
use App\Models\Category;
//use App\Models\Seller;
//se App\Http\Controllers\ImageController;
use App\Exceptions\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class ProductRepository
{
    private $Product;
    private $imageStore;
    private $Category;
    private $Seller;

    public function __construct(Product $product, /*ImageController $imageStore,*/ Category $category /*,Seller $seller*/)
    {
        $this->Product = $product;
        //$this->imageStore = $imageStore;
        $this->Category = $category;
        //$this->Seller = $seller;
    }

    public function index() {
        $products = DB::table('products')
                                ->join('categories', 'categories.id', '=', 'products.category_id')
                                ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                                ->select('categories.name as category_name', 'products.name', 'products.id', 'products.description', 'products.image', 'products.price', 'products.stock', 'products.active')
                                ->orderBy('products.created_at', 'desc')
                                ->paginate(15);

        return $products;
    }

    /*public function create($token)
    {
        
        $categories = DB::table('categories')
                                    ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                                    ->select('categories.name', 'categories.id')
                                    ->where('sellers.api_token', $token)
                                    ->get();

        return $categories;
    }

    public function store($data, $token)
    {
        
        $product = $this->Product;

        try {

            $product->name = $data['name'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->active = $data['active'];
            $product->category_id = $data['category_name'];
            
            $folder = '/product';
            $imageName = $this->imageStore->store($data, $folder);
            $product->image = $imageName;

            $product->save();
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'product not created')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    } */

    public function show($id) {
        $product = $this->Product->find($id);

        return $product;
    }
    /*
    public function upgrade($token, $id)
    {
        
        $categories = DB::table('categories')
                                    ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                                    ->select('categories.name', 'categories.id')
                                    ->where('sellers.api_token', $token)
                                    ->get();
        
        $productExist = $this->Product->find($id);

        if(!$productExist) {
            return redirect()
                    ->back()
                    ->with('message', 'Produto não encontrado')
                    ->withInput();
        }

        return $data = [
            'product' => $productExist,
            'categories' => $categories
        ];
    }

    public function update($data, $id)
    {

        $product = $this->Product->find($id);

        if(!$product) {
            return redirect()
                    ->back()
                    ->with('message', 'Produto não encontrado')
                    ->withInput();
        }
        
        $data['image'] = $data['image'] ? $data['image'] : $product->image;

        try {

            $product->name = $data['name'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->active = $data['active'];
            $product->category_id = intval($data['category_name']);
            
            $folder = '/product';
            $imageName = $this->imageStore->store($data, $folder);

            $product->image = $imageName;

            $product->save();
           
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'product not created')
                            ->withInput();
        }
        catch (QueryException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Query error')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    }

    public function destroy($id) {
        try {

            $product = $this->Product->find($id);
            

            $product->delete();

        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'product not removed')
                            ->withInput();
        }
        catch (FatalErrorException $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Fatal error')
                            ->withInput();
        }
    }*/
}
