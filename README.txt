I developed this using XAMPP, other installs may vary.

1) Clone github repo (https://github.com/Matt182/highscores)
2) Open your chosen command line pointing at the directory you cloned the repo in. I'm using the Visual Studio Code terminal
3) Create a local database called 'highscores' for root user with no password
4) Run 'composer install' on the CLI. You may need to download & install composer
5) Run 'php bin/console doctrine:migrations:migrate' to create the required table
6) Navigate to src/Controller/ScoresController.php and change $url on line 49 to match your local url (eg: localhost/score/data)

Thats it for initial setup! Just visit localhost to view it. I'm using a virtual host on highscores.test

You can use links near the top of the page to switch between user/admin views

Now, you'll notice you have no data. You can either use the input box to submit a new score

Or, you can use the SQL below in phpmyadmin

USE `highscores`;
INSERT INTO score (name, difficulty, score, authorised) VALUES
('Matt', 'Easy', 5000, 0),
('John', 'Medium', 100, 0),
('Sarah', 'Easy', 10, 0),
('Jane', 'Hard', 10000, 1),
('Luke', 'Medium', 50, 0),
('Chloe', 'Easy', 500, 1);

NOTES:
- User is able to view all scores authorised
- User is able to add a new score
- User is able to filter the data by name and/or difficulty
- User is able to sort the data on any column
- Admins can authorise & delete scores
- Usually, a user would be required to login to become an admin but that was beyond the scope
so switching between views is the approach I took

TIMEFRAME:
- I expected to take 2 or 3 evenings to learn & build so around 12 hours.
- In reality, it took 2 dinners & 2 evenings (around 6/7 hours in total) from figuring out how to create a Symfony project
to having a finished product.