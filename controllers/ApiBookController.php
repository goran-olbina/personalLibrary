<?php
    namespace App\Controllers;

    class ApiBookController extends \App\Core\ApiController {
        public function show($id){
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($id);
            $this->set('books', $book);
        }
    }