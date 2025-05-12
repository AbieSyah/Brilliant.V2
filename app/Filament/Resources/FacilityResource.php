<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $modelLabel = 'Fasilitas';
    protected static ?string $pluralModelLabel = 'Daftar Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Fasilitas')
                    ->image()
                    ->disk('public')
                    ->directory('facilities')
                    ->imagePreviewHeight('250')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1')
                    ->panelLayout('integrated')
                    ->imagePreviewHeight('250')
                    ->openable(true)
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadProgressIndicatorPosition('left'),

                Forms\Components\TextInput::make('nama_kamar')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Kamar'),

                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(65535)
                    ->label('Deskripsi'),

                Forms\Components\Select::make('tipe_kamar')
                    ->options([
                        'regular' => 'Regular',
                        'regular+' => 'Regular+',
                        'vip' => 'VIP',
                        'vvip' => 'VVIP',
                        'homestay' => 'Homestay',
                        'homestay+' => 'Homestay+',
                        'barak' => 'Barak'
                    ])
                    ->required()
                    ->label('Tipe Kamar'),

                Forms\Components\Select::make('kategori')
                    ->options([
                        'brilliant' => 'Brilliant',
                        'bieplus' => 'Bieplus'
                    ])
                    ->required()
                    ->label('Kategori'),

                Forms\Components\Select::make('gender')
                    ->options([
                        'pria' => 'Pria',
                        'wanita' => 'Wanita'
                    ])
                    ->required()
                    ->label('Gender'),

                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->maxValue(999999999)
                    ->label('Harga'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(100),

                Tables\Columns\TextColumn::make('nama_kamar')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kamar'),
                Tables\Columns\TextColumn::make('tipe_kamar')
                    ->sortable()
                    ->label('Tipe Kamar'),
                Tables\Columns\TextColumn::make('kategori')
                    ->sortable()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('gender')
                    ->sortable()
                    ->label('Gender'),
                Tables\Columns\TextColumn::make('harga')
                    ->money('idr')
                    ->sortable()
                    ->label('Harga'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
