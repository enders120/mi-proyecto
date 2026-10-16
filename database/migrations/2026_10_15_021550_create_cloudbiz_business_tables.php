
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. EMPRESAS MYPES
        Schema::create('mypes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('slug')->unique();
            $table->string('ruc', 11)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Relación entre usuarios y empresas
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('mype_id')
                ->references('id')
                ->on('mypes')
                ->nullOnDelete();
        });

        // 2. CATEGORÍAS
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mype_id')
                ->constrained('mypes')
                ->cascadeOnDelete();

            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color', 20)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // 3. PRODUCTOS
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mype_id')
                ->constrained('mypes')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('name', 180);
            $table->string('sku', 80);
            $table->text('description')->nullable();

            $table->decimal('purchase_price', 12, 2)->default(0);
            $table->decimal('sale_price', 12, 2);
            $table->unsignedInteger('stock')->default(0);

            $table->string('image')->nullable();
            $table->boolean('active')->default(true);

            $table->unique(['mype_id', 'sku']);
            $table->timestamps();
        });

        // 4. CLIENTES
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mype_id')
                ->constrained('mypes')
                ->cascadeOnDelete();

            $table->string('name', 150);
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        // 5. PEDIDOS
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mype_id')
                ->constrained('mypes')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            $table->string('code', 50);
            $table->string('status', 30)->default('pending');

            $table->decimal('total', 12, 2)->default(0);
            $table->string('payment_method', 50)->nullable();
            $table->text('notes')->nullable();

            $table->unique(['mype_id', 'code']);
            $table->timestamps();
        });

        // 6. DETALLE DE PEDIDOS
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->string('product_name', 180);
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['mype_id']);
        });

        Schema::dropIfExists('mypes');
    }
};
