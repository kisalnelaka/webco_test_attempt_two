<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTypeResource\Pages;
use App\Models\ProductType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ProductTypeResource extends Resource
{
    protected static ?string $model = ProductType::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Types';
    protected static ?string $navigationGroup = 'Developer Test';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_unique_number')
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\CheckboxColumn::make('select'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('api_unique_number'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->color('orange'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('red'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New product type')
                    ->icon('heroicon-o-plus')
                    ->color('orange'),
                Tables\Actions\Action::make('import')
                    ->label('Import Product Types')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('orange')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->acceptedFileTypes(['text/csv', 'text/plain'])
                            ->required()
                            ->label('Upload CSV File'),
                    ])
                    ->action(function (array $data) {
                        try {
                            $file = $data['file'];
                            $path = $file->store('imports', 'public');
                            $csvData = array_map('str_getcsv', file(storage_path('app/public/' . $path)));
                            $header = array_shift($csvData);

                            foreach ($csvData as $row) {
                                ProductType::create([
                                    'name' => $row[0],
                                    'api_unique_number' => isset($row[1]) ? $row[1] : null,
                                ]);
                            }

                            Notification::make()
                                ->title('Product Types Imported')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Import Failed')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        } finally {
                            unlink(storage_path('app/public/' . $path));
                        }
                    })
                    ->modalHeading('Import Product Types')
                    ->modalSubmitActionLabel('Import'),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProductTypes::route('/'),
            'create' => Pages\CreateProductType::route('/create'),
            'edit' => Pages\EditProductType::route('/{record}/edit'),
        ];
    }
}