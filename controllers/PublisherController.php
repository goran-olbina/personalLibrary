<?php
    namespace App\Controllers;

    class PublisherController extends \App\Core\Controller {
        public function select($id) {
            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publisher = $publisherModel->getById($id);
            
            if(!$publisher){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('publisher', $publisher);

            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $booksFromPublisher = $bookModel->getAllByPublisherId($id);
            
            $this->set('booksFromPublisher', $booksFromPublisher);
        }

        public function show() {
            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());

            $publishers = $publisherModel->getAll();

            if(!$publishers){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('publishers', $publishers);
        }

    }