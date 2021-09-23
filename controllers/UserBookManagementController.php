<?php
    namespace App\Controllers;

    class UserBookManagementController extends \App\Core\Role\UserRoleController {
        public function books() {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $books = $bookModel->getAll();
            if(!$books){
                header('Location: {{ BASE }}/user/profile');
                exit;
            }
            $this->set('books', $books);
        }

        public function getEdit($bookId){
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($bookId);

            if(!$book){
                $this->redirect(\Configuration::BASE . 'user/books');
            }

            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publishers = $publisherModel->getAll();

            if(!$publishers){
                $this->redirect(\Configuration::BASE . 'user/books');
            }

            $this->set('book', $book);
            $this->set('publishers', $publishers);

            return $bookModel;
        }

        public function postEdit($bookId){
            $bookModel = $this->getEdit($bookId);

            $name =           filter_input(INPUT_POST, 'name',            FILTER_SANITIZE_STRING);
            $originalName =   filter_input(INPUT_POST, 'original_name⁯',   FILTER_SANITIZE_STRING);
            $publisherId =    filter_input(INPUT_POST, 'publisher_id',    FILTER_SANITIZE_STRING);
            $publishingYear = filter_input(INPUT_POST, 'publishing_year', FILTER_SANITIZE_STRING);
            $pages =          filter_input(INPUT_POST, 'pages',           FILTER_SANITIZE_STRING);
            $isbn =           filter_input(INPUT_POST, 'isbn',            FILTER_SANITIZE_STRING);
            $language =       filter_input(INPUT_POST, 'language',        FILTER_SANITIZE_STRING);
            $isHidden =       filter_input(INPUT_POST, 'is_hidden',       FILTER_SANITIZE_STRING);
            $isDeleted =      filter_input(INPUT_POST, 'is_deleted',      FILTER_SANITIZE_STRING);
            $description =    filter_input(INPUT_POST, 'description',     FILTER_SANITIZE_STRING);

            $bookModel->editById($bookId, [      
                'name'            => $name,
                'original_name⁯'   => $originalName,
                'description'     => $description,
                'publisher_id'    => $publisherId,
                'publishing_year' => $publishingYear,
                'pages'           => $pages,
                'isbn'            => $isbn,
                'language'        => $language,
                'is_hidden'       => $isHidden,
                'is_deleted'      => $isDeleted
            ]);

                if(isset($_FILES['image']) && $_FILES['image']['error']==0){
                    
                    $uploadStatus = $this->doImageUpload('image', $bookId);

                    if(!$uploadStatus){
                        return;
                    }
                }


            $this->redirect(\Configuration::BASE . 'user/books');
        }
        
        public function getAdd(){
            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publishers = $publisherModel->getAll();

            $this->set('publishers', $publishers);
        }

        public function postAdd(){
            $name =           filter_input(INPUT_POST, 'name',            FILTER_SANITIZE_STRING);
            $original_name⁯ =  filter_input(INPUT_POST, 'original_name⁯',   FILTER_SANITIZE_STRING);
            $description =    filter_input(INPUT_POST, 'description',     FILTER_SANITIZE_STRING);
            $publisherId =    filter_input(INPUT_POST, 'publisher_id',    FILTER_SANITIZE_STRING);
            $publishingYear = filter_input(INPUT_POST, 'publishing_year', FILTER_SANITIZE_STRING);
            $pages =          filter_input(INPUT_POST, 'pages',           FILTER_SANITIZE_STRING);
            $isbn =           filter_input(INPUT_POST, 'isbn',            FILTER_SANITIZE_STRING);
            $language =       filter_input(INPUT_POST, 'language',        FILTER_SANITIZE_STRING);
            $isHidden =       filter_input(INPUT_POST, 'is_hidden',       FILTER_SANITIZE_STRING);

            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $bookId = $bookModel->add([
                'name'            => $name,
                'original_name⁯'   => $original_name⁯,
                'description'     => $description,
                'publisher_id'    => $publisherId,
                'publishing_year' => $publishingYear,
                'pages'           => $pages,
                'isbn'            => $isbn,
                'language'        => $language,
                'is_hidden'       => $isHidden
            ]);

            $uploadStatus = $this->doImageUpload('image', $bookId);
            
            if(!$uploadStatus){
                return;
            }

            if($bookId){
                $this->redirect(\Configuration::BASE . 'user/books');
            }

            $this->set('message', 'Doslo je do greske pri dodavanju');
        }

        public function select($id) {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($id);
            if(!$book){
                header('Location: {{ BASE }}');
                exit;
            }
            $this->set('book', $book);


            $bookPlacementModel = new \App\Models\BookPlacementModel($this->getDatabaseConnection());
            $bookPlacement = $bookPlacementModel->getLastModifiedById($id);
            $this->set('bookPlacement', $bookPlacement);


            $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
            $publisher = $publisherModel->getById($book->publisher_id);
            $this->set('publisher', $publisher);


            $bookGenreModel = new \App\Models\BookGenreModel($this->getDatabaseConnection());
            $bookName = $bookGenreModel->getNameByGenreId($id);
            $this->set('bookName', $bookName);

            
            $authorName = $bookModel->getAuthorNamesByBookId($id);
            $this->set('authorName', $authorName); 
        }

        private function normalizeKeywords(string $keywords): string{
            $keywords = trim($keywords);
            $keywords = \preg_replace('| +|', ' ', $keywords);
            return $keywords;
        }

        public function postSearch(){
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());

            $t = filter_input(INPUT_POST, 't', FILTER_SANITIZE_STRING);

            $keywords = $this->normalizeKeywords($t);

            $books = $bookModel->getAllBySearchUser($keywords);

            $this->set('books', $books);
        }

        public function filterSearch(){
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());

            $p = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            $a = filter_input(INPUT_POST, 'a', FILTER_SANITIZE_STRING);
            $g = filter_input(INPUT_POST, 'g', FILTER_SANITIZE_STRING);
            $y = filter_input(INPUT_POST, 'y', FILTER_SANITIZE_STRING);
        }

        private function doImageUpload(string $fieldName, string $fileName): bool {

            unlink(\Configuration::UPLOAD_DIR .$fileName . '.jpg');

            $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
            $file = new \Upload\File($fieldName, $uploadPath);
            $file->setName($fileName);
            $file->addValidations([
                new \Upload\Validation\Mimetype("image/jpeg")
            ]);

            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $bookId = $bookModel->editById($fileName, [
                'front_page_image' => $fileName . '.jpg'
            ]);

            try{
                $file->upload();
                return true;
            } catch (Exception $e) {
                $this->set('message', 'Greska- ' . implode(', ', $file->getErrors()));
                return false;
            }
        }
    }