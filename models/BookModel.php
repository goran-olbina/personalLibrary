<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class BookModel extends \App\Core\Model{
        protected function getFields(): array {
            return [
                'book_id'          => new Field((new NumberValidator())->setRequired(),                                    false), #{1,11}
                        
                'name'             => new Field((new StringValidator())->setMinLength(1),                                  true),     #{1,255}
                'original_name⁯'    => new Field((new StringValidator()),                                                   true),     #{0,255}
                'description'      => new Field((new StringValidator())->setMaxLength(64*1024),                            true),     #{0,64*1024}
                'publisher_id'     => new Field((new NumberValidator())->setRequired(),                                    true),  #{1,11}
                'publishing_year'  => new Field((new NumberValidator())->setIntegerLength(4),                              true),  #{0,4}
                'pages'            => new Field((new NumberValidator())->setRequired()->setIntegerLength(4),               true),  #{1,4}
                'isbn'             => new Field((new NumberValidator())->setIntegerLength(14),                             true),  #{0,14}
                'language'         => new Field((new StringValidator())->setMinLength(1),                                  true),     #{1,255}
                'front_page_image' => new Field((new StringValidator()),                                                   true),     #{0,255}
                'back_page_image'  => new Field((new StringValidator()),                                                   true),     #{0,255}
                'is_hidden'        => new Field((new BitValidator()),                                                      true),
                'is_deleted'       => new Field((new BitValidator()),                                                      true)
            ];
        }
/*
        public function getByFilter(string $publisher, string $author, string $genre, string $year){
            if($publisher === null && $author === null && $genre === null && $year === null)

            $sql = 'SELECT *
                    FROM book
                    INNER JOIN book_author ON book_author.book_id=book.book_id
                    INNER JOIN book_genre ON book_genre.book_id=book.book_id
                    WHERE book.publisher_id='.$publisher.' AND book.publishing_year='.$year.' AND book_genre.genre_id='.$genre.' AND book_author.author_id='.$author.'';
        }
*/
        public function getAllBySearch(string $keywords){
            $sql = 'SELECT * FROM `book` WHERE name LIKE ? OR original_name⁯ LIKE ? AND is_hidden = 0;';

            $keywords = '%' . $keywords . '%';

            $prep = $this->getConnection()->prepare($sql);
            if(!$prep){
                return [];
            }

            $res = $prep->execute([$keywords, $keywords]);
            if(!$res){
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        public function getAllBySearchUser(string $keywords){
            $sql = 'SELECT * FROM `book` WHERE name LIKE ? OR original_name⁯ LIKE ?;';

            $keywords = '%' . $keywords . '%';

            $prep = $this->getConnection()->prepare($sql);
            if(!$prep){
                return [];
            }

            $res = $prep->execute([$keywords, $keywords]);
            if(!$res){
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        public function getAllByPublisherId(int $publisherId): array{
            return $this->getAllByFieldName('publisher_id', $publisherId);
        }

        public function getAuthorNamesByBookId(int $id): array{
            $sql = 'SELECT first_name, last_name, author_id FROM author WHERE author_id IN (SELECT author_id FROM book_author WHERE book_id = ?)';

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);

            $book = NULL;
            if($res){
                $book = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $book;
        }

        public function isActive($book) {
            if (!$book) {
                return false;
            }

            if ($book->is_deleted == 1) {
                return false;
            }

            return true;
        }

        public function isHidden($book) {
            if (!$book) {
                return false;
            }

            if ($book->is_hidden == 1) {
                return false;
            }

            return true;
        }
    }