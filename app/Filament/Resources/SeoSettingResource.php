<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSettingResource\Pages;
use App\Models\SeoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'SEO';
    protected static ?string $modelLabel = 'Configuración SEO';
    protected static ?string $pluralModelLabel = 'Configuración SEO';
    protected static ?int    $navigationSort = 5;

    /** Páginas permitidas para SEO (coinciden con tus rutas) */
    public static function allowedPages(): array
    {
        return [
            'home'      => 'Inicio',
            'productos' => 'Productos',
            'cursos'    => 'Cursos',
            'galeria'   => 'Galería',
            'blog'      => 'Blog',
            'contacto'  => 'Contacto',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Página y Metas')
                    ->schema([
                        Forms\Components\Select::make('page')
                            ->label('Página')
                            ->options(self::allowedPages())
                            ->required()
                            ->searchable()
                            ->helperText('Selecciona una de las páginas del sitio.')
                            ->unique(ignoreRecord: true), // un SEO por página
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Título')
                            ->required()
                            ->maxLength(60),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descripción')
                            ->required()
                            ->maxLength(160)
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Palabras clave')
                            ->helperText('Separadas por comas'),
                    ])->columns(2),

                Forms\Components\Section::make('Open Graph / Social')
                    ->schema([
                        Forms\Components\TextInput::make('og_title')
                            ->label('OG Título')
                            ->maxLength(70),
                        Forms\Components\TextInput::make('og_type')
                            ->label('OG Type')
                            ->default('website')
                            ->maxLength(40),
                        Forms\Components\Textarea::make('og_description')
                            ->label('OG Descripción')
                            ->rows(3)
                            ->maxLength(200)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('og_image')
                            ->label('OG Imagen')
                            ->image()
                            ->disk('public')                 // guarda en storage/app/public
                            ->directory('seo/og')            // p. ej. seo/og/imagen.jpg
                            ->visibility('public')           // URL pública /storage/seo/og/...
                            ->preserveFilenames()
                            ->helperText('Recomendado 1200×630px. Se guardará como ruta relativa.'),
                    ])->columns(2),

                Forms\Components\Section::make('Avanzado')
                    ->schema([
                        Forms\Components\Textarea::make('schema_markup')
                            ->label('Schema Markup (JSON-LD)')
                            ->rows(6)
                            ->columnSpanFull(),
                    ])->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->label('Página')
                    ->formatStateUsing(fn ($state) => self::allowedPages()[$state] ?? $state)
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Meta Título')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('og_title')
                    ->label('OG Título')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('og_image')
                    ->label('OG Imagen')
                    ->disk('public')
                    ->height(40)
                    ->circular(),
                Tables\Columns\TextColumn::make('og_type')
                    ->label('OG Type')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('page')
                    ->label('Página')
                    ->options(self::allowedPages()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('page', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSeoSettings::route('/'),
            'create' => Pages\CreateSeoSetting::route('/create'),
            'edit'   => Pages\EditSeoSetting::route('/{record}/edit'),
        ];
    }
}
