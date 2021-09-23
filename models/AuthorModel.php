<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class AuthorModel extends \App\Core\Model {

        protected function getFields(): array {
            return [
                'author_id'  => new Field((new NumberValidator())->setRequired(),         false),
                
                'first_name' => new Field((new StringValidator())->setMinLength(1),       true),
                'last_name'  => new Field((new StringValidator()),                        true),
                'birth_year' => new Field((new NumberValidator())->setIntegerLength(4),   true),
                'death_year' => new Field((new NumberValidator())->setIntegerLength(4),   true),
                'info'       => new Field((new StringValidator())->setMaxLength(64*1024), true),
                'is_deleted' => new Field((new BitValidator()),                           true)
            ];
        }

        public function getAllByAuthorId(int $authorId): array{
            return $this->getAllByFieldName('author_id', $authorId);
        }

        public function getBooksByAuthorId(int $id): array{
            $sql = 'SELECT name, book_id FROM book WHERE book_id IN (SELECT book_id FROM book_author WHERE author_id = ?)';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $authors = NULL;
            if($res){
                $authors = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $authors;
        }

        public function isActive($author) {
            if (!$author) {
                return false;
            }

            if ($author->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }