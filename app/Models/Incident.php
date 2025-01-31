<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incident_details';

    protected $fillable = [
        'description',
        'impact',
        'subject',
        'status',
        'steps',
        'incident_description',
        'incident_discovery_time',
        'incident_resolved',
        'location',
        'sites_affected',
        'systems_affected',
        'users_affected',
        'additional_info',
        'imageUpload',
    ];
    
}

