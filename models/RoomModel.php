<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class RoomModel extends \App\Core\Model  {

        protected function getFields(): array {
            return [
                'room_id'    => new Field((new NumberValidator())->setRequired(), false),
                
                'location'   => new Field((new StringValidator()),                true),
                'is_deleted' => new Field((new BitValidator()),                   true)
            ];
        }
        
        public function isActive($room) {
            if (!$room) {
                return false;
            }

            if ($room->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }