<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowedRelationship extends Model
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
