<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('manuals', function (Blueprint $table) {
            // Dit voegt de kolom 'views' toe met beginwaarde 0
            $table->integer('views')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('manuals', function (Blueprint $table) {
            // Dit verwijdert de kolom als je de migratie terugdraait
            $table->dropColumn('views');
        });
    }
};
