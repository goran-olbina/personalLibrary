<?php
    namespace App\Controllers;

    class UserPublisherManagementController extends \App\Core\Role\UserRoleController {
        public function publishers() {
            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publishers = $publisherModel->getAll();
            if(!$publishers){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('publishers', $publishers);
        }

        public function getEdit($publisherId){
            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publisher = $publisherModel->getById($publisherId);

            if(!$publisher){
                $this->redirect(\Configuration::BASE . 'user/publishers');
            }

            $this->set('publisher', $publisher);

            return $publisherModel;
        }

        public function postEdit($publisherId){
            $publisherModel = $this->getEdit($publisherId);

            $name          = filter_input(INPUT_POST, 'name',          FILTER_SANITIZE_STRING);
            $country       = filter_input(INPUT_POST, 'country',       FILTER_SANITIZE_STRING);
            $city          = filter_input(INPUT_POST, 'city',          FILTER_SANITIZE_STRING);
            $foundingYear  = filter_input(INPUT_POST, 'founding_year', FILTER_SANITIZE_STRING);
            $isDeleted = filter_input(INPUT_POST, 'is_deleted', FILTER_SANITIZE_NUMBER_INT);

            $publisherModel->editById($publisherId, [
                'name'          => $name,
                'country'       => $country,     
                'city'          => $city,        
                'founding_year' => $foundingYear,
                'is_deleted'    => $isDeleted
            ]);

            $this->redirect(\Configuration::BASE . 'user/publishers');
        }

        public function getAdd(){
            
        }

        public function postAdd(){
            $name          = filter_input(INPUT_POST, 'name',          FILTER_SANITIZE_STRING);
            $country       = filter_input(INPUT_POST, 'country',       FILTER_SANITIZE_STRING);
            $city          = filter_input(INPUT_POST, 'city',          FILTER_SANITIZE_STRING);
            $foundingYear  = filter_input(INPUT_POST, 'founding_year', FILTER_SANITIZE_STRING);

            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publisherId = $publisherModel->add([
                'name'          => $name,
                'country'       => $country,     
                'city'          => $city,        
                'founding_year' => $foundingYear
            ]);

            if($publisherId){
                $this->redirect(\Configuration::BASE . 'user/publishers');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }
    }