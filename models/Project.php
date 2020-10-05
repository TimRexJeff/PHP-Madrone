<?php
    class Project {
        // DB stuff
        private $conn;
        private $table = 'projects';

        // Project Properties
        public $id;
        public $name;
        public $description;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        ////////////
        // CREATE //
        ////////////

        // Create Project
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                'SET
                    name = :name,
                    description = :description';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //////////
        // READ //
        //////////

        // Get Projects
        public function read() {
            //Create query
            $query =
                'SELECT
                    
                FROM
                    ' . $this->table . '
                ORDER BY';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        ////////////
        // UPDATE //
        ////////////

        ////////////
        // DELETE //
        ////////////
    }