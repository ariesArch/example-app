<?php

use App\Enums\ProductType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignId('page_id')->nullable()->constrained();
            $table->foreignId('product_category_id')->nullable()->constrained();
            $table->float('price')->nullable()->default(0);
            $table->float('sale_price')->nullable();
            $table->float('max_price')->nullable();
            $table->float('min_price')->nullable();
            $table->string('sku')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_taxable')->default(false);
            $table->enum('status', ['publish', 'draft'])->default('publish');
            $table->enum(
                'product_type',
                [
                    ProductType::SIMPLE,
                    ProductType::VARIABLE,
                ]
            )->default(ProductType::SIMPLE);
            $table->string('unit');
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable();
            $table->json('image')->nullable();
            $table->json('gallery')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('products');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
