<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardsCategory extends Model
{
    protected $table = 'boards_category';

    protected $primaryKey = 'bc_id';

    protected $fillable = [
        'bc_type'
        ,'bc_name'
    ];
}
