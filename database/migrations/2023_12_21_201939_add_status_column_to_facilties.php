<?php

use App\Enum\Facility\StatusEnum;
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
        Schema::table('facilties', function (Blueprint $table) {
            $table->string('status')->default(StatusEnum::ACTIVE->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilties', function (Blueprint $table) {
            //
        });
    }
};
