<?php
    class AdditionalNote {
        // DB stuff
        private $conn;
        private $table = 'additional_notes';

        // AdditionalNote Properties
        public $id;
        public $note;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        ////////////
        // CREATE //
        ////////////

        // Create AdditionalNote
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                'SET
                    note = :note';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->note = htmlspecialchars(strip_tags($this->note));

            // Bind data
            $stmt->bindParam(':note', $this->note);

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

        // Get AdditionalNotes
        public function read() {
            //Create query
            $query =
                'SELECT
                    note
                FROM
                    ' . $this->table;

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