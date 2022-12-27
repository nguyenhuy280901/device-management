<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * 
     * @var CategoryService
     */
    private $categoryService;

    /**
     * 
     * CategoryController constructor
     * 
     * @return void
     */
    public function __construct(
        CategoryService $categoryService
    )
    {
        // Authorize
        $this->middleware('can:view-category')->only('index', 'show');
        $this->middleware('can:create-category')->only('create', 'store');
        $this->middleware('can:update-category')->only('edit', 'update');
        $this->middleware('can:delete-category')->only('destroy');

        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getAll();
        
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $this->categoryService->create($validated);

            return to_route('category.index')->with([
                'message' => 'Create new category successfully'
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $category = $this->categoryService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('category.index')->withErrors(['message' => 'Not found category!']);
        }
       

        return view('categories.detail', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $category = $this->categoryService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('category.index')->withErrors(['message' => 'Not found category!']);
        }

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try
        {
            $this->categoryService->update($id, $request->validated());

            return to_route('category.index')->with([
                'message' => "Update category '$request->name' successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch(ModelNotFoundException)
        {
            return to_route('category.index')->withErrors(['message' => 'Not found category!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $this->categoryService->delete($id);
        }
        catch(Exception)
        {
            return to_route('category.index')->withErrors(['message' => 'Can not delete category!']);
        }
        return to_route('category.index')->with([
            'message' => "Delete category successfully"
        ]);
    }
}
