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
        Schema::table('membre_juris', function (Blueprint $table) {
            //
            $table->dropColumn(['score','comment']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membre_juris', function (Blueprint $table) {
            //
            $table->integer('score');
            $table->text('comment');
        });
    }
};
