<?php
// src/Validator/Constraints/TitleConstraint.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TitleConstraint extends Constraint
{
    public $message = 'Title must contain only letters and numbers and have at least 2 words.';
}
