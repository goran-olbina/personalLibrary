<?php
    namespace App\Controllers;

    class BookController extends \App\Core\Controller {

        public function show() {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());

            $books = $bookModel->getAll();

            if(!$books){
                header('Location: {{ BASE }}');
                exit;
            }
            
            $this->set('books', $books);

            
              
        }

        public function select($id) {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($id);
            if(!$book){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('book', $book);


            $bookPlacementModel = new \App\Models\BookPlacementModel($this->getDatabaseConnection());
            $bookPlacement = $bookPlacementModel->getLastModifiedById($id);
            $this->set('bookPlacement', $bookPlacement);


            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publisher = $publisherModel->getById($book->publisher_id);
            $this->set('publisher', $publisher);


            $bookGenreModel = new \App\Models\BookGenreModel($this->getDatabaseConnection());
            $bookName = $bookGenreModel->getNameByGenreId($id);
            $this->set('bookName', $bookName);

            
            $authorName = $bookModel->getAuthorNamesByBookId($id);
            $this->set('authorName', $authorName); 
        }

        private function normalizeKeywords(string $keywords): string{
            $keywords = trim($keywords);
            $keywords = \preg_replace('| +|', ' ', $keywords);
            return $keywords;
        }

        public function postSearch(){
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());

            $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);

            $keywords = $this->normalizeKeywords($q);

            $books = $bookModel->getAllBySearch($keywords);

            $this->set('books', $books);
        }
    }