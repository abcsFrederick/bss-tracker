<?php

namespace App\Admin\Filament\Resources\UserResource\Pages;

use App\Admin\Filament\Resources\UserResource;
use App\Models\PasswordResetToken;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function () {
                //     // If the user has a passwordresettoeken, also delete that
                    //dd("Inspecting record: ".$this->getRecord());
                    $passwordResetToken = PasswordResetToken::firstWhere('email','=',$this->getRecord()['email']);
                    //dd($passwordResetToken);
                    if($passwordResetToken) {
                        $passwordResetToken->delete();
                    }
                })
                ,
        ];
    }
}
