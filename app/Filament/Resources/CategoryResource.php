<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $modelLabel = 'Categoría';
    protected static ?string $pluralModelLabel = 'Categorías';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Categoría')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente desde el nombre'),

                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->required()
                            ->options([
                                'product' => 'Producto',
                                'course' => 'Curso',
                                'post' => 'Blog Post',
                                'gallery' => 'Galería',
                            ])
                            ->searchable()
                            ->helperText('Define dónde se usará esta categoría'),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Diseño')
                    ->schema([
                        Forms\Components\ColorPicker::make('color')
                            ->label('Color')
                            ->helperText('Color para badges y etiquetas (opcional)'),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Orden de aparición (menor = primero)'),

                        Forms\Components\Toggle::make('active')
                            ->label('Activa')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Solo las categorías activas aparecen en los formularios'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'product' => 'success',
                        'course' => 'warning',
                        'post' => 'info',
                        'gallery' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'product' => 'Producto',
                        'course' => 'Curso',
                        'post' => 'Blog Post',
                        'gallery' => 'Galería',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\ColorColumn::make('color')
                    ->label('Color')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activa')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'product' => 'Producto',
                        'course' => 'Curso',
                        'post' => 'Blog Post',
                        'gallery' => 'Galería',
                    ]),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Activa'),
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
            ->defaultSort('order', 'asc');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
