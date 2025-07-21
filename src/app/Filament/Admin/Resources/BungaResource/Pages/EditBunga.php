<?php

namespace App\Filament\Admin\Resources\BungaResource\Pages;

use App\Filament\Admin\Resources\BungaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBunga extends EditRecord
{
    protected static string $resource = BungaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
