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
        //
        Schema::table('membre_juris', function (Blueprint $table) {
            $table->string('code')->after('juri_id');
            $table->string('password')->after('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('membre_juris', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('password');
        });
    }
};
