<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = 'Categories';

        $parents = Category::get();
        $categories = $parents->toTree();

        return view('admin.categories.index')->with(compact([
            'categories', 'parents', 'titlePage',
        ]));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titlePage = 'Create Category';

        $parentCategories = Category::all();

        return view('admin.categories.create')->with(compact([
            'titlePage', 'parentCategories',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $thumbnail = $request->file('thumbnail');
        $category = new Category($request->only(['name', 'slug', 'desc']));
        $category->setParentCategory($request->input('parent'));

        if ($thumbnail !== null) {
            $path = ImageController::saveCategoryThumbnail($thumbnail);
            $category->setThumbnailPath($path);
        }

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with(['success' => 'Category successfully created.']);
    }

    /**
     * Display the category.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the category.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $titlePage = 'Edit Category';
        $category = Category::find($id);

        $parentCategories = Category::where('id', '!=', $category->id)->get();

        if (!$category) {
            return redirect()->back()
                ->with(['error' => 'Category has not been found.']);
        }

        return view('admin.categories.edit')->with(compact([
            'titlePage', 'category', 'parentCategories',
        ]));
    }

    /**
     * Update the category in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $thumbnail = $request->file('thumbnail');
        $category = Category::find($id);
        $category->setParentCategory($request->input('parent'));

        if ($thumbnail !== null) {
            $old_path = $category->getThumbnailPath();
            ImageController::removeCategoryThumbnail($old_path);

            $path = ImageController::saveCategoryThumbnail($thumbnail);
            $category->setThumbnailPath($path);
        }

        $category->fill($request->only(['name', 'slug', 'desc']));
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with(['success' => 'Category successfully updated.']);
    }

    /**
     * Remove the category from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $path = $category->getThumbnailPath();

            ImageController::removeCategoryThumbnail($path);

            $category->delete();
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()
                ->with(['error' => 'Category has not been found.']);
        }

        return redirect()->back()
            ->with(['success' => 'Category successfully deleted.']);
    }
}
