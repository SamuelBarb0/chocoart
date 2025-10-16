<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Cursos';
    protected static ?string $modelLabel = 'Curso';
    protected static ?string $pluralModelLabel = 'Cursos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Curso')
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
                            ->helperText('Se genera automáticamente'),
                        Forms\Components\Select::make('level')
                            ->label('Nivel')
                            ->required()
                            ->options([
                                'Principiante' => 'Principiante',
                                'Intermedio' => 'Intermedio',
                                'Avanzado' => 'Avanzado',
                                'Todos los niveles' => 'Todos los niveles',
                            ]),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->maxLength(500)
                            ->rows(2)
                            ->helperText('Breve descripción que aparece en la tarjeta')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Diseño Visual')
                    ->schema([
                        Forms\Components\Placeholder::make('upload_images')
                            ->label('Gestionar Imágenes')
                            ->content(function ($record) {
                                $url = route('admin.uploads.index', ['resource' => 'courses']);
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="space-y-3">' .
                                    '<a href="' . $url . '" target="_blank" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">' .
                                    '📤 Abrir gestor de imágenes' .
                                    '</a>' .
                                    '<p class="text-sm text-gray-600">Sube imágenes en una página separada para evitar problemas de servidor.</p>' .
                                    ($record && $record->icon ? '<p class="text-sm text-green-600">✓ Icono: ' . basename($record->icon) . '</p>' : '') .
                                    ($record && $record->image ? '<p class="text-sm text-green-600">✓ Imagen principal: ' . basename($record->image) . '</p>' : '') .
                                    ($record && !empty($record->images) ? '<p class="text-sm text-green-600">✓ Galería: ' . count($record->images) . ' imagen(es)</p>' : '') .
                                    '</div>'
                                );
                            }),
                        Forms\Components\TextInput::make('color')
                            ->label('Gradiente')
                            ->required()
                            ->default('from-[#c6d379] to-[#81cacf]')
                            ->helperText('Ej: from-[#c6d379] to-[#81cacf]'),
                        Forms\Components\Select::make('badge')
                            ->label('Badge')
                            ->options([
                                'POPULAR' => 'Popular',
                                'AVANZADO' => 'Avanzado',
                                'NUEVO' => 'Nuevo',
                                'PERSONALIZADO' => 'Personalizado',
                            ])
                            ->helperText('Badge que aparece en la esquina'),
                    ])->columns(3),

                Forms\Components\Section::make('Detalles del Curso')
                    ->schema([
                        Forms\Components\TextInput::make('duration_hours')
                            ->label('Duración (horas)')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->suffix('hrs'),
                        Forms\Components\TextInput::make('max_students')
                            ->label('Capacidad Máxima')
                            ->numeric()
                            ->helperText('Ej: 8 personas, o dejar vacío para "Flexible"'),
                        Forms\Components\TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Fecha de Inicio')
                            ->helperText('Opcional'),
                    ])->columns(4),

                Forms\Components\Section::make('Estado')
                    ->schema([
                        Forms\Components\Toggle::make('published')
                            ->label('Publicado')
                            ->default(true)
                            ->inline(false),
                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->helperText('Orden de visualización (menor = primero)'),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->description('Optimización para motores de búsqueda')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Título')
                            ->maxLength(60),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descripción')
                            ->maxLength(160)
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Palabras Clave'),
                    ])->columns(2)->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Vista previa del icono (opcional, pero útil)
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icono')
                    ->disk('public')
                    ->circular()
                    ->height(40),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('level')
                    ->label('Nivel')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Principiante' => 'success',
                        'Intermedio' => 'warning',
                        'Avanzado' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration_hours')
                    ->label('Duración')
                    ->suffix(' hrs')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_students')
                    ->label('Capacidad')
                    ->default('Flexible')
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Publicado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->label('Nivel')
                    ->options([
                        'Principiante' => 'Principiante',
                        'Intermedio' => 'Intermedio',
                        'Avanzado' => 'Avanzado',
                        'Todos los niveles' => 'Todos los niveles',
                    ]),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Publicado'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
