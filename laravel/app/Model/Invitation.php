<?php

namespace Wagg\Yondel\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'team_id',
        'inviter_id',
        'invitee_email',
        'code',
    ];

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function inviter()
    {
        return $this->hasOne(User::class);
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
