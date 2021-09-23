<?php
    namespace App\Controllers;

    use App\Validators\StringValidator;

    class MainController extends \App\Core\Controller {
        public function home() {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $books = $bookModel->getAll();
            if(!$books){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('books', $books);

            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publishers = $publisherModel->getAll();
            if(!$publishers){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('publishers', $publishers);

            $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
            $authors = $authorModel->getAll();
            if(!$authors){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('authors', $authors);

            $genreModel = new \App\Models\GenreModel($this->getDatabaseConnection());
            $genres = $genreModel->getAll();
            if(!$genres){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('genres', $genres);


            
            $staraVrednost = $this->getSession()->get('brojac', 0);
            $novaVrednost = $staraVrednost + 1;
            $this->getSession()->put('brojac', $novaVrednost);
            $this->set('podatak', $novaVrednost);
        }

        public function getLogin(){}


        public function postLogin(){
            $username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            $validanPassword = (new StringValidator())->setMinLength(5)->setMaxLength(120)->isValid($password);

            if(!$validanPassword) {
                $this->set('message', 'Doslo je do greske');
                return;
            }

            $adminModel = new \App\Models\AdminModel($this->getDatabaseConnection());


            $admin = $adminModel->getByFieldName('username', $username);
            if(!$admin) {
                $this->set('message', 'Ne postoji korisnicko ime');
                return;
            }

            if(!\password_verify($password, $admin->password_hash)){
                sleep(1);
                $this->set('message', 'Lozinka ne valja');
                return;
            }

            $this->getSession()->put('admin_id', $admin->admin_id);
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE . 'user/profile');
        }

        public function getLogout(){
            $this->getSession()->remove('admin_id');
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE);
        }
    }