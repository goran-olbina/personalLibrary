<?php
    namespace App\Models;

    use App\Core\Field;
    use App\Validators\NumberValidator;

    class BookAuthorModel extends \App\Core\Model {

        protected function getFields(): array {
            return [
                'book_author_id' => new Field((new NumberValidator())->setRequired(), false),
                
                'book_id'        => new Field((new NumberValidator())->setRequired(), true),
                'author_id'      => new Field((new NumberValidator())->setRequired(), true)
            ];
        }

        public function getAllByBookId(int $bookId): array{
            return $this->getAllByFieldName('book_id', $bookId);
        }

        public function getAllByAuthorId(int $authorId): array{
            return $this->getAllByFieldName('author_id', $authorId);
        }

        public function isActive($book_author) {
            if (!$book_author) {
                return false;
            }

            if ($book_author->is_deleted == 1) {
                return false;
            }

            return true;
        }
    }