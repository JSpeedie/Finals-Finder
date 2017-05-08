/*
 * This JavaScript file does most of the cool stuff. It includes mostly
 * Ajax calls, lots of jQuery to make it readable and easier to accomplish
 * what we're trying to do and some plan old JavaScript too. The purpose
 * of this file is to handle essentially the "backend".
 * It handles events on courses.php, and it makes use of exams.php and
 * search.php to fill the drop down menu and the table without having
 * to leave the page allowing you to add multiple exams to the table
 * rather than viewing only one at a time.
 */

function getCourses(event) {
	/* Prevent it from going to exams.php since we are
	 * using it as a web-service */
	event.preventDefault();
	/* Request search results from exams.php */
	$.getJSON(
		"exams.php",
		{ "course": $("#text_field").val() },
		function(data) {
			//clearDropDown();
			/* Empty out dropdown so it shows only results from this search */
			$("#select_course").empty();
			$("#select_course").append('<option value="select_option">'
				+ 'Select a Course</option>');
			//addDropDownOptions(data);
			/* Iterate through data returned from search */
			$.each(data, function(key, courses) {
				/* Add a new dropdown option for the course */
				$("#select_course").append('<option value="'
					+ courses["id"] + '">' + courses["course"] + ' '
					+ courses["section"] + ' ' + courses["instructor"]
					+ ' ' + '</option>');
			});
		}
	)
	.fail(function() {
		alert("Could not get exams for given search!");
	});
	/* If the user selects a course from the drop down menu */

	$("#select_course").unbind("change");
	$("#select_course").change(function() {
		/* Once they select a course, adjust the table to be
		 * filled in with the final's information for that course */
		$.getJSON(
			"search.php",
			{ "course" : $("#select_course").val() },
			function(data) {
			$.each(data, function(key, courses) {
				/* Add a new dropdown option for the course */
				$("#final_table").append('<tr>'
					+ '<td class="final_table_content">'
					+ courses["course"] + '</td>'
					+ '<td class="final_table_content">'
					+ courses["section"] + '</td>'
					+ '<td class="final_table_content">'
					+ courses["instructor"] + '</td>'
					+ '<td class="final_table_content">'
					+ courses["date"] + '</td>'
					+ '<td class="final_table_content">'
					+ courses["start"] + '</td>'
					+ '<td class="final_table_content">'
					+ courses["end"] + '</td>'
					+ '</tr>'
				);
				$("tr:odd").addClass("odd");
				$("tr:even").addClass("even");
			});
		})
		.fail(function() {
			alert("Could not get final's information for given course!");
		});
	});
}

$(document).ready(function() {
	/* Change function called on submitting the search form */
	$("#form1").submit(getCourses);
});
