<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
                    
class Attachment extends Model
{
    protected $fillable = [
        'name',
        'attachable_id',        
        'attachable_type',
        'file_path'
    ];

    public function attachable() {
        return $this->morphTo();
    }
}
