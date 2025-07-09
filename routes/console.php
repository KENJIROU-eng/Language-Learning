<?php

use Illuminate\Console\Scheduling\Schedule;

return function (Schedule $schedule) {
    dd('console.php loaded');
    $schedule->command('notify:every-five-minutes')->everyMinute();
};

