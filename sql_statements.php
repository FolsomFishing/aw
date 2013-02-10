<?php

//This file contains all of the SQL statements used in thw AW AOTY code
//The SQL statements are prepared statements and prevent SQL Injection

//Total Points SQL
define('PS_SELECT_TOTAL_POINTS_BY_USERID', "SELECT SUM(b.points) as point_total FROM people as a, catches as b WHERE a.id = b.user_id AND b.user_id = ?");
define('PS_SELECT_TOTAL_POINTS_BY_USERNAME', "SELECT SUM(b.points) as point_total FROM people as a, catches as b WHERE a.id = b.user_id AND a.username = ?");
define('PS_SELECT_TOTAL_POINTS_BY_SPECIES', "SELECT SUM(b.points) as point_total FROM people as a, catches as b WHERE a.id = b.user_id AND b.species = ?");
define('PS_SELECT_TOTAL_POINTS_BY_LOCATION', "SELECT SUM(b.points) as point_total FROM people as a, catches as b WHERE a.id = b.user_id AND b.location = ?");
define('PS_SELECT_TOTAL_POINTS_BY_METHOD', "SELECT SUM(b.points) as point_total FROM people as a, catches as b WHERE a.id = b.user_id AND b.method = ?");

define('PS_SELECT_CATCH_POINTS_BY_USERID', "SELECT c.catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id AND p.id = ? by logged DESC");
define('PS_SELECT_CATCH_POINTS_BY_USERNAME', "SELECT c.catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id AND p.username = ? ORDER by logged DESC");
define('PS_SELECT_CATCH_POINTS_BY_SPECIES', "SELECT c.catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id AND c.species = ? ORDER by logged DESC");
define('PS_SELECT_CATCH_POINTS_BY_LOCATION', "SELECT c.catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id AND c.location = ? ORDER by logged DESC");
define('PS_SELECT_CATCH_POINTS_BY_METHOD', "SELECT c.catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id AND c.method = ? ORDER by logged DESC");

define('PS_FIND_PERSON_BY_USERID', "SELECT id, username, firstname, lastname, email from people where id = ?");
define('PS_FIND_PERSON_BY_USER', "SELECT id, username, firstname, lastname, email from people where username = ?");
define('PS_FIND_PERSON_BY_USER_PASS', PS_FIND_PERSON_BY_USER . " and password = ?");
define('PS_CREATE_PERSON', "INSERT into people(username, firstname, lastname, email, password) values (?,?,?,?,?)");
define('PS_INACTIVATE_PERSON', "UPDATE people set end_date = NOW()");

define('SQL_FIND_UNIQUE_USERNAMES', "SELECT distinct(username) from people order by username asc");
define('SQL_FIND_LAST_CATCHES', "SELECT catch_id, username, catch_date, species, method, location, length, points, comment, pic FROM people as p, catches as c WHERE c.user_id = p.id ORDER BY logged DESC");
define('SQL_FIND_TOP_ANGLERS', "SELECT a.username, SUM(b.points) as point_total, count(b.catch_id) as catch_total FROM people as a, catches as b WHERE a.id = b.user_id GROUP BY a.id ORDER BY point_total DESC");

define('PS_CREATE_CATCH',"INSERT into catches(length, species, points, catch_date, location, method, comment, user_id, pic) VALUES (?,?,?,?,?,?,?,?,?)");

define('PS_CHART_1',"SELECT species, COUNT(1) from catches group by species ORDER BY count(1) DESC");


//selects number of catches for a username
define('PS_SELECT_TOTAL_CATCHES_BY_USERNAME', "SELECT people.id, people.Username, count(catch_id) FROM people ,`catches` WHERE people.Username= ? and people.id = catches.user_id"); 

?>
