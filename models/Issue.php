<?php
    class Issue {
        // DB stuff
        private $conn;
        private $table = 'issues';

        // Issue Properties
        public $id;
        public $name;
        public $description;
        public $priority_tag;
        public $progress_tag;
        public $hash_tag;
        public $created_at;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        ////////////
        // CREATE //
        ////////////

        // Create Issue
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                'SET
                    name = :name,
                    description = :description,
                    priority_tag = :priority_tag,
                    progress_tag = :progress_tag,
                    hash_tag = :hash_tag';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->priority_tag = htmlspecialchars(strip_tags($this->priority_tag));
            $this->progress_tag = htmlspecialchars(strip_tags($this->progress_tag));
            $this->hash_tag = htmlspecialchars(strip_tags($this->hash_tag));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':priority_tag', $this->priority_tag);
            $stmt->bindParam(':progress_tag', $this->progress_tag);
            $stmt->bindParam(':hash_tag', $this->hash_tag);

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

        // Get Issues
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