<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->nullable()->default(false)->after('password');
            $table->boolean('is_revisor')->nullable()->default(false)->after('is_admin');
            $table->boolean('is_writer')->nullable()->default(false)->after('is_revisor');
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@aulab.it',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'is_revisor' => true,
            'is_writer' => true,
        ]);
    }

    public function down(): void
    {
        User::where('email', 'admin@aulab.it')->delete();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('is_revisor');
            $table->dropColumn('is_writer');
        });
    }
};

