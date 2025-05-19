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
        Schema::table('car_requests', function (Blueprint $table) {
            $table->string('seats')->after('destination');
            $table->string('car_registration')->after('seats');
            $table->string('driver')->after('car_registration');
        });
    }

    public function down(): void
    {
        Schema::table('car_requests', function (Blueprint $table) {
            $table->dropColumn(['seats', 'car_registration', 'driver']);
        });
    }
};
