<?php
namespace App\Services\User\Validators;

use Particle\Validator\Failure;
use Particle\Validator\Validator;

class UserValidator extends Validator
{
    public const AUTH_CONTEXT = 'AUTH_CONTEXT';

    public const REG_CONTEXT = 'REG_CONTEXT';

    public function __construct()
    {
        parent::__construct();
        $this->context(self::AUTH_CONTEXT, function (Validator $c) {
            $c->required('email')->email();
            $c->required('password')->lengthBetween(3, 32);
        });
        $this->context(self::REG_CONTEXT, function (Validator $c) {
            $c->copyContext(self::AUTH_CONTEXT);
            $c->required('name')->lengthBetween(1, 32);
            $c->required('surname')->lengthBetween(1, 32);
            $c->optional('middle_name')->lengthBetween(0, 32);
        });
    }

    public function adapter(array $failures): array
    {
        $errors = [];
        /** @var Failure $failure */
        foreach ($failures as $failure) {
            $errors[$failure->getKey()] = $failure->format();
        }
        return $errors;
    }
}
