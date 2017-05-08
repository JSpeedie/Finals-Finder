<?php
/*
 * In this file, I have created a search result web service. It returns the information of the final
 * for a given course specified in an argument to the php file. This file only really contains the
 * code used to generate that info. It queries a database with the login and address
 * specified in 'config.php' (Sold separately haha) for all the information it needs about the exam.
 * If it encounters an error when trying to get said info, it will return a HTTP 404 error and exit.
 */



/* It is expected this file exists. In that file it is expected that the following
 * variables are declared: $servername, $username, $password, $dbname. */
include('config.php');

/* Connect to the database '$dbname' of the server '$servername' using
 * the username and password '$username' and '$password' */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Get the variable representing a course id. This file attempts to return
 * change elements to display information dependent on a MySql query dependent
 * on the value of this variable */
$course_id = $_REQUEST["course"];

/* If it failed to connect to the given database of the given server */
if (mysqli_connect_errno()) {
	header("HTTP/1.1 404 Page Not Found");
	die("Page not found");
}

/* Declare array to be used for storing query results */
$exam_info = array();

/* Get date, start and end of final plus the course code, section and instructor
 * of the course the final belongs to. */
try {
	$result = mysqli_query($conn, "SELECT * FROM time INNER JOIN "
	. "(SELECT * FROM courses WHERE id = " . $course_id . ") as t1 "
	. "on time.id = t1.id;");

	/* While there are rows left in the query result */
	while ($row = $result->fetch_assoc()) {
		/* Append the result to the array */
		$exam_info[] = $row;
	}
/* If the query did not return any results */
} catch(Exception $e) {
	header("HTTP/1.1 404 Page Not Found");
	die("Page not found");
}

/* Echo out results of query for use in another file */
echo json_encode($exam_info);

/* Close connection once we are done with it */
mysqli_close($conn);

?>
