<?php

return [
    'risk' => [
        'high_min' => 15,     // Risk Index >= 15 = Tinggi
        'medium_min' => 8,    // 8-12 = Sedang, di bawahnya Rendah
    ],
    'scope' => [
        'threshold' => 15,    // ambang masuk scope
        'max' => 8,           // batas maksimum objective
        'min' => 3,           // jaminan minimum objective
        'default_target_level' => 3,
    ],
    // Nilai hitung = titik tengah rentang; bounds = batas atas persentase tiap rating.
    'rating_scores' => [
        'N' => 7.5,
        'P' => 32.5,
        'L' => 67.5,
        'F' => 92.5,
    ],
    'rating_bounds' => [
        'N' => 15,
        'P' => 50,
        'L' => 85,
        'F' => 100,
    ],
    'evidence' => [
        'disk' => 'local',
        'max_kb' => 10240,
    ],
];
