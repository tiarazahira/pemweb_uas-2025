<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BungaResource\Pages;
use App\Filament\Admin\Resources\BungaResource\RelationManagers;
use App\Models\Bunga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BungaResource extends Resource
{
    protected static ?string $model = Bunga::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    
    protected static ?string $navigationGroup = 'Crud';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bunga')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('jenis_bunga')
                ->options([
                    'segar' => 'Segar',
                    'hias' => 'Hias',
                    'kering' => 'Kering',
                    'bouquet' => 'Bouquet',
                ])
                ->required(),
                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('harga_satuan')
                    ->prefix("Rp")
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bunga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bunga'),
                Tables\Columns\TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                  Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBungas::route('/'),
            'create' => Pages\CreateBunga::route('/create'),
            'edit' => Pages\EditBunga::route('/{record}/edit'),
        ];
    }
}
