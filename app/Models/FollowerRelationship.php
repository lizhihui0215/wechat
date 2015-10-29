<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowerRelationship extends Model
{

    public function follower()
    {
        $this->belongsTo('App\Models\User');
    }

    public function followed()
    {
        $this->belongsTo('App\Models\User');
    }
}
