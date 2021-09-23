<?php
    namespace App\Controllers;

    class RoomController extends \App\Core\Controller {
        public function select($id) {
            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $room = $roomModel->getById($id);
            if(!$room){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('room', $room);

            $bookshelfModel = new \App\Models\BookshelfModel($this->getDatabaseConnection());
            $bookshelves = $bookshelfModel->getAllByRoomId($id);
            if(!$bookshelves){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('bookshelves', $bookshelves);
        }

        public function show() {
            $roomModel = new \App\Models\RoomModel($this->getDatabaseConnection());
            $rooms = $roomModel->getAll();
            if(!$rooms){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('rooms', $rooms);
        }

    }