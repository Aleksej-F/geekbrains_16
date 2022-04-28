<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
	{
		$news = $this->getNews();
		return view('news.index', [
			'newsList' => $news
		]);
	}

	public function show(int $id)
	{
		if($id > 11) {
			abort(404);
		}
		$news = $this->getNews($id);
		return view('news.show', [
			'news' => $news
		]);
	}
}
