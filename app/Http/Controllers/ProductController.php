<?php

namespace App\Http\Controllers;

use App\Http\Repository\ProductRepository;
use App\Http\Requests\ProductRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $product)
    {
        $this->repository = $product;
    }

    public function index(Request $request) {
 
        $products = $this->repository->index();

        return response()->json($products, 200); 
    }

    /*public function create(Request $request)
    {
        $token = $request->cookie('token');
    
        $categories = $this->repository->create($token);

        return view('admin.pages.product.create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        
        $token = $request->cookie('token');

        try {

            $data = [
                'image' => $request->image,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'active' => $request->active,
                'category_name' => $request->category_name
            ];


            $this->repository->store($data, $token);

            return redirect()
                    ->back()
                    ->with('message', 'Produto criado')
                    ->withInput();
            
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

    public function show($id) {
        $product = $this->repository->show($id);

        return response()->json($product, 200);
    }

    public function upgrade(Request $request, $id)
    {
        
        $token = $request->cookie('token');
        
        $data = $this->repository->upgrade($token, $id);

        return view('admin.pages.product.upgrade', [
            'product' => $data['product'],
            'categories' => $data['categories']
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'required|max:255',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'active' => 'required',
            'category_name' => 'required'
        ]);
        
        try {

            $data = [
                'image' => $request->image,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'active' => $request->active,
                'category_name' => $request->category_name
            ];

            $this->repository->update($data, $id);

            return redirect()
                    ->back()
                    ->with('message', 'Produto atualizado')
                    ->withInput();
            
           
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

            $this->repository->destroy($id);
            
            return redirect()
                    ->back()
                    ->with('message', 'Produto removido')
                    ->withInput();

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
    } */
}
