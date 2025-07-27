<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'activity_form_id',
        'description',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function activityForm()
    {
        return $this->belongsTo(ActivityForm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
