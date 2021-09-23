<?php
    namespace App\Controllers;

    class UserGenreManagementController extends \App\Core\Role\UserRoleController {
        public function genres() {
            $genreModel = new \App\Models\GenreModel($this->getDatabaseConnection());
            $genres = $genreModel->getAll();
            if(!$genres){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('genres', $genres);
        }

        public function getEdit($genreId){
            $genreModel = new \App\Models\GenreModel($this->getDatabaseConnection());
            $genre = $genreModel->getById($genreId);

            if(!$genre){
                $this->redirect(\Configuration::BASE . 'user/genres');
            }

            $this->set('genre', $genre);

            return $genreModel;
        }

        public function postEdit($genreId){
            $genreModel = $this->getEdit($genreId);

            $name         = filter_input(INPUT_POST, 'name',         FILTER_SANITIZE_STRING);
            $description  = filter_input(INPUT_POST, 'description',  FILTER_SANITIZE_STRING);
            $isDeleted = filter_input(INPUT_POST, 'is_deleted', FILTER_SANITIZE_NUMBER_INT);

            $genreModel->editById($genreId, [
                'name' => $name,
                'description'  => $description,
                'is_deleted'   => $isDeleted
            ]);

            $this->redirect(\Configuration::BASE . 'user/genres');
        }

        public function getAdd(){
            
        }

        public function postAdd(){
            $name         = filter_input(INPUT_POST, 'name',         FILTER_SANITIZE_STRING);
            $description  = filter_input(INPUT_POST, 'description',  FILTER_SANITIZE_STRING);

            $genreModel = new \App\Models\GenreModel($this->getDatabaseConnection());
            $genreId = $genreModel->add([
                'name' => $name,
                'description'  => $description
            ]);

            if($genreId){
                $this->redirect(\Configuration::BASE . 'user/genres');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }
    }