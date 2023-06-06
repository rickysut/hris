<?php

declare(strict_types=1);

namespace MoonShine\Notifications;

use Illuminate\Support\Facades\Notification;
use MoonShine\MoonShineAuth;

final class MoonShineNotification
{
    /**
     * @param  string  $message
     * @param  array{'link': string, 'label': string}  $button
     * @param  array<int>  $ids
     * @return void
     */
    public static function send(string $message, array $button = [], array $ids = []): void
    {
        if (config('moonshine.use_notifications', true)) {
            Notification::sendNow(
                MoonShineAuth::model()->query()
                    ->when($ids, fn ($query) => $query->whereIn('id', $ids))
                    ->get(),
                MoonShineDatabaseNotification::make(
                    $message,
                    $button
                )
            );
        }
    }
}
