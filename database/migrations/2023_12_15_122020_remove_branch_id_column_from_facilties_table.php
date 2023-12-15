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
        Schema::table('facilties', function (Blueprint $table) {
            $table->dropForeign('facilties_branch_id_foreign');
            $table->dropColumn('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilties', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained();
        });
    }
};
