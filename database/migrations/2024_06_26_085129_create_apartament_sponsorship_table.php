<?php

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
        Schema::create('apartament_sponsorship', function (Blueprint $table) {
            $table->bigInteger('apartment_id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->onDelete('cascade'); 

            $table->bigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')
            ->references('id')
            ->on('sponsorships')
            ->onDelete('cascade'); 

            $table->dateTime('start_date');
            $table->dateTime('expire_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table->dropForeign(['apartment_id']);
            $table->dropForeign(['sponsorship_id']);
        });
    
        Schema::dropIfExists('apartment_sponsorship');
    }
};
