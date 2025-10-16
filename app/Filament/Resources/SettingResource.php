<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon   = 'heroicon-o-cog-8-tooth';
    protected static ?string $navigationLabel  = 'Configuración';
    protected static ?string $modelLabel       = 'Configuración';
    protected static ?string $pluralModelLabel = 'Configuración';
    protected static ?int    $navigationSort   = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información General')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Etiqueta')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nombre visible de esta configuración'),

                        Forms\Components\TextInput::make('key')
                            ->label('Clave')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Identificador único (no modificar si ya existe)')
                            ->disabled(fn ($record) => $record !== null),

                        Forms\Components\Select::make('group')
                            ->label('Grupo')
                            ->required()
                            ->options([
                                'home'    => 'Inicio',
                                'contact' => 'Contacto',
                                'social'  => 'Redes Sociales',
                                'footer'  => 'Footer',
                                'general' => 'General',
                            ])
                            ->default('general'),

                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->required()
                            ->options([
                                'text'     => 'Texto',
                                'textarea' => 'Texto Largo',
                                'email'    => 'Email',
                                'phone'    => 'Teléfono',
                                'url'      => 'URL',
                                'image'    => 'Imagen',
                            ])
                            ->default('text')
                            ->reactive(),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->helperText('Orden de aparición en listados'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Valor')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->maxLength(500)
                            ->helperText('Descripción de qué hace esta configuración')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('value')
                            ->label('Valor')
                            ->required()
                            ->maxLength(65535)
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'email', 'phone', 'url']))
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('value')
                            ->label('Valor')
                            ->required()
                            ->rows(4)
                            ->visible(fn ($get) => $get('type') === 'textarea')
                            ->columnSpanFull(),

                        Forms\Components\Placeholder::make('upload_link')
                            ->label('Subir Imagen o Video')
                            ->content(function ($record) {
                                $url = route('settings.upload.index');
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="space-y-3">' .
                                    '<a href="' . $url . '" target="_blank" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">' .
                                    '📤 Abrir página de subida de archivos' .
                                    '</a>' .
                                    '<p class="text-sm text-gray-600">Los archivos se suben en una página separada para evitar problemas de servidor.</p>' .
                                    ($record && $record->value ? '<p class="text-sm text-green-600">✓ Archivo actual: ' . basename($record->value) . '</p>' : '') .
                                    '</div>'
                                );
                            })
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('value')
                            ->label('Ruta del archivo')
                            ->placeholder('settings/nombre-archivo.jpg')
                            ->helperText('Ruta del archivo en storage/app/public/')
                            ->disabled()
                            ->dehydrated(true)
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Etiqueta')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('key')
                    ->label('Clave')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('group')
                    ->label('Grupo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'home'    => 'primary',
                        'contact' => 'success',
                        'social'  => 'warning',
                        'footer'  => 'info',
                        'general' => 'secondary',
                        default   => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'home'    => 'Inicio',
                        'contact' => 'Contacto',
                        'social'  => 'Redes Sociales',
                        'footer'  => 'Footer',
                        'general' => 'General',
                        default   => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'text'     => 'Texto',
                        'textarea' => 'Texto Largo',
                        'email'    => 'Email',
                        'phone'    => 'Teléfono',
                        'url'      => 'URL',
                        'image'    => 'Imagen',
                        default    => $state,
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('group', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Grupo')
                    ->options([
                        'home'    => 'Inicio',
                        'contact' => 'Contacto',
                        'social'  => 'Redes Sociales',
                        'footer'  => 'Footer',
                        'general' => 'General',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'text'     => 'Texto',
                        'textarea' => 'Texto Largo',
                        'email'    => 'Email',
                        'phone'    => 'Teléfono',
                        'url'      => 'URL',
                        'image'    => 'Imagen',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
