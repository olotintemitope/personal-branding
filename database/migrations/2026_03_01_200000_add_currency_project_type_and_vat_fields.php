<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add currency and project_type to projects
        Schema::table('projects', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('budget');
            $table->string('project_type')->nullable()->after('status');
        });

        // Add currency to invoices
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('total');
            $table->string('vat_number')->nullable()->after('notes');
        });

        // Add currency to offers
        Schema::table('offers', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('total');
        });

        // Add VAT number to clients
        Schema::table('clients', function (Blueprint $table) {
            $table->string('vat_number')->nullable()->after('company');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['currency', 'project_type']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['currency', 'vat_number']);
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('currency');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('vat_number');
        });
    }
};
