<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // use HasFactory;

    // public $timestamps = false;

    protected $table = 'permissions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'role_id',
        'permission',
    ];

    public function role()
    {
        return $this->beLongsTo(Role::class);
    }
}
