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
        Schema::table('editions', function (Blueprint $table) {
            $table->string('theme')->after('id');
            $table->integer('year')->after('theme');
            $table->string('lieu')->after('year');
            $table->date('startDate')->after('lieu');
            $table->date('endDate')->after('startDate');
            $table->foreignId('hackathon_id')->constrained('hackathons')->after('endDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('editions', function (Blueprint $table) {
            $table->dropColumn(['theme', 'year', 'lieu', 'startDate', 'endDate', 'hackathon_id']);
            $table->dropTimestamps();
        });
    }
};
