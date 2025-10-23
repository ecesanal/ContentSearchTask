<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            //
        });
    }

    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            //
        });
    }

    public function up()
{
    Schema::table('contents', function (Blueprint $table) {
        $table->string('language', 5)->default('tr');
    });
}

};
