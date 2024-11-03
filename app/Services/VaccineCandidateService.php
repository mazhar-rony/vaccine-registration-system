<?php

namespace App\Services;

use App\Models\VaccineCandidate;

class VaccineCandidateService
{
    public function store(array $data)
    {
        VaccineCandidate::create($data);
    }
}