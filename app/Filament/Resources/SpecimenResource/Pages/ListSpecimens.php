<?php

namespace App\Filament\Resources\SpecimenResource\Pages;

use App\Filament\Resources\SpecimenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecimens extends ListRecords
{
    protected static string $resource = SpecimenResource::class;

    protected ?string $subheading = 'Refers to the substance that is introduced into the microscope, typically after trimming, sectioning and mounting on a substrate.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
