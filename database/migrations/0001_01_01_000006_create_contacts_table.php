<?php

declare(strict_types=1);

use App\Enums\ContactTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('companyname')->nullable();
            $table->string('street');
            $table->string('housenumber');
            $table->string('address2')->nullable();
            $table->string('postalcode');
            $table->string('locality');
            $table->string('email');
            $table->string('phone');
            $table->string('country', 2);
            $table->enum('type', ContactTypeEnum::values())->default(ContactTypeEnum::RECEIVER);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
