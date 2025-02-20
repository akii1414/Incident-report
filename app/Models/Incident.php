<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incident_details';

    protected $fillable = [
        'user_id',
        'incident_id',
        'description',
        'impact',
        'subject',
        'other_steps_description',
        'steps',
        'incident_discovery_time',
        'incident_resolved',
        'location',
        'sites_affected',
        'systems_affected',
        'users_affected',
        'additional_info',
        'images',
    ];
    protected $casts = [
        'images' => 'array',
        'impact' => 'array',
        'steps' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($incident) {
            if ($incident->user_id) {
                $incident->incident_id = now()->format('Y/m/d') . '_' . $incident->user_id . '_IR_ICT';
            }
        });
    }
    
}

