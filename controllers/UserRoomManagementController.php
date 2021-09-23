<?php
    namespace App\Controllers;

    class UserRoomManagementController extends \App\Core\Role\UserRoleController {
        public function rooms() {
            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $rooms = $roomModel->getAll();
            if(!$rooms){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('rooms', $rooms);
        }

        public function getEdit($roomId){
            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $room = $roomModel->getById($roomId);

            if(!$room){
                $this->redirect(\Configuration::BASE . 'user/rooms');
            }

            $this->set('room', $room);

            return $roomModel;
        }

        public function postEdit($roomId){
            $roomModel = $this->getEdit($roomId);

            $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
            $isDeleted = filter_input(INPUT_POST, 'is_deleted', FILTER_SANITIZE_NUMBER_INT);

            $roomModel->editById($roomId, [      
                'location' => $location,
                'is_deleted' =>$isDeleted
            ]);

            $this->redirect(\Configuration::BASE . 'user/rooms');
        }

        public function getAdd(){
            
        }

        public function postAdd(){
            $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);

            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $roomId = $roomModel->add([
                'location' => $location
            ]);

            if($roomId){
                $this->redirect(\Configuration::BASE . 'user/rooms');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }
    }