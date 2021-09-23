<?php
    namespace App\Controllers;

    class BookshelfController extends \App\Core\Controller {
        public function select($id) {
            $bookshelfModel = new \App\Models\BookshelfModel($this->getDatabaseConnection());
            $bookshelf = $bookshelfModel->getById($id);
            if(!$bookshelf){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('bookshelf', $bookshelf);

            $bookPlacementModel = new \App\Models\BookPlacementModel($this->getDatabaseConnection());
            $bookPlacement = $bookPlacementModel->getById($id);
            if(!$bookPlacement){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('bookPlacement', $bookPlacement);

            $bookName = $bookshelfModel->getBooksByBookshelfId($id);
            $this->set('bookName', $bookName);

        }

        public function show() {
            $bookshelfModel = new \App\Models\bookshelfModel($this->getDatabaseConnection());

            $bookshelves = $bookshelfModel->getAll();

            if(!$bookshelves){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('bookshelves', $bookshelves);
        }

    }