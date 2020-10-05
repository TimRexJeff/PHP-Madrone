<?php
    class User {
        // DB stuff
        private $conn;
        private $table = 'users';

        // User Properties
        public $id;
        public $email;
        public $display_name;
        public $company_name;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        ////////////
        // CREATE //
        ////////////

        // Create User
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                'SET
                    email = :email,
                    display_name = :display_name,
                    company_name = :company_name';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->display_name = htmlspecialchars(strip_tags($this->display_name));
            $this->company_name = htmlspecialchars(strip_tags($this->company_name));

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':display_name', $this->display_name);
            $stmt->bindParam(':company_name', $this->company_name);

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

        // Get Users
        public function read() {
            //Create query
            $query =
                'SELECT
                    id,
                    email,
                    display_name,
                    company_name
                FROM
                    ' . $this->table . '
                ORDER BY
                    id DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single User
        public function read_single() {
            //Create query
            $query =
                'SELECT
                    id,
                    email,
                    display_name,
                    company_name
                FROM
                    ' . $this->table . '
                WHERE
                    id = ?
                LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->name = $row['name'];
        }

        ////////////
        // UPDATE //
        ////////////

        // Update User
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . 
                'SET
                    email,
                    display_name,
                    company_name
                WHERE
                    id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->display_name = htmlspecialchars(strip_tags($this->display_name));
            $this->company_name = htmlspecialchars(strip_tags($this->company_name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':display_name', $this->display_name);
            $stmt->bindParam(':company_name', $this->company_name);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        ////////////
        // DELETE //
        ////////////

        //Delete User
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }