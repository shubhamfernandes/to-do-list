<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory;
    protected $fillable = ['name','is_completed'];

    protected $casts = ['is_completed' => 'boolean'];

     // Scope to fetch tasks ordered by latest
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function toggleComplete(): void
    {
        $this->is_completed = !$this->is_completed;
        $this->save();
    }


}
