<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnacceptedMatch extends Model
{
    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'user_1_accepted',
        'user_2_accepted',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }

    public function create(User $user1, User $user2)
    {
        $unacceptedMatch = new UnacceptedMatch();

        if ($user1->id < $user2->id) {
            $unacceptedMatch->user_id_1 = $user1->id;
            $unacceptedMatch->user_id_2 = $user2->id;
        } else {
            $unacceptedMatch->user_id_1 = $user2->id;
            $unacceptedMatch->user_id_2 = $user1->id;
        }

        $unacceptedMatch->save();

        return $unacceptedMatch;
    }
}
