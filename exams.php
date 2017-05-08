<?php
/*
 * In this file, I have created the exams.php web service. It prints out (or returns, if you will)
 * a JSON formatted, 2D array containing for each element, a tuple from a query looking for similar
 * courses to the given variable 'course' specified in the url. If it finds 0 results or there is
 * another error, it returns an HTTP 404 error.
 */



/* It is expected this file exists. In that file it is expected that the following
 * variables are declared: $servername, $username, $password, $dbname. */
include('config.php');

/* Connect to the database '$dbname' of the server '$servername' using
 * the username and password '$username' and '$password' */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Get the variable representing a course search string. This file attempts to return
 * tuples with a 'course' attribute similar to the search */
$course = $_REQUEST["course"];

/* If it failed to connect to the given database of the given server */
if (mysqli_connect_errno()) {
	header("HTTP/1.1 404 Page Not Found");
	die("Page not found");
}

/* Declare array to be used for storing query results */
$tuples = array();

/* If the query was successful.
 * Query for all courses where the course attribute
 * contains '$course' at any part in the 'course' attribute content.
 * This was chosen over a previous implementation of searching just for tuples where
 * 'course''s content began with '$course' since it is more useful to the user. */
try {
	$result = mysqli_query($conn,
	"SELECT * FROM courses where course like '"
	. "%" . $course . "%';");

	/* While there are rows left in the query result */
	while ($row = $result->fetch_assoc()) {
		/* Append the result to the array */
		$tuples[] = $row;
	}
/* If the query did not return any results */
} catch(Exception $e) {
	header("HTTP/1.1 404 Page Not Found");
	die("Page not found");
}

/* Echo out results of query for use in another file */
echo json_encode($tuples);

/* Close connection once we are done with it */
mysqli_close($conn);
?>
