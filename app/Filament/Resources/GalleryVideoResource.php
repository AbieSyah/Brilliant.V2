<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryVideoResource\Pages;
use App\Models\GalleryVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class GalleryVideoResource extends Resource
{
    protected static ?string $model = GalleryVideo::class;
    protected static ?string $navigationIcon = 'heroicon-o-film';  
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $modelLabel = 'Video Galeri';
    protected static ?string $pluralModelLabel = 'Galeri Video';
    protected static ?string $navigationParent = 'Daftar Galeri';
    protected static ?string $navigationLabel = 'Galeri Video';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\Select::make('type')
                    ->options([
                        'file' => 'Upload File',
                        'url' => 'Video URL',
                    ])
                    ->required()
                    ->live()
                    ->label('Tipe Video'),

                Forms\Components\FileUpload::make('video_path')
                    ->label('File Video')
                    ->acceptedFileTypes(['video/*'])
                    ->directory('gallery/videos')
                    ->downloadable(false)
                    ->openable(false)
                    ->visible(fn(callable $get) => $get('type') === 'file')
                    ->required(fn(callable $get) => $get('type') === 'file'),

                Forms\Components\TextInput::make('video_url')
                    ->label('URL Video')
                    ->url()
                    ->visible(fn(callable $get) => $get('type') === 'url')
                    ->required(fn(callable $get) => $get('type') === 'url'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                Tables\Columns\TextColumn::make('video_path')
                    ->label('Video')
                    ->url(fn ($record) => $record->type === 'file' 
                        ? Storage::url($record->video_path) 
                        : $record->video_url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Upload'),
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
            'index' => Pages\ListGalleryVideos::route('/'),
            'create' => Pages\CreateGalleryVideo::route('/create'),
        ];
    }
}