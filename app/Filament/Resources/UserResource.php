<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'المستخدمين';
    protected static ?string $navigationGroup = 'إدارة المستخدمين';
    protected static ?string $modelLabel = 'مستخدم';
    protected static ?string $pluralModelLabel = 'المستخدمين';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('معلومات أساسية')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                    ])->columns(2),

                Section::make('معلومات الاتصال')
                    ->schema([
                        TextInput::make('phone')
                            ->label('الهاتف')
                            ->tel()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        TextInput::make('whatsapp')
                            ->label('واتساب')
                            ->maxLength(20),
                        Textarea::make('address')
                            ->label('العنوان')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('الإعدادات')
                    ->schema([
                        Select::make('roles')
                            ->label('الدور')
                            ->relationship(
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query
                                    ->where('guard_name', 'web')
                                    ->whereIn('name', ['admin', 'seller', 'buyer']),
                            )
                            ->multiple()
                            ->maxItems(1)
                            ->preload()
                            ->required()
                            ->helperText('يجب اختيار دور واحد فقط لكل بوابة.'),
                        Toggle::make('is_active')
                            ->label('نشط')
                            ->required()
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('الدور')
                    ->badge()
                    ->listWithLineBreaks(),
                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('الدور')
                    ->relationship(
                        'roles',
                        'name',
                        fn (Builder $query) => $query
                            ->where('guard_name', 'web')
                            ->whereIn('name', ['admin', 'seller', 'buyer']),
                    )
                    ->multiple(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
