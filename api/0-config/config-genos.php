<?php 
	
	//Genos use auto increment field and attribute id as primary key
	// If you want to use another field/attribute as primary key set following variable
	// If it's false you'll have to add attribute primary_key in your class
	$ID_PRIMARY_DEFAULT = true;


	//If ou wish to give a personnal value for your primary key you'll have to create the attribute genos_force_value in your class with boolean true value

	//Table name format
	//Windows is case unsensitive, but database on prod should be case sensitive
	//You have to choose between : lowercase, uppercase, capitalize, custom
	//If you choose personalised you'll have to add attribute table_name in your class

	//If you must use an another database for a class, you'll have to add the class attribute genos_db with the database name as value

	$TABLE_CASE = "lowercase";

	//DATABASE
	$DATABASE_NAME ='bdd_mod_eleve';
	$DATABASE_HOST ='localhost';
	$DATABASE_PORT ='3306';
	$DATABASE_USER ='root';
	$DATABASE_PSWD ='';

	define("ID_PRIMARY_DEFAULT",$ID_PRIMARY_DEFAULT);
	define("TABLE_CASE",$TABLE_CASE);
	define("DATABASE_NAME",$DATABASE_NAME);
	define("DATABASE_HOST",$DATABASE_HOST);
	define("DATABASE_PORT",$DATABASE_PORT);
	define("DATABASE_USER",$DATABASE_USER);
	define("DATABASE_PSWD",$DATABASE_PSWD);

	$URL_HOME = "http://localhost/Mod-Project-Eleve/";
	define("URL_HOME",$URL_HOME);
	include(__DIR__."/genos.php");
	include(__DIR__."/../1-class/projet.php");
	include(__DIR__."/../1-class/classe.class.php");
	include(__DIR__."/../1-class/eleve.class.php");
	include(__DIR__."/../1-class/matiere.class.php");
	include(__DIR__."/../1-class/note.class.php");
	include(__DIR__."/../1-class/classe_matiere.class.php");
	