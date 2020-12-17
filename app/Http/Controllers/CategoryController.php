<?php

namespace App\Http\Controllers;

use App\Http\Repository\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class CategoryController extends Controller
{

    private $repository;

    public function __construct(CategoryRepository $category)
    {
        $this->repository = $category;
    }

    public function index(Request $request) {
        
        $categories = $this->repository->index();

        return response()->json($categories, 200); 
    }


   /* public function store(CategoryRequest $request)
    {
        
        $category = $this->repository;

        try {

            $data = [
                'name' => $request->name,
                'token' => $request->cookie('token'),
                'image' => $request->image,
            ];          

            $category->store($data);

            return redirect()
                    ->back()
                    ->with('message', 'Categoria criada')
                    ->withInput();
            
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
        $category = $this->repository->show($id);

        return view('admin.pages.category.show', [
            'category' => $category
        ]);
    }

    public function upgrade($id)
    {
        $category = $this->repository->upgrade($id);

        return view('admin.pages.category.upgrade', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {

        $category = $this->repository;

        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'required|max:255',
        ]);

        try {

            $data = [
                'name' => $request->name,
                'image' => $request->image
            ];

            $category->update($data, $id);

            return redirect()
                    ->back()
                    ->with('message', 'Categoria atualizada')
                    ->withInput();

           
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

            $this->repository->destroy($id);
            
            return redirect()
                    ->back()
                    ->with('message', 'Categoria removida')
                    ->withInput();
                    
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
    }
    */
}
