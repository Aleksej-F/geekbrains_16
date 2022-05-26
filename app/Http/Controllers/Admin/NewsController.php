<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Queries\QueryBuilderNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function index(QueryBuilderNews $news)
    {
        return view('admin.news.index', [
			'news' => $news->getNews()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function create()
    {
		$categories = Category::all();
        return view('admin.news.create', [
			'categories' => $categories
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request)
    {
		$request->validate([
			'title' => ['required', 'string']
		]);
		$validated = $request->except(['_token', 'image']);
		$validated['slug'] = \Str::slug($validated['title']);

		$news = News::create($validated);
		if($news) {
			return redirect()->route('admin.news.index')
				->with('success', 'Запись успешно добавлена');
		}

		return back()->with('error', 'Ошибка добавления');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param News $news
	 * @return \Illuminate\Http\Response
	 */
    public function show(News $news)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param News $news
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function edit(News $news)
    {
		$categories = Category::all();
		return view('admin.news.edit', [
			'news' => $news,
			'categories' => $categories
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param News $news
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, News $news)
    {
		$validated = $request->except(['_token', 'image']);
		$validated['slug'] = \Str::slug($validated['title']);

		$news = $news->fill($validated);
		if($news->save()) {
			return redirect()->route('admin.news.index')
				->with('success', 'Запись успешно обновлена');
		}

		return back()->with('error', 'Ошибка обновления');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param News $news
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(News $news)
    {
        //
    }
}
