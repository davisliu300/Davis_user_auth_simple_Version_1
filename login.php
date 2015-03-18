<?php 
	session_start();
?>

<?php
    //start a session
	
    //connect to our mysql database
//	include(mysql_connect.php);
$CONN = mysqli_connect('localhost','root','','if_db');	
    //get username and password values from our login form, and put them in easier-to-use variables
    //$username = ?
	$username = $_POST['userName'];
    //$password = ?
	$password = $_POST['password'];

    //convert our password into a hashed password, using the function "sha1": $password
	$passwordSha = sha1($password);

    //construct an SQL statement, $query, that selects the record with both our username and hashed password, $username and $password. The table is "users" 
	$query = "SELECT * FROM users WHERE userName = '$username' AND  password = '$passwordSha'";
	
    //execute $query, and receive the results in $results
	$result = mysqli_query($CONN, $query);
    //if a row was returned, the user is validated. 
	while($row = mysqli_fetch_assoc($result)){
		if($mysqli_num_rows($result) == 1){
			$user_info = mysqli_fetch_assoc($result);
			$_SESSION['userinfo'] = $user_info;
			echo "success log in";
		}
		//if the user was validated, fetch the user's data into $user_info variable
		//put the user's data into a key/value pair in the session superglobal.  Use key 'userinfo' in the session superglobal
		else{
			echo "your user name and password not match";
		}
	}
    //else the user wasn't validated
    //inform the user that their username/password was incorrect
    //end of file.  output any results here.
?>
