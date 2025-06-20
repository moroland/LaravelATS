<?php
/**
 * @file UserProfilePage.php
 */

namespace App\Filament\App\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile;

class UserProfilePage extends EditProfile {
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('avatar')
                    ->imageEditor()
                    ->image()
                    ->directory('avatars')
                    ->visibility('private'),
                RichEditor::make('about'),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->maxLength(255),
            ]);
    }

}
