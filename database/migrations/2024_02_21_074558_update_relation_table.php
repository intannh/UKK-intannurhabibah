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
        Schema::table('follow', function(Blueprint $table){
            $table->foreign('id_following')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('user_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
        });

        Schema::table('foto', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('album_id')->references('id')->on('album')->onUpdateCascade()->onDeleteCascade();
        });

        Schema::table('like', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('foto_id')->references('id')->on('foto')->onUpdateCascade()->onDeleteCascade();
        });

        Schema::table('komentar', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('foto_id')->references('id')->on('foto')->onUpdateCascade()->onDeleteCascade();
        });

        Schema::table('album', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
