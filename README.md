# DVD-Database-Web-Application

## Description
This is a web application built with PHP and MySQL to manage a database of DVDs. Key features:

- Browse and search the DVD database
- View details for individual DVDs
- Add new DVDs

The app uses PHP and MySQLi to connect to a database, execute queries, and handle form input/validation. The presentation uses HTML, CSS Bootstrap for styling, and PHP loops to generate content.

## Pages
- **index.php** - Homepage
- **search_form.php** - Search form with filters
- **search_results.php** - Handles search and displays results
- **details.php** - Displays DVD details by ID
- **add_form.php** - Form to add a new DVD
- **add_confirmation.php** - Processes add DVD request

## Database

The database contains tables for:

- **dvd_titles** - Stores DVD info
- **genres** - DVD genres
- **formats** - DVD formats
- **labels** - DVD labels
- **ratings** - DVD ratings
- **sounds** - DVD sound types

Foreign keys are used to link the lookup tables to the main DVD titles table.

## Usage

The homepage links allow you to:

- Go to the search form to lookup DVDs by title, release year, genre etc.
- Go to the add DVD form to add a new DVD to the database

Search results display DVD titles and links to view more details.

The add form validates input and inserts the DVD details into the database.

## Setup

To run this application:

1. Import the SQL code to create the database schema
2. Update db connection settings in PHP code
3. Add sample data by running the INSERT statements
4. Move files to your server
5. Access index.php to launch the app


