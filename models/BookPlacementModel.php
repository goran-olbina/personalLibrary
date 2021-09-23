<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class BookPlacementModel extends \App\Core\Model{

        protected function getFields(): array {
            return [
                'book_placement_id' => new Field((new NumberValidator())->setRequired(), false),
                
                'book_id'           => new Field((new NumberValidator())->setRequired(), true),
                'bookshelf_id'      => new Field((new NumberValidator())->setRequired(), true),
                'placed_at'         => new Field((new DateTimeValidator()),              true),
                'is_active'         => new Field((new BitValidator()),                   true)
            ];
        }

        public function getAllByBookId(int $bookId): array{
            return $this->getAllByFieldName('book_id', $bookId);
        }

        public function getAllByBookshelfId(int $bookshelfId): array{
            return $this->getAllByFieldName('bookshelf_id', $bookshelfId);
        }

        public function getActive(){
            $sql = 'SELECT * FROM book_placement WHERE is_active = 1 ORDER BY book_id ASC';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();

            $book_placements = NULL;
            if($res){
                $book_placements = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $book_placements;
        }
        
        public function getActiveByBookshelfId(int $id){
            $sql = 'SELECT * FROM book_placement WHERE is_active = 1 AND bookshelf_id = ?';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $book_placements = NULL;
            if($res){
                $book_placements = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $book_placements;
        }

        public function getLastModifiedById(int $bookId){
            $sql = 'SELECT * FROM book_placement WHERE book_id = ? ORDER BY placed_at DESC LIMIT 1';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $bookId ]);

            $book_placement = NULL;
            if($res){
                $book_placement = $prep->fetch(\PDO::FETCH_OBJ);
            }

            return $book_placement;
        }
    }