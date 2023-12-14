<?php

use App\Enum\Contact\StatusEnum;
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('location')->nullable();
            $table->string('position')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->constrained(); // Assuming you have a users table for storing user information

            $table->string('status')->default(StatusEnum::PENDING->value);

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
        Schema::dropIfExists('contacts');
    }
};
