<?php

namespace TNM\VXView\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'vx_view_access_tokens';
}
