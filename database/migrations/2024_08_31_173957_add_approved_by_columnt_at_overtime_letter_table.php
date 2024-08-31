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
        Schema::table('overtime_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('approved_by');
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overtime_letters', function (Blueprint $table) {
            Schema::dropIfExists('overtime_letters');
        });
    }
};
