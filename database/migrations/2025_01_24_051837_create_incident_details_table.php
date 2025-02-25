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
            $table->string('incident_id')->unique(); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('description');
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
            $table->dateTime('ongoing_time')->nullable(); 
            $table->json('incident_reason')->nullable(); 
            $table->text('other_description_ongoing')->nullable(); 
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('incident_details');
    }
}
