<?php
    namespace App\Controllers;

    class UserAuthorManagementController extends \App\Core\Role\UserRoleController {
        public function authors() {
            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
            $authors = $authorModel->getAll();
            if(!$authors){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('authors', $authors);
        }

        public function getEdit($authorId){
            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
            $author = $authorModel->getById($authorId);

            if(!$author){
                $this->redirect(\Configuration::BASE . 'user/authors');
            }

            $this->set('author', $author);

            return $authorModel;
        }

        public function postEdit($authorId){
            $authorModel = $this->getEdit($authorId);

            $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            $lastName  = filter_input(INPUT_POST, 'last_name',  FILTER_SANITIZE_STRING);
            $birthYear = filter_input(INPUT_POST, 'birth_year', FILTER_SANITIZE_NUMBER_INT);
            $deathYear = filter_input(INPUT_POST, 'death_year', FILTER_SANITIZE_NUMBER_INT);
            $info      = filter_input(INPUT_POST, 'info',       FILTER_SANITIZE_STRING);
            $isDeleted = filter_input(INPUT_POST, 'is_deleted', FILTER_SANITIZE_NUMBER_INT);

            $authorModel->editById($authorId, [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'birth_year' => $birthYear,
                'death_year' => $deathYear,
                'info'       => $info,
                'is_deleted' => $isDeleted
            ]);

            $this->redirect(\Configuration::BASE . 'user/authors');
        }

        public function getAdd(){
            
        }

        public function postAdd(){
            $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            $lastName  = filter_input(INPUT_POST, 'last_name',  FILTER_SANITIZE_STRING);
            $birthYear = filter_input(INPUT_POST, 'birth_year', FILTER_SANITIZE_NUMBER_INT);
            $deathYear = filter_input(INPUT_POST, 'death_year', FILTER_SANITIZE_NUMBER_INT);
            $info      = filter_input(INPUT_POST, 'info',       FILTER_SANITIZE_STRING);

            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
            $authorId = $authorModel->add([
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'birth_year' => $birthYear,
                'death_year' => $deathYear,
                'info'       => $info
            ]);

            if($authorId){
                $this->redirect(\Configuration::BASE . 'user/authors');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }
    }