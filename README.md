# Pastimes

A web application built for the Web Development module (WEDE6021) of my IIE Diploma in IT in Software Development at IIE Rosebank College. Pastimes helps people discover, search and add local leisure and pastime activities, from hiking groups to board game nights.

## Features

- Browse all activities on the home page
- Search activities by keyword and filter by category
- User accounts: sign up, log in, log out
- Logged-in users can add new activities to the directory
- Data is stored in a MySQL database

## Built with

- PHP (PDO for database access, sessions for login state)
- MySQL
- HTML
- CSS

## Running it locally

1. Install a local PHP + MySQL environment, such as [XAMPP](https://www.apachefriends.org/) or [MAMP](https://www.mamp.info/).
2. Create the database by running `schema.sql` in phpMyAdmin or the MySQL command line. This creates the `pastimes` database, its tables, and a few starter activities.
3. Open `db.php` and update `$db_host`, `$db_name`, `$db_user` and `$db_pass` if your local setup uses different credentials (the defaults match a standard XAMPP install).
4. Place the project folder inside your local server's web root (e.g. `htdocs` for XAMPP).
5. Visit `http://localhost/pastimes/index.php` in your browser.

## Project structure

```
pastimes/
├── index.php          Home page: search, filter, and list activities
├── register.php        Create an account
├── login.php            Log in
├── logout.php          Log out
├── add_activity.php    Add a new activity (requires login)
├── db.php               Database connection
├── style.css             Shared styling
├── schema.sql           Database schema and starter data
└── README.md
```
