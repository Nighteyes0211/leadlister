<?php

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
        Schema::create('facilties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telephone')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('location')->nullable();
            $table->boolean('tele_appointment')->default(0);
            $table->boolean('info_material')->default(0);
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('facility_type_id')->constrained();

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
        Schema::dropIfExists('facilties');
    }
};
