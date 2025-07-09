<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Widgets\LearningChart;
use Filament\Resources\Pages\Page;

class Dashboard extends Page
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.dashboard';

    public static function getWidgets(): array
    {
        return [
            LearningChart::class,
        ];
    }
}
