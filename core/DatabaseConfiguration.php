<?php
    namespace App\Core;
    
    class DatabaseConfiguration {
        private $host;
        private $username;
        private $password;
        private $name;
        public function __construct(string $host, string $user, string $pass, string $name){
            $this->host     = $host;
            $this->username = $user;
            $this->password = $pass;
            $this->name     = $name;
        }
        public function getSourceString(): string{
            return "mysql:host={$this->host};dbname={$this->name};charset=utf8";
        }
        public function getUsername(): string{
            return $this->username;
        }
        public function getPassword(): string{
            return $this->password;
        }
    }
