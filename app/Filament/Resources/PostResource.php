<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Blog';

    protected static ?string $modelLabel = 'Post';

    protected static ?string $pluralModelLabel = 'Posts';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contenido Principal')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente desde el título'),
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name', fn($query) => $query->where('type', 'post')->where('active', true)->orderBy('order'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Hidden::make('type')
                                    ->default('post'),
                                Forms\Components\Hidden::make('active')
                                    ->default(true),
                            ])
                            ->helperText('Categoría del post. Puedes crear una nueva si no existe.'),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Extracto')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Resumen breve del post (máx. 500 caracteres)')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenido')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Imágenes')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen Principal')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->imageEditor()
                            ->maxSize(51200)
                            ->helperText('Tamaño máximo: 50MB')
                            ->downloadable()
                            ->openable()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                        Forms\Components\FileUpload::make('images')
                            ->label('Galería de Imágenes')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->multiple()
                            ->reorderable()
                            ->maxFiles(10)
                            ->maxSize(51200)
                            ->helperText('Puedes subir hasta 10 imágenes. Arrastra para reordenar.')
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Diseño')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Emoji/Icono')
                            ->required()
                            ->default('🍫')
                            ->maxLength(10)
                            ->helperText('Emoji que se muestra en la tarjeta'),
                        Forms\Components\TextInput::make('gradient')
                            ->label('Gradiente')
                            ->required()
                            ->default('from-[#e28dc4] to-[#81cacf]')
                            ->helperText('Clases Tailwind para el gradiente (ej: from-[#e28dc4] to-[#81cacf])'),
                        Forms\Components\TextInput::make('read_time')
                            ->label('Tiempo de Lectura (min)')
                            ->required()
                            ->numeric()
                            ->default(5)
                            ->minValue(1)
                            ->maxValue(60),
                    ])->columns(3),

                Forms\Components\Section::make('Publicación')
                    ->schema([
                        Forms\Components\Toggle::make('published')
                            ->label('Publicado')
                            ->default(false)
                            ->inline(false),
                        Forms\Components\DatePicker::make('published_at')
                            ->label('Fecha de Publicación')
                            ->default(now()),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Título')
                            ->maxLength(60)
                            ->helperText('Recomendado: 50-60 caracteres. Se usa el título del post si está vacío.'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descripción')
                            ->maxLength(160)
                            ->rows(2)
                            ->helperText('Recomendado: 150-160 caracteres')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Palabras Clave')
                            ->helperText('Separadas por comas (ej: chocolate, templado, técnicas)'),
                    ])->columns(2)->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->badge()
                    ->default('-')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Publicado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('read_time')
                    ->label('Lectura')
                    ->suffix(' min')
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
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name', fn($query) => $query->where('type', 'post')->where('active', true))
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Publicado')
                    ->placeholder('Todos')
                    ->trueLabel('Publicados')
                    ->falseLabel('No publicados'),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
