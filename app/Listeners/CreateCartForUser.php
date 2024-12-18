<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCartForUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        // Tạo cart cho user vừa đăng ký
        Cart::create([
            'user_id' => $user->id, // Đảm bảo $user->id có giá trị
        ]);
    }
}
