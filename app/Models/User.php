<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'tribe',
        'number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function create(Request $request)
    {
        $user = new User;

        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->tribe = $request->input('tribe');
        $user->number = $request->input('number');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('email'));

        $user->save();

        return redirect(route('user.login'));
    }

    public function queue() : HasOne
    {
        return $this->hasOne(Queue::class);
    }

    public function tryStartQueue()
    {
        if ($this->queue()->exists())
            return false;

        $this->queue()->create();
        return true;
    }

    public function tryStopQueue()
    {
        if (!$this->queue()->exists())
            return false;

        $this->queue()->delete();
        return true;
    }
}
