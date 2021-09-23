<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;

    class BookGenreModel extends \App\Core\Model {

        protected function getFields(): array {
            return [
                'book_genre_id'  => new Field((new NumberValidator())->setRequired(), false),
                
                'book_id'        => new Field((new NumberValidator())->setRequired(), true),
                'genre_id'       => new Field((new NumberValidator())->setRequired(), true)
            ];
        }

        public function getAllByBookId(int $bookId): array{
            return $this->getAllByFieldName('book_id', $bookId);
        }

        public function getAllByGenreId(int $genreId): array{
            return $this->getAllByFieldName('genre_id', $genreId);
        }

        public function getNameByGenreId(int $id): array{
            $sql = 'SELECT name, genre_id FROM genre WHERE genre_id IN (SELECT genre_id FROM book_genre WHERE book_id = ?)';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $book_genre = NULL;
            if($res){
                $book_genre = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $book_genre;
        }

        public function isActive($book_genre) {
            if (!$book_genre) {
                return false;
            }

            if ($book_genre->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }