<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\NewWordNotification;
use App\Models\Learn;

class NotifyPeriod extends Command
{

    protected $signature = 'notify:every-five-minutes';

    protected $description = 'send messages every 5 min';

    public function handle(): void
    {
        $learnRandom = Learn::inRandomOrder()->first();
        event(new NewWordNotification($learnRandom));
    }
}
