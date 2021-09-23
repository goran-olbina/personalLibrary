<?php
    namespace App\Core\Role;

    class UserRoleController extends \App\Core\Controller {
        public function __pre(){
            if($this->getSession()->get('admin_id', null) === null) {
                $this->redirect('http://localhost/goranPL/user/login');
            }
        }
    }