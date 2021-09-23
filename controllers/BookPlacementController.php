<?php
    namespace App\Controllers;

    class BookPlacementController extends \App\Core\Controller {
        public function select($id) {
            $bookPlacementModel = new \App\Models\BookPlacementModel($this->getDatabaseConnection());
            $bookPlacement = $bookPlacementModel->getAllByBookId($id);

            if(!$bookPlacement){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('bookPlacement', $bookPlacement);



            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($id);

            $this->set('books', $book);
            
        }

        public function show() {
            $bookPlacementModel = new \App\Models\BookPlacementModel($this->getDatabaseConnection());
            $bookPlacement = $bookPlacementModel->getActive();

            if(!$bookPlacement){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('bookPlacement', $bookPlacement);
        }
    }