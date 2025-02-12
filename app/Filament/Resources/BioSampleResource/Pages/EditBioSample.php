<?php

namespace App\Filament\Resources\BioSampleResource\Pages;

use App\Filament\Resources\BioSampleResource;
use App\Models\BioSample;
use App\Models\Sample;
use App\Models\Location;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBioSample extends EditRecord
{
    protected static string $resource = BioSampleResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $storage = Location::query()->where('id', '=', $data['location_id'])->get('location')->toArray()[0]; 
        $data['location_storage'] = $data['location'] . ' ' . $storage['location'];

        return $data;
    }

    public function getBreadcrumbs(): array
    {
        $bioSample = BioSample::withTrashed()->find($this->data['id']);

        return [
            '/investigators/' . $bioSample->project->investigator->id . '/edit' => $bioSample->project->investigator->name,
            '/projects/' . $bioSample->project->id . '/edit' => $bioSample->project->name,
            '/bio-samples' => 'Bio Sample',
            '/bio-samples/' . $bioSample->id . '/edit' => 'Edit'
        ];
    }

    public function getHeading(): string|Htmlable
    {
        return 'Edit Bio Sample ' . $this->data['uid'];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
