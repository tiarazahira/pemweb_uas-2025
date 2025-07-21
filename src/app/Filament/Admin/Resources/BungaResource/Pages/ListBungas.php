<?php

namespace App\Filament\Admin\Resources\BungaResource\Pages;

use App\Filament\Admin\Resources\BungaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBungas extends ListRecords
{
    protected static string $resource = BungaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
