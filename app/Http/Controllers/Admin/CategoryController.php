<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Queries\QueryBuilderCategories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function index(QueryBuilderCategories $categories)
    {
        return view('admin.categories.index', [
			'categories' => $categories->getCategories()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request)
    {
        $validated = $request->only(['title', 'description']);
		$category = new Category($validated);

		if($category->save()) {
			return redirect()->route('admin.categories.index')
				->with('success', 'Запись успешно добавлена');
		}

		return back()->with('error', 'Ошибка добавления');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param Category $category
	 * @return \Illuminate\Http\Response
	 */
    public function show(Category $category)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Category $category
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
			'category' => $category
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Category $category
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Category $category)
    {
        $validated = $request->only(['title', 'description']);

		$category = $category->fill($validated);
		if($category->save()) {
			return redirect()->route('admin.categories.index')
				->with('success', 'Запись успешно обновлена');
		}

		return back()->with('error', 'Ошибка обновления');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Category $category
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(Category $category)
    {
        //
    }
}
