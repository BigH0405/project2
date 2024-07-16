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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'coupon_id')) {
                $table->integer('coupon_id')->unique()->nullable()->unsigned();
                $table->foreign('coupon_id')->references('id')->on('coupons');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'coupon_id')) {
                $table->dropForeign(['coupon_id']);
                $table->dropUnique(['coupon_id']);
                $table->dropColumn('coupon_id');
            }
        });
    }
};
