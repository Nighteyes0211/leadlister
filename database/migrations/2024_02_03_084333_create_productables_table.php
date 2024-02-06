<?php

use App\Enum\Productable\StatusEnum;
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
        Schema::create('productables', function (Blueprint $table) {
            $table->id();
            $table->morphs('productable');
            $table->string('name');
            $table->string('scope');
            $table->string('lesson_type');
            $table->integer('price')->default(0);
            $table->integer('quantity')->defualt(1);

            $table->string('status')->default(StatusEnum::ACTIVE->value);

            $table->string('is_deleted')->default(false);
            $table->dateTime('deleted_at')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productables');
    }
};
