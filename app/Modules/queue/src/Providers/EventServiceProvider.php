<?php

namespace App\Modules\queue\src\Providers;

use App\Modules\queue\src\Jobs\WriteJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(WriteJob::class.'@handle', fn($job) => $job->handle());
    }
}
