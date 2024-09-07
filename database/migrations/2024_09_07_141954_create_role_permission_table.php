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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete("cascade");

            $table->foreignId('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete("cascade");

            $table->primary(['role_id','permission_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
