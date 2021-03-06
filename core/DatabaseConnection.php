<?php
    namespace App\Core;

    class DatabaseConnection {
        private $connection;
        private $configuration;

        public function __construct(DatabaseConfiguration $databaseConfiguration){
            $this->configuration = $databaseConfiguration;
        }

        public function getConnection(): \PDO {
            if($this->connection == NULL) {
                $this->connection = new \PDO($this->configuration->getSourceString(),
                                            $this->configuration->getUsername(), 
                                            $this->configuration->getPassword());
            }

            return $this->connection;
        }
    }
