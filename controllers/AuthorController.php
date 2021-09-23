<?php
    namespace App\Controllers;

    class AuthorController extends \App\Core\Controller {
        public function show() {
            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());

            $authors = $authorModel->getAll();

            if(!$authors){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('authors', $authors);
        }

        public function select($id) {
            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
            $author = $authorModel->getById($id);
            
            if(!$author){
                header('Location: {{ BASE }}');
                exit;
            }

            $this->set('author', $author);

            $bookName = $authorModel->getBooksByAuthorId($id);
            
            $this->set('bookName', $bookName);
        }
    }