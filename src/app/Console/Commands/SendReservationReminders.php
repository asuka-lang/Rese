<?php

namespace App\Console\Commands;

use App\Mail\ReservationReminderMail;
use App\Models\Reserve;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminders for tomorrow\'s reservations.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 翌日の予約を取得（まだリマインダーが送信されていないもの）
        $tomorrow = Carbon::tomorrow()->toDateString();

        $reservations = Reserve::whereDate('date', $tomorrow)
            ->whereNull('reminded_at')
            ->with('user') // ユーザー情報をEager Load
            ->get();

        if ($reservations->isEmpty()) {
            $this->info('翌日のリマインダー対象の予約はありませんでした。');
            return Command::SUCCESS;
        }

        foreach ($reservations as $reservation) {
            if ($reservation->user && filter_var($reservation->user->email, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
                    $reservation->update(['reminded_at' => Carbon::now()]);
                    $this->info("予約ID: {$reservation->id} のリマインダーを {$reservation->user->email} に送信しました。");
                } catch (\Exception $e) {
                    $this->error("予約ID: {$reservation->id} のリマインダー送信中にエラーが発生しました: " . $e->getMessage());
                }
            } else {
                $this->warn("予約ID: {$reservation->id} に関連付けられたユーザーが見つからないか、メールアドレスが無効です。");
            }

            $this->info('リマインダー送信処理が完了しました。');
            return Command::SUCCESS;
        }
    }
}
