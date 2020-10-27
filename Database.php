<?php

class Database {

    private $dbHost = 'localhost';
    private $dbName = 'doctorsdatabase';
    private $dbUser = 'r1q31a0l21p2';
    private $dbPass = 'Bellaria79@@';
    // private $dbName = 'health';
    // private $dbUser = 'atif';
    // private $dbPass = 'password';
    private $db;

    // Make DB connect and check if it's working fine
    public function __construct()
    {
        try {
            
            $this->db = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName;charset=UTF8", $this->dbUser, $this->dbPass);

        } catch(PDOException $ex) {
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect' . $ex->getMessage())));
        }
    }
    
    public function checkIfEmailExist($email)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM User WHERE email LIKE '$email'";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                session_start();
                $_SESSION['payload'] = json_encode($user);

                return false;
            }

            return true;

		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function getOrginizations()
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM Organization";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
    
    public function getRoles()
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `Role`";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
	}
	
	public function getLatLngUsers()
	{
		try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `User` WHERE `Lat` is not NULL AND `Long` is not NULL";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
	}

    public function getLastUserDetail()
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `User` ORDER BY `userID` DESC LIMIT 1";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function fetchOrgnization($id)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT `name` FROM `Organization` WHERE organizationID = $id";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['name'];
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function getFilesData()
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `Test_Session`";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
    
    public function fetchRole($id)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT `name` FROM `Role` WHERE roleID = $id";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['name'];
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
    
    public function getExcerciseData($userID)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `exercises_data` WHERE u_id LIKE $userID";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function markNoteComplete($noteId, int $completed)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE `notes` SET is_completed = $completed WHERE id LIKE $noteId";
			$stmt = $db->prepare($sql);
			$stmt->execute();
            return true;
            
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
    
    public function deleteNote($noteId)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM `notes` WHERE id LIKE $noteId";
			$stmt = $db->prepare($sql);
			$stmt->execute();
            return true;

		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
    
    public function getNotes($userID)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `notes` WHERE u_id LIKE $userID";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function getAllExcerciseData()
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT e.*, u.name as patient FROM `exercises_data` e INNER JOIN User u ON u.userID = e.u_id";
			$stmt = $db->prepare($sql);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function createExcerciseRow($userId, $name, $session, $duration, $pattern, $startedAt, $endedAt, $info)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO exercises_data(`u_id`, `name`, `session`, `duration`, `pattern`, `started_at`, `ended_at`, `info`) VALUES('$userId', '$name', '$session', '$duration', '$pattern', '$startedAt', '$endedAt', '$info');";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return true;
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function createNote($userId, $note)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $note = addslashes($note);

            $sql = "INSERT INTO `notes`(u_id, note) VALUES($userId, '$note');";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            return true;
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }

    public function createUser($auth, $name, $username, $email, $roleId, $orgnizationId)
    {
        try {
			$db = $this->db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT userID FROM `User` WHERE `username` = '$username' OR `email` = '$email'";
			$stmt = $db->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                $sql = "INSERT INTO User(`auth`, `name`, `username`, `email`, `Role_IDrole`, `Organization`) VALUES('$auth', '$name', '$username', '$email', $roleId, $orgnizationId);";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                return true;
            }
            
            return false;
		} catch(PDOException $e) {
			return "PDO Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "Error: " . $e->getMessage();
		}
    }
}
