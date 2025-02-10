<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('incident_details', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('status');
            $table->string('subject');
            $table->json('impact')->nullable();
            $table->text('other_steps_description')->nullable(); 
            $table->json('steps')->nullable();
            $table->dateTime('incident_discovery_time');
            $table->string('incident_resolved');
            $table->string('location');
            $table->integer('sites_affected');
            $table->integer('systems_affected');
            $table->integer('users_affected');
            $table->json('images')->nullable(); 
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('incident_details');
    }
}
