<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        $articles = DB::table('articles')->get();

        foreach ($articles as $article) {
            $baseSlug = Str::slug($article->title);
            $slug = $baseSlug;
            $counter = 1;

            while (DB::table('articles')->where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            DB::table('articles')
                ->where('id', $article->id)
                ->update([
                    'slug' => $slug,
                ]);
        }

        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

