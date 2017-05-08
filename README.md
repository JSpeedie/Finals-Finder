# Requirements

This web page expects a file `config.php` that specifies the MySql server
address, username, password, and database name in order to work.

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

The tables used for the screenshots are provided in the wiki. *In progress...*


# Screenshots

*In progress...*


# Overview

When courses.php is loaded, the user is expected to enter fragments of a
(or a full) course name. If one is not found, the user will receive a dialog
informing them of the error. Upon a successful search, the dropdown menu
will be populated with all the courses in the database that match the search.
When the user selects a course from the drop down by clicking on it, the info
about the final exam for that course (found in the database) is added to the
page. The user can continue this until satisfied.
