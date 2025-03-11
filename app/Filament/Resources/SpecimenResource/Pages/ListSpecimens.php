<?php

namespace App\Filament\Resources\SpecimenResource\Pages;

use App\Filament\Resources\SpecimenResource;
use App\Models\Specimen;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;

use Filament\Support\Enums\MaxWidth;

class ListSpecimens extends ListRecords
{
    protected static string $resource = SpecimenResource::class;

    protected ?string $subheading = 'Refers to the substance that is introduced into the microscope, typically after trimming, sectioning and mounting on a substrate.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('exportAllAsJson')
                ->label(__('Export All'))
                ->action(function () {
                    $records = Specimen::all();

                    $archive = new \ZipArchive;

                    $archive->open('specimens.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

                    foreach ($records as $record) {
                        $name = \Str::slug($record->uid, '_') . '.json';
                        $return = $record->load('sample.bioSample.project.investigator')->toArray();

                        // Reverse the hierarchy
                        // Peel the array
                        $invest = $return['sample']['bio_sample']['project']['investigator'];
                        $project = $return['sample']['bio_sample']['project'];
                        $bioSample = $return['sample']['bio_sample'];
                        $sample = $return['sample'];
                        // Remove the links
                        unset($project['investigator']);
                        unset($bioSample['project']);
                        unset($sample['bio_sample']);
                        unset($record['sample']);
                        // Re-link in proper hierarchy
                        $sample['specimen'] = $record;
                        $bioSample['sample'] = $sample;
                        $project['bioSample'] = $bioSample;
                        $invest['project'] = $project;
                        
                        $hierarchy['investigator'] = $invest;
                        $return = $hierarchy;

                        $content = json_encode($return, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
                        $archive->addFromString($name, $content);
                    }

                    $archive->close();

                    return response()->download('specimens.zip');
                })->hidden(fn() => Specimen::count() === 0),

            Actions\CreateAction::make(),
        ];
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
