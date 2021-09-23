<?php
    namespace App\Controllers;

    class UserBookshelfManagementController extends \App\Core\Role\UserRoleController {
        public function bookshelves() {
            $bookshelfModel = new \App\Models\BookshelfModel($this->getDatabaseConnection());
            $bookshelves = $bookshelfModel->getAll();
            if(!$bookshelves){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('bookshelves', $bookshelves);
        }

        public function getEdit($bookshelfId){
            $bookshelfModel = new \App\Models\BookshelfModel($this->getDatabaseConnection());
            $bookshelf = $bookshelfModel->getById($bookshelfId);

            if(!$bookshelf){
                $this->redirect(\Configuration::BASE . 'user/bookshelves');
            }

            $this->set('bookshelf', $bookshelf);

            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $rooms = $roomModel->getAll();
            if(!$rooms){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('rooms', $rooms);
            
            return $bookshelfModel;
        }

        public function postEdit($bookshelfId){
            $bookshelfModel = $this->getEdit($bookshelfId);

            $roomId = filter_input(INPUT_POST, 'room_id', FILTER_SANITIZE_STRING);
            $isDeleted = filter_input(INPUT_POST, 'is_deleted', FILTER_SANITIZE_NUMBER_INT);

            $bookshelfModel->editById($bookshelfId, [
                'room_id' => $roomId,
                'is_deleted' => $isDeleted
            ]);

            $this->redirect(\Configuration::BASE . 'user/bookshelves');
        }

        public function getAdd(){
            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $rooms = $roomModel->getAll();
            if(!$rooms){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('rooms', $rooms);
        }

        public function postAdd(){
            $roomId = filter_input(INPUT_POST, 'room_id', FILTER_SANITIZE_STRING);

            $bookshelfModel = new \App\Models\BookshelfModel($this->getDatabaseConnection());
            $bookshelfId = $bookshelfModel->add([
                'room_id' => $roomId
            ]);

            if($bookshelfId){
                $this->redirect(\Configuration::BASE . 'user/bookshelves');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }
    }