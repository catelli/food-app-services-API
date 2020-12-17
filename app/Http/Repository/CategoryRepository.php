<?php

namespace App\Http\Repository;

use App\Models\Category;
//use App\Models\Seller;
use App\Http\Controllers\ImageController;
//use App\Exceptions\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class CategoryRepository
{

    private $Category;
    private $imageStore;
    private $Seller;

    public function __construct(Category $category/*, ImageController $imageStore, Seller $seller*/)
    {
        $this->Category = $category;
        //$this->imageStore = $imageStore;
        //$this->Seller = $seller;
    }

    public function index() {
        $categories = DB::table('categories')
                                    ->join('sellers', 'sellers.id', '=', 'categories.seller_id')
                                    ->select('sellers.company_name as seller_name', 'categories.name', 'categories.image', 'categories.id')
                                    ->orderBy('categories.created_at', 'desc')
                                    ->paginate(15);

        return $categories;
    }

    /*public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store($data)
    {
        
        $category = $this->Category;

        try {

            $category->name = $data['name'];

            $token = $data['token'];
            $seller = $this->Seller->where('api_token', $token)->first();
            $category->seller_id = $seller->id;   
            
            $folder = '/category';
            $imageName = $this->imageStore->store($data, $folder);

            $category->image = $imageName;         

            $category->save();
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not created')
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

    public function show($id) {
        $category = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->where('categories.id', '=', $id)
            ->select('categories.name as category_name', 'products.*')
            ->get();

        return $category;
    }

    public function upgrade($id)
    {
        $categoryExist = $this->Category->find($id);

        if(!$categoryExist) {
            return redirect()
                    ->back()
                    ->with('message', 'Categoria não encontrada')
                    ->withInput();
        }

        return $categoryExist;
    }

    public function update($data, $id)
    {

        $categoryExist = $this->Category->find($id);

        if(!$categoryExist) {
            return redirect()
                    ->back()
                    ->with('message', 'Categoria não encontrada')
                    ->withInput();
        }
        
        $data['image'] = $data['image'] ? $data['image'] : $categoryExist->image;

        try {

            $categoryExist->name = $data['name'];

            $folder = '/category';
            $imageName = $this->imageStore->store($data, $folder);
            $categoryExist->image = $imageName;      

            $categoryExist->save();
           
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not created')
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

            $category = $this->Category->find($id);

            $category->delete();
                    
        }
        catch(Throwable $e) {
            return redirect()
                            ->back()
                            ->with('message', 'Category not removed')
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
    }*/
    
}
