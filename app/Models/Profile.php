<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'division',
        'mobile_number',
        'local_number',
        'gender',
        'birthday',
    ];
    protected $casts = [
        'birthday' => 'date',
    ];
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
