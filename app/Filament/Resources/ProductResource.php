<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Productos';

    protected static ?string $modelLabel = 'Producto';

    protected static ?string $pluralModelLabel = 'Productos';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Producto')
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
                        Forms\Components\Select::make('category')
                            ->label('Categoría')
                            ->required()
                            ->options([
                                'Bombones' => 'Bombones',
                                'Barras' => 'Barras',
                                'Trufas' => 'Trufas',
                                'Tabletas' => 'Tabletas',
                                'Gift Box' => 'Gift Box',
                                'Temporada' => 'Temporada',
                            ])
                            ->searchable(),
                        Forms\Components\TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step(0.01),
                        Forms\Components\RichEditor::make('description')
                            ->label('Descripción')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Imágenes')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen Principal')
                            ->image()
                            ->disk('public_uploads')     // ← AQUÍ
                            ->directory('products')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(4096)
                            ->helperText('Imagen principal del producto'),

                        Forms\Components\FileUpload::make('images')
                            ->label('Galería de Imágenes')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public_uploads')     // ← AQUÍ
                            ->directory('products/gallery')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxFiles(10)
                            ->helperText('Imágenes adicionales del producto')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Diseño')
                    ->schema([
                        Forms\Components\FileUpload::make('icon')
                            ->label('Icono/Imagen')
                            ->image()
                            ->disk('public_uploads')     // ← AQUÍ
                            ->directory('products/icons')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->helperText('Sube una imagen o deja vacío para usar emoji 🍫'),
                        Forms\Components\TextInput::make('gradient')
                            ->label('Gradiente')
                            ->required()
                            ->default('from-[#e28dc4] to-[#81cacf]')
                            ->helperText('Clases Tailwind para el gradiente'),
                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Orden de visualización (menor = primero)'),
                    ])->columns(3),

                Forms\Components\Section::make('Estado')
                    ->schema([
                        Forms\Components\Toggle::make('published')
                            ->label('Publicado')
                            ->default(true)
                            ->inline(false),
                        Forms\Components\Toggle::make('featured')
                            ->label('Destacado')
                            ->default(false)
                            ->inline(false)
                            ->helperText('Aparece en la sección de productos destacados'),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->description('Optimización para motores de búsqueda')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Título')
                            ->maxLength(60)
                            ->helperText('Se usa el nombre del producto si está vacío'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descripción')
                            ->maxLength(160)
                            ->rows(2)
                            ->helperText('Recomendado: 150-160 caracteres')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Palabras Clave')
                            ->helperText('Separadas por comas'),
                    ])->columns(2)->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public_uploads')   // ← AQUÍ
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Publicado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('featured')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icono')
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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'Bombones' => 'Bombones',
                        'Barras' => 'Barras',
                        'Trufas' => 'Trufas',
                        'Tabletas' => 'Tabletas',
                        'Gift Box' => 'Gift Box',
                        'Temporada' => 'Temporada',
                    ]),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Publicado'),
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Destacado'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
