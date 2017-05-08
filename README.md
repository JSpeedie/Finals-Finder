## Requirements

This web page expects a properly filled out file `config.php` that specifies
the MySql server address, username, password, and database name in order to
work. An example one is provided.

For this page to work properly, the database is expected to contain 2 tables:
`courses` taking the format of:

```
+-------------+-------------+--------------+------+
| course      | section     | instructor   | id   |
+-------------+-------------+--------------+------+
| VARCHAR(12) | VARCHAR(12) | VARCHAR(50)  | INT  |
+-------------+-------------+--------------+------+
```

...and `time` taking the format of:

```
+------+-------------+----------+----------+----------+-------------+
| id   | date        | start    | end      | duration | room        |
+------+-------------+----------+----------+----------+-------------+
| INT  | CHAR(10)    | CHAR(8)  | CHAR(8)  | CHAR(8)  | VARCHAR(10) |
+------+-------------+----------+----------+----------+-------------+
```

The database (used in the screenshots, containing an example `courses` and
an example `time`) is provided in the
[wiki](https://github.com/JSpeedie/Finals-Finder/wiki).


## Usage

When courses.php is loaded, the user is expected to enter fragments of a
(or a full) course name. If one is not found, the user will receive a dialog
informing them of the error. Upon a successful search, the dropdown menu
will be populated with all the courses in the database that match the search.
When the user selects a course from the drop down by clicking on it, the info
about the final exam for that course (found in the database) is added to the
page. The user can continue adding finals until satisfied.


## Screenshots

What the page looks like when you first open it:

![First Screenshot](https://github.com/JSpeedie/Finals-Finder/wiki/images/Page1.png)

How it looks after searching for "csc" and clicking the drop down menu:

![Second Screenshot](https://github.com/JSpeedie/Finals-Finder/wiki/images/Page2.png)

The page after adding a couple finals:

![Third Screenshot](https://github.com/JSpeedie/Finals-Finder/wiki/images/Page3.png)
