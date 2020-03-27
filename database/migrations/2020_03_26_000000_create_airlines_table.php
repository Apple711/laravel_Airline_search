<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('region');
            $table->string('subregion');
            $table->string('country');
            $table->string('operator');
            $table->string('primaryrole');
            $table->string('status');
            $table->string('serialno');
            $table->string('registration');
            $table->string('aircraftFamily');
            $table->string('aircraftType');
            $table->string('aircraftSeries');
            $table->string('aircraftModel');
            $table->string('engineType');
            $table->string('engineModel');
            $table->string('engineThrust');
            $table->string('apuModel');
            $table->string('buildYear');
            $table->string('currentAge');
            $table->string('owner');
            $table->string('ownerManager');
            $table->string('leaseManager');
            $table->string('leaseType');
            $table->string('sublessor');
            $table->string('currentStatusTime');
            $table->string('currentTSN');
            $table->string('currentTSNDate');
            $table->string('locationCountry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airlines');
    }
}
