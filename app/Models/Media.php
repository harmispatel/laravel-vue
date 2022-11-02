<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];
    const FILE_PATH = '/img';

    /**
     * Bind Relationship with Image Uploaders
     */
    public function uploaders()
    {
        return $this->hasOne(Uploader::class, 'id', 'uploader_id');
    }
}
