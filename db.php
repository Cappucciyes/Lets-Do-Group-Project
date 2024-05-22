<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS projectSite';
mysqli_query($db, $query) or die(mysqli_error($db));
//make sure our recently created database is the active one
mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

//create user table
$query = "CREATE TABLE student (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL 
        )ENGINE=MyISAM;";
mysqli_query($db, $query) or die(mysqli_error($db));
//create group table
$query = "CREATE TABLE project (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        opener INTEGER UNSIGNED NOT NULL
        )ENGINE=MyISAM;";
mysqli_query($db, $query) or die(mysqli_error($db));

//create member table
$query = "CREATE TABLE projectMembers (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        groupID INTEGER UNSIGNED NOT NULL,
        memberID INTEGER UNSIGNED NOT NULL
        )ENGINE=MyISAM;";
mysqli_query($db, $query) or die(mysqli_error($db));

//create post table
$query = "CREATE TABLE threadPost (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        groupID INTEGER UNSIGNED NOT NULL,
        authorID INTEGER UNSIGNED NOT NULL,
        body TEXT NOT NULL 
        )ENGINE=MyISAM;";
mysqli_query($db, $query) or die(mysqli_error($db));

//create comment table
$query = "CREATE TABLE comment (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        groupID INTEGER UNSIGNED NOT NULL,
        authorID INTEGER UNSIGNED NOT NULL,
        postID INTEGER UNSIGNED NOT NULL,
        body TEXT NOT NULL 
        )ENGINE=MyISAM;";
mysqli_query($db, $query) or die(mysqli_error($db));
