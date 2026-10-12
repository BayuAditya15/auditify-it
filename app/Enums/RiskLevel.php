<?php

namespace App\Enums;

enum RiskLevel: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    public static function fromScore(int $score): self
    {
        return match (true) {
            $score >= config('audit.risk.high_min', 15) => self::High,
            $score >= config('audit.risk.medium_min', 8) => self::Medium,
            default => self::Low,
        };
    }
}
