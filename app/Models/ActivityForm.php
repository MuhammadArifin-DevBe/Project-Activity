<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityForm extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function creator()
    {
    return $this->belongsTo(User::class, 'user_id');
    }}
