<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TitleValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (preg_match('/^[A-Za-z0-9]+\s+[A-Za-z0-9]+/', $value) !== 1) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}