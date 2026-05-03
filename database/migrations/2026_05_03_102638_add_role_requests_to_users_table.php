<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'admin_request')) {
                $table->boolean('admin_request')->default(false);
            }

            if (!Schema::hasColumn('users', 'revisor_request')) {
                $table->boolean('revisor_request')->default(false);
            }

            if (!Schema::hasColumn('users', 'writer_request')) {
                $table->boolean('writer_request')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'admin_request')) {
                $table->dropColumn('admin_request');
            }

            if (Schema::hasColumn('users', 'revisor_request')) {
                $table->dropColumn('revisor_request');
            }

            if (Schema::hasColumn('users', 'writer_request')) {
                $table->dropColumn('writer_request');
            }
        });
    }
};

