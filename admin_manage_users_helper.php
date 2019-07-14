<?PHP
require('db_configuration.php');

/**
 * Pulls the user info from the data base and returns an array of Users
 * @return array, of users pulled from database
 */
function getUserInfo()
{
    $users = array();
    $db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $sql = 'SELECT * FROM users';
    $result = $db->query($sql);
    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["username"];
            $email = $row["user_email"];
            $isVerified = $row["id_verified"];
            $isAdmin = $row["role"];
            array_push($users, new User($name, $email, null, $isVerified, null, $isAdmin));
        }
    }
    return $users;
}

/**
 * Makes the body of the user table.
 * @return string html need to create body of user table
 */
function create_user_table()
{
    $htmlTableBody = "";
    $listOfUsers = getUserInfo();
    while (sizeof($listOfUsers) > 0) {
        $user = array_pop($listOfUsers);
        $htmlTableBody .=
            "<tr><td>" . $user->name . "</td><td>" . $user->email . "</td><td>" . $user->isVerified . "</td><td>" . $user->isAdmin . "</td>
                 <td>
                    <a href=\"#\">
                        <img class=\"table_image\" src=\"pic/edit.jpg\" alt=\"Edit\">
                    </a>
                    <a href=\"#\">
                        <img class=\"table_image\" src=\"pic/delete.jpg\" alt=\"deleteWord\">
                    </a>
                 </td>
             </tr>";
    }
    return $htmlTableBody;
}

/* NOTE: do we want admin to be able to change all fields */
/**
 * Edits the user with the inputed paramerters
 * @param string $email of user to be edited
 * @param string $username of user to be edited
 * @param string $password of user to be edited
 * @param integer $isVerified 1 if user is verified else 0
 * @param integer $isAdmin 1 if user is admin else 0
 * @return boolean, true if user was edited else false
 */
function editUser($email, $username, $password, $isVerified, $isAdmin)
{
    /* TODO: complete function to edit a user */
}

/**
 * Deletes a user with the specified email
 * @param  string $email of user to be deleted
 * @return boolean  true if user was deleted else false
 */
function deleteUser($email)
{
    /* TODO: complete function to delete a user */
}

/**
 * Class represents a user in our database
 */
class User
{

    /**
     * Constructor for user class
     * @param string $name of user
     * @param string $email of user
     * @param integer $isVerified 1 if user is verified else 0
     * @param integer $isAdmin 1 if user is admin else 0
     */
    function User($name, $email, $password, $isVerified, $activationCode, $isAdmin)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->isVerified = $isVerified;
        $this->activationCode = $activationCode;
        $this->isAdmin = $isAdmin;
    }

    /**
     * String representation of a user with fields seperated by a comma
     * @return string  user in format name, email, isVerified, isAdmin
     */
    function toString()
    {
        return $this->name . ", " . $this->email . ", " . $this->isVerified . ", " . $this->isAdmin;
    }
}

?>
