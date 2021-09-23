<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\BitValidator;

    class BookshelfModel extends \App\Core\Model {

        protected function getFields(): array {
            return [
                'bookshelf_id' => new Field((new NumberValidator())->setRequired(), false),
                
                'room_id'      => new Field((new NumberValidator())->setRequired(), true),
                'is_deleted'   => new Field((new BitValidator()),                   true)
            ];
        }

        public function getAllByRoomId(int $room): array{
            $sql = 'SELECT * FROM bookshelf WHERE room_id = ?';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $room ]);

            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $items;
        }

        public function getBooksByBookshelfId(int $id): array{
            $sql = 'SELECT name, book_id FROM book WHERE book_id IN (SELECT book_id FROM book_placement WHERE bookshelf_id = ? AND is_active = 1)';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $bookshelves = NULL;
            if($res){
                $bookshelves = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            
            return $bookshelves;
        }

        public function isActive($bookshelf) {
            if (!$bookshelf) {
                return false;
            }

            if ($bookshelf->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }