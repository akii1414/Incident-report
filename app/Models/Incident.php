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
        'user_name',
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
        'ongoing_time',
        'incident_reason',
        'other_description_ongoing',
    ];
    protected $casts = [
        'images' => 'array',
        'impact' => 'array',
        'steps' => 'array',
        'incident_reason' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($incident) {
            $incident->incident_id = now()->format('Ymd') . '_PENDING_IR_ICT';
        });
        static::created(function ($incident) {
            $incident->incident_id = now()->format('Ymd') . '_' . $incident->id . '_IR_ICT';
            $incident->save();
        });
        
    
}
}