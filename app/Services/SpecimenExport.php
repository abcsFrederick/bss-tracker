<?php

namespace App\Services;

use Illuminate\Support\Str;

class SpecimenExport
{
    public function handle($record): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $name = Str::slug($record->uid, '_');

        return response()->streamDownload(function () use ($record) {
            $record = $this->transform($record->load([
                'sample.bioSample.project.investigator'
            ]))->toArray();

            // Reverse the hierarchy
            // Peel the array
            $invest = $record['sample']['bio_sample']['project']['investigator'];
            $project = $record['sample']['bio_sample']['project'];
            $bioSample = $record['sample']['bio_sample'];
            $sample = $record['sample'];
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
            $record = $hierarchy;

            echo json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        }, $name . '.json');
    }

    public function transform($record)
    {
        $record = collect($record->toArray());

        return $record;
    }
}
