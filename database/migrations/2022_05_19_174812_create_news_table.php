<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

			$table->foreignId('category_id')
				->constrained('categories')
				->cascadeOnDelete();

            $table->string('title', 255);
			$table->string('slug', 255);
			$table->string('author')->default('Admin');
			$table->string('image', 255)->nullable();
			$table->enum('status', ['DRAFT', 'ACTIVE', 'BLOCKED'])
				->default('DRAFT');
			$table->text('description')->nullable();
            $table->timestamps();

			$table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
