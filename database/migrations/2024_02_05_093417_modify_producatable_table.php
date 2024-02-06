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
        Schema::table('productables', function (Blueprint $table) {

            $table->dropForeign('productables_created_by_foreign');
            $table->dropForeign('productables_deleted_by_foreign');
            $table->dropForeign('productables_updated_by_foreign');
            
            $table->dropColumn('name');
            $table->dropColumn('scope');
            $table->dropColumn('lesson_type');
            $table->dropColumn('price');
            $table->dropColumn('status');
            $table->dropColumn('is_deleted');
            $table->dropColumn('deleted_at');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productables', function (Blueprint $table) {
            //
        });
    }
};
