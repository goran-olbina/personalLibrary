<?php
    namespace App\Controllers;

    class GenreController extends \App\Core\Controller {
        public function show() {
            $genreModel = new \App\Models\GenreModel($this->getDatabaseConnection());

            $genres = $genreModel->getAll();

            if(!$genres){
                header('Location: {{ BASE }}');
                exit;
            }
            
            $this->set('genres', $genres);
        }

        public function select($id) {
            $genreModel = new \App\Models\genreModel($this->getDatabaseConnection());
            $genre = $genreModel->getById($id);
            
            if(!$genre){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('genre', $genre);

            $bookName = $genreModel->getBooksByGenreId($id);

            $this->set('bookName', $bookName);
        }
    }