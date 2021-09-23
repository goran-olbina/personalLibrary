<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class GenreModel extends \App\Core\Model  {

        protected function getFields(): array {
            return [
                'bookshelf_id' => new Field((new NumberValidator())->setRequired(),                     false),
                
                'name'         => new Field((new StringValidator())->setMinLength(1)->setMaxLength(40), true),
                'description'  => new Field((new StringValidator())->setMinLength(1),                   true),
                'is_deleted'   => new Field((new BitValidator()),                                       true)
            ];
        }
 
        public function getAllByGenreId(int $genreId): array{
            return $this->getAllByFieldName('genre_id', $genreId);
        }

        public function getBooksByGenreId(int $id): array{
            $sql = 'SELECT name, book_id FROM book WHERE book_id IN (SELECT book_id FROM book_genre WHERE genre_id = ?)';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $authors = NULL;
            if($res){
                $authors = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $authors;
        }
       
        public function isActive($genre) {
            if (!$genre) {
                return false;
            }

            if ($genre->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }