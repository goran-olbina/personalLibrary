<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class AdminModel extends \App\Core\Model{
        protected function getFields(): array {
            return [
                'admin_id'      => new Field((new NumberValidator())->setRequired(),                      false),
                
                'username'      => new Field((new StringValidator())->setMinLength(1)->setMaxLength(20),  true),
                'password_hash' => new Field((new StringValidator())->setMinLength(1)->setMaxLength(128), true),
            ];
        }
    }