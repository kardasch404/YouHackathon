<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('description')->after('title');
            $table->string('lien')->after('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'lien']);
            $table->dropTimestamps();
        });
    }
};
