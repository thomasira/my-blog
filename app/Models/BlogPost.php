<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    /* define table in case the table name is non-standard */
        /* protected $table = 'table name'; */

    /* do same for primary key if not id */
        /* protected $primaryKey = 'primary key name'; */

    /* annul default time stamp */
        /* protected $timestamp = false; */

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id'
    ];

    /* joining blog table with user table */
    public function blogHasUser() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function blogHasCategory() {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
