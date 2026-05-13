<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Preços armazenados em centavos para precisão.
            $table->unsignedInteger('price_cents');
            $table->unsignedInteger('promotional_price_cents')->nullable();

            // Relacionamentos
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('collection_id')->nullable()->constrained()->nullOnDelete();

            // Atributos de moda
            $table->string('fabric')->nullable();
            $table->text('fabric_details')->nullable();
            $table->json('care')->nullable();
            $table->string('occasion')->nullable(); // Casual, Festa, Trabalho, Especial
            $table->string('tag')->nullable();      // Destaque, Nova Coleção, Mais Vendido, Premium, Promoção

            // Variações simples (sem tabela separada — array json mantém o mock compatível)
            $table->json('sizes')->nullable();
            $table->json('colors')->nullable();

            // Imagens
            $table->string('primary_image')->nullable();
            $table->json('gallery')->nullable();

            // Flags
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('order')->default(0);

            $table->timestamps();

            $table->index(['featured', 'active']);
            $table->index('tag');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
