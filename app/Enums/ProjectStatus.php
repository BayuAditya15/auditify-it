<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';            // Fase 1
    case Assessment = 'assessment';  // Fase 2 (scope terkunci)
    case Analysis = 'analysis';      // Fase 3 (assessment terkunci)
    case Archived = 'archived';      // read-only
}
