<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->string('type')->default('general')->change();
        });
    }

    public function down(): void
    {
        DB::table('categories')
            ->whereIn('type', ['bicycle', 'motorcycle'])
            ->update(['type' => 'general']);

        Schema::table('categories', function (Blueprint $table): void {
            $table->enum('type', ['real_estate', 'car', 'general'])->default('general')->change();
        });
    }
};
