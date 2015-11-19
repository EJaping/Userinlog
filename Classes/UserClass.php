<?php

/**
 * Description of Class User
 *
 * @author Edda
 */
class User {
    protected $_username;
    protected $_password;
    protected $_name;
    protected $_email;
    protected $_id;
    protected $conn;
    
    public function __construct() {
        $this->conn = Database::$conn;
    }
    
    public function setUsername($username) {
        
        // check if input is not empty or too long
        if (!empty($username) && strlen($username) <= 25) {
            $this->_username = $username;
            echo "<br />username set: $this->_username.";
        } else {
            echo "Enter a valid username.";
        }
    }
    
    public function setPassword($password) {
        
        // check if input is not empty or too long
        if (!empty($password) && strlen($password) <= 25)  {
            $this->_password = $password;
            echo "<br />password set: $this->_password";
        } else {
            echo "Enter a valid password.";
        }
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function getEmail() {
        return $this->_email;
    }
    
    public function getUsername() {
        return $this->_username;
    }
    
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Check for username and password combo in user database and log in if found.
     * 
     * @return boolean
     */    
    public function login($username, $password) {
        try {
            $user = array('username' => $username, 'password' => $password);
            
            // Prepare PDO statement
            $stmt = $this->conn->prepare("SELECT id FROM user WHERE username = :username AND password = :password");

            $stmt->execute($user);
            
            // Fetch the result and put it in id variable
            $id = $stmt->fetchColumn();

            // return true if a record is found, false if none is found
            if ($id == 0) {
                return false;
                
            } else {
                // set username and password properties
                $this->_username = $username;
                $this->_password = $password;
                               
                // set id in _session variable
                $_SESSION["id"] = $id;
                
                return true;
            }
        }
        catch (PDOException $e) {
            echo "Something went wrong during login: " . $e->getMessage();
        }
    }
    
    public function register($name, $email, $username, $password) {
        // set userdata in array
        $newUser = array(
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password
        );
        
        // prepare insert statement
        $stmt = $this->conn->prepare("INSERT INTO user (name, email, username, password) VALUES (:name, :email, :username, :password)");
        
        $stmt->execute($newUser);
        
        $_SESSION['id'] = $this->conn->lastInsertId();
        echo $_SESSION['id'];
    }
    
    
    /**
     * Retrieve user data from database
     */
    public function getUserData($id) {
        try {
            // prepare search statement
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE id= ? ");

            // bind parameter and execute
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // fetch results
            //$result = $stmt->fetch();
               
            // set properties
            /*$this->_name = $result[1];
            $this->_email = $result[2];
            $this->_username = $result[3];
            $this->_password = $result[4];*/
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) {
                $name = "_$key";
                $this->$name = $value;
            }
            
            // show results in _session message
            $_SESSION["message"] = "<ul style='list-style-type:none'>"
                    . "<li>Name: $this->_name</li>"
                    . "<li>Email: $this->_email</li>"
                    . "<li>Username: $this->_username</li>"
                    . "<li>Password: $this->_password</li>"
                    . "</ul>";

        }
        // catch exceptions
        catch (PDOException $e) {
            echo "Something went wrong while getting the data: " . $e->getMessage();
        }
    }
    
    /**
     * Update user data
     * @param mixed $name
     * @param mixed $email
     * @param mixed $username
     * @param mixed $password
     */
    public function updateUserData($name, $email, $username, $password, $id) {
        try {
            // prepare update statement
            $stmt = $this->conn->prepare("UPDATE user SET name = :name, email = :email, username = :username, password = :password WHERE id = :id");

            $userData = array (
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'id' => $id
            );
            
            $stmt->execute($userData);
            
            // Show results in message
            $_SESSION["message"] = "<ul style='list-style-type:none'>"
                    . "<li>Name: $name</li>"
                    . "<li>Email: $email</li>"
                    . "<li>Username: $username</li>"
                    . "<li>Password:$password</li>"
                    . "</ul>";
            
        }
        // catch exceptions
        catch (PDOException $e) {
            echo "Something went wrong while updating the data: " . $e->getMessage();
        }
    }
    
}
