<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

	protected $fillable = [
		'category_id', 'title',
		'slug', 'author',
		'image', 'status',
		'description',
		'only_admin'
	];

	protected $casts = [
		'only_admin' => 'boolean'
	];


	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id',
		'id');
	}
}
