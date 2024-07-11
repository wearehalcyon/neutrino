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
        Schema::table('contact_form_databases', function (Blueprint $table) {
            $table->string('user_ip')->nullable()->after('form_data');
            $table->longText('user_agent')->nullable()->after('user_ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_form_databases', function (Blueprint $table) {
            $table->dropColumn('user_ip');
            $table->dropColumn('user_agent');
        });
    }
};
