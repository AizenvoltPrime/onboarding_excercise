<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'completed'];
    protected $guarded = ['created_at', 'updated_at'];
    protected $casts = [
        'priority' => TaskPriority::class,
        'status' => TaskStatus::class,
    ];
}
