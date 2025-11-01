<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Password;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('ID'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->date('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('changePassword')
                    ->label(__('Change password'))
                    ->form([
                        TextInput::make('new_password')
                            ->label(__('New password'))
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => $state)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->rule(Password::default())
                            ->live(debounce: 500)
                            ->same('new_password_confirmation')
                            ->required(),
                        TextInput::make('new_password_confirmation')
                            ->label(__('Confirm new password'))
                            ->password()
                            ->same('new_password')
                            ->rule(Password::default())
                            ->required(),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => $data['new_password']
                        ]);
                        Notification::make()
                            ->title(__('Password updated successfully'))
                            ->success()
                            ->send();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                ]),
            ]);
    }
}
