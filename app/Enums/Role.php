<?php

namespace App\Enums;

enum Role: string
{
    case Auditor = 'auditor';
    case Auditee = 'auditee';
    case Reviewer = 'reviewer';
}
