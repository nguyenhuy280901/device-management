<?php

use App\Enumerations\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('equipment_id');
            $table->text('content')->nullable();
            $table->timestamp('booking_date')->useCurrent();
            $table->timestamp('alocated_date')->nullable();
            $table->timestamp('return_intented_date')->nullable();
            $table->timestamp('return_actual_date')->nullable();
            $table->enum('status', BookingStatus::values());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
