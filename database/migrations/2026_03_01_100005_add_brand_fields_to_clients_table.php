<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('brand_color', 7)->nullable()->after('notes');
            $table->string('website')->nullable()->after('brand_color');
            $table->text('brand_guidelines')->nullable()->after('website');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['brand_color', 'website', 'brand_guidelines']);
        });
    }
};
