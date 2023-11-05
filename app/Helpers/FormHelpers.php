<?php

namespace App\Helpers;

class FormHelpers
{
    public function generate_years_dropdown()
    {
        $years = [];
        $currentYear = date('Y');
    
        // Defina o intervalo de anos desejado, por exemplo, 10 anos antes do ano atual
        $startYear = $currentYear - 100;
    
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[$year] = $year;
        }
    
        return $years;
    }
}
