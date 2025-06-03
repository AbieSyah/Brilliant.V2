<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingCalendarResource\Pages;
use App\Models\BookingCalendar;
use App\Models\Kamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class BookingCalendarResource extends Resource
{
    protected static ?string $model = BookingCalendar::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Kalender Booking';
    protected static ?string $modelLabel = 'Booking';
    protected static ?string $pluralModelLabel = 'Data Booking';
    protected static ?string $navigationGroup = 'Manajemen Booking';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Booking')
                    ->schema([
                        Forms\Components\Select::make('kamar_id')
                            ->label('Kamar')
                            ->relationship('kamar', 'nama_kamar')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nama_kamar} - {$record->camp->nama_camp}")
                            ->reactive(),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Tamu')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Check-in')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->minDate(today()),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Check-out')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->after('start_date'),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah Tamu')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->maxValue(10)
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kamar.nama_kamar')
                    ->label('Kamar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kamar.camp.nama_camp')
                    ->label('Camp')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Tamu')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Laki-laki' => 'info',
                        'Perempuan' => 'success',
                    }),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Check-in')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Check-out')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->getStateUsing(function (BookingCalendar $record): string {
                        $days = $record->start_date->diffInDays($record->end_date);
                        return $days . ' ' . ($days > 1 ? 'hari' : 'hari');
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (BookingCalendar $record): string {
                        $now = Carbon::now('Asia/Jakarta');
                        $startDate = Carbon::parse($record->start_date)->setTimezone('Asia/Jakarta');
                        $endDate = Carbon::parse($record->end_date)->setTimezone('Asia/Jakarta');

                        if ($now->between($startDate, $endDate)) {
                            return 'Sedang Berlangsung';
                        } else {
                            return 'Selesai';
                        }
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Sedang Berlangsung' => 'success',
                        'Selesai' => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Booking')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') . ' WIB';
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),

                Tables\Filters\SelectFilter::make('kamar_id')
                    ->label('Kamar')
                    ->relationship('kamar', 'nama_kamar')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('active_bookings')
                    ->label('Booking Aktif')
                    ->query(fn($query) => $query->where('start_date', '<=', now('Asia/Jakarta'))
                        ->where('end_date', '>=', now('Asia/Jakarta'))),

                Tables\Filters\Filter::make('date_range')
                    ->label('Rentang Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($query) => $query->whereDate('start_date', '>=', $data['from']))
                            ->when($data['until'], fn($query) => $query->whereDate('end_date', '<=', $data['until']));
                    }),
            ])
            ->recordAction('view')
            ->recordUrl(null)
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Detail')
                    ->modalHeading('Detail Booking')
                    ->modalWidth('4xl'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Booking')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('nama')
                                    ->label('Nama Tamu')
                                    ->icon('heroicon-o-user')
                                    ->color('primary'),

                                Infolists\Components\TextEntry::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'Laki-laki' => 'info',
                                        'Perempuan' => 'success',
                                    }),

                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Jumlah Tamu')
                                    ->icon('heroicon-o-users'),

                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status Booking')
                                    ->badge()
                                    ->getStateUsing(function (BookingCalendar $record): string {
                                        $now = Carbon::now('Asia/Jakarta');
                                        $startDate = Carbon::parse($record->start_date)->setTimezone('Asia/Jakarta');
                                        $endDate = Carbon::parse($record->end_date)->setTimezone('Asia/Jakarta');

                                        if ($now->between($startDate, $endDate)) {
                                            return 'Sedang Berlangsung';
                                        } else {
                                            return 'Selesai';
                                        }
                                    })
                                    ->color(fn(string $state): string => match ($state) {
                                        'Sedang Berlangsung' => 'success',
                                        'Selesai' => 'gray',
                                    }),
                            ]),
                    ]),

                Infolists\Components\Section::make('Informasi Kamar')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('kamar.nama_kamar')
                                    ->label('Nama Kamar')
                                    ->icon('heroicon-o-home'),

                                Infolists\Components\TextEntry::make('kamar.type_kamar')
                                    ->label('Tipe Kamar')
                                    ->badge(),

                                Infolists\Components\TextEntry::make('kamar.camp.nama_camp')
                                    ->label('Camp')
                                    ->icon('heroicon-o-building-office'),

                                Infolists\Components\TextEntry::make('kamar.jumlah_kasur')
                                    ->label('Jumlah Kasur')
                                    ->icon('heroicon-o-square-3-stack-3d'),
                            ]),

                        Infolists\Components\TextEntry::make('kamar.fasilitas')
                            ->label('Fasilitas Kamar')
                            ->columnSpanFull(),
                    ]),

                Infolists\Components\Section::make('Tanggal Booking')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('start_date')
                                    ->label('Tanggal Check-in')
                                    ->formatStateUsing(function ($state) {
                                        Carbon::setLocale('id');
                                        return Carbon::parse($state)->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y');
                                    })
                                    ->icon('heroicon-o-calendar')
                                    ->color('success'),

                                Infolists\Components\TextEntry::make('end_date')
                                    ->label('Tanggal Check-out')
                                    ->formatStateUsing(function ($state) {
                                        Carbon::setLocale('id');
                                        return Carbon::parse($state)->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y');
                                    })
                                    ->icon('heroicon-o-calendar')
                                    ->color('danger'),

                                Infolists\Components\TextEntry::make('duration')
                                    ->label('Durasi Menginap')
                                    ->getStateUsing(function (BookingCalendar $record): string {
                                        $startDate = Carbon::parse($record->start_date)->setTimezone('Asia/Jakarta');
                                        $endDate = Carbon::parse($record->end_date)->setTimezone('Asia/Jakarta');
                                        $days = $startDate->diffInDays($endDate);
                                        return $days . ' hari';
                                    })
                                    ->icon('heroicon-o-clock'),
                            ]),
                    ]),

                Infolists\Components\Section::make('Informasi Tambahan')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Booking Dibuat')
                                    ->formatStateUsing(function ($state) {
                                        Carbon::setLocale('id');
                                        return Carbon::parse($state)->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i') . ' WIB';
                                    })
                                    ->icon('heroicon-o-calendar-days'),

                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->formatStateUsing(function ($state) {
                                        Carbon::setLocale('id');
                                        return Carbon::parse($state)->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i') . ' WIB';
                                    })
                                    ->icon('heroicon-o-pencil'),
                            ]),
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
            'index' => Pages\ListBookingCalendars::route('/'),
            'edit' => Pages\EditBookingCalendar::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('start_date', '<=', now('Asia/Jakarta'))
            ->where('end_date', '>=', now('Asia/Jakarta'))
            ->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['kamar.camp']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama', 'kamar.nama_kamar', 'kamar.camp.nama_camp'];
    }
}
