<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->hasOneThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->role->permissions->pluck('name');
    }

    public function hasAccess($access)
    {
        return $this->permissions()->contains($access);
    }

    public function isAdmin(): bool 
    {
        return $this->is_influencer === 0;
    }

    public function isInfluencer(): bool
    {
        return $this->is_influencer === 1;
    }

    public function getRevenueAttribute()
    {
        $orders = Order::where('user_id', $this->id)->where('complete', 1)->get();

        return $orders->sum(function (Order $order){
            return $order->influencer_total;
        });
    }
}

