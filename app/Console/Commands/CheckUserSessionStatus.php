<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckUserSessionStatus extends Command
{
    protected $signature = 'user:check-status';
    protected $description = 'Kiểm tra và cập nhật trạng thái người dùng nếu session đã hết hạn';

    public function handle()
    {
        // Lấy danh sách người dùng có status = 2
        $users = DB::table('users')
            ->where('status', 2)
            ->get();

        foreach ($users as $user) {
            // Kiểm tra nếu người dùng đã không hoạt động quá một thời gian nhất định
            if (Carbon::parse($user->updated_at)->diffInMinutes(now()) > config('session.lifetime')) {
                // Cập nhật trạng thái về 1 (không hoạt động)
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['status' => 1]);

                $this->info("Cập nhật trạng thái cho user ID: {$user->id}");
            }
        }

        $this->info('Kiểm tra trạng thái người dùng hoàn thành.');
    }
}
