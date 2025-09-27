<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WalkMatch extends Model
{
    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'completed'
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
        $walkMatch = new WalkMatch();

        if ($user1->id < $user2->id) {
            $walkMatch->user_id_1 = $user1->id;
            $walkMatch->user_id_2 = $user2->id;
        } else {
            $walkMatch->user_id_1 = $user2->id;
            $walkMatch->user_id_2 = $user1->id;
        }

        $walkMatch->save();

        return $walkMatch;
    }
}
