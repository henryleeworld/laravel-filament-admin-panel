<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\Rules\Password;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
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
                ->action(function (array $data) {
                    $this->record->update([
                        'password' => $data['new_password']
                    ]);
                    $this->notify('success', __('Password updated successfully'));
                })
        ];
    }
}
