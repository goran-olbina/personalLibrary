<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class PublisherModel extends \App\Core\Model  {

        protected function getFields(): array {
            return [
                'publisher_id'  => new Field((new NumberValidator())->setRequired(),                     false),

                'name'          => new Field((new StringValidator())->setMinLength(1)->setMaxLength(40), true),  
                'country'       => new Field((new StringValidator())->setMinLength(1)->setMaxLength(74), true),
                'city'          => new Field((new StringValidator())->setMinLength(1)->setMaxLength(74), true),
                'founding_year' => new Field((new NumberValidator())->setIntegerLength(4),               true),
                'is_deleted'    => new Field((new BitValidator()),                                       true)
            ];
        }

        public function isActive($publisher) {
            if (!$publisher) {
                return false;
            }

            if ($publisher->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }