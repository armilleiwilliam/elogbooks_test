
## About the project
It runs on Laravel v9 and React integrated in the same application.

## Installation:
- git repository is public, you should be able to clone it.
- this is the link: https://github.com/armilleiwilliam/elogbooks_test
  however you can run “git clone https://github.com/armilleiwilliam/elogbooks_test.git”
- run “composer update” (or composer install)
- run “npm update” (or npm install)
- run “npm run dev” to build the react app
- create the env. File, create a new mysql database and set the database credentials on env. File
- if the database is successfully connected by running “php artisan migrate:refresh –-seed” shoud create a fresh database with dummy data stored with the seeder and factories I have developed. I’d suggest to not copy and paste the above command (php artisan migrate:refresh –-seed ) but to type it int as it might not work. When opening the view the list of jobs should be already populated as Users, Properties and Jobs tables are created and populated with dummy data.
- run “php artisan serve”
- it might ask you to generate the App Key, just click on “Geneate App Key” on the right hand side of the browser window when accessing  http://127.0.0.1:8000 or run php artisan key:generate.
- you will then see a simple blank page with the links to the two views. Click on one of them. Otherwise access to them directly with:
- list of jobs: http://127.0.0.1:8000/property-jobs/
- Log a job: http://127.0.0.1:8000/property-jobs/add-job
- for testing, run “php artisan test”

## Understanding of the project:
As far as I understood the two views requested had to have Api interactions between a front end (I chose React) and
backend framework (I chose Laravel). Every request and even the list of jobs in the main page have been created with React
Api requesting data from a Laravel back end. That’s how I have understood it should have been developed. To be honest for
the list of jobs in the main view I would have used only laravel with blade views, it would have been easier and quicker,
but I understand you needed to see how good my skills in React are.
In case I might not have understood your requirements completely I have added a section which you didn't request, the editing and update
of a job. Basically it has been built entirely with Laravel and twig, validation processed by back end code. To show you
my Laravel skills more fully, also in this case the graphic is very minimal. 

## Graphic:
The graphic is very minimal, I have tried to focus mainly on the programming following your instructions, as this is the
main scope of the test.

## Components:
The views are included in a component “x-app-layout”, usually I use something like extend(“layout.app.blade”) for each view,
but I think components make life easier and keep the code more tidy.

## Testing with PhpUnit:
- for testing I use “sqlite” and database “:memory:” (see phpunit.xml), so, there is no need to set any physical database
  for testing because it uses the memory of your machine. But in order to have it working you need to have
  php-sqlite3 installed, if you don’t have it run “sudo apt-get install php-sqlite3”, you might need to enable it on your
  php.ini. Otherwise create a database for testing and add it to phpunit.xml file replacing :memory: line, then comment
  the DB_CONNECTION “sqlite” line.

## User:
- considering there is no login process, when creating a new job, the user is assigned hard coded (user_id = 1).

## FOR YOUR INFOMATION:
You won’t need it, but just in case, to install react on my application I have ran the following:
- composer require laravel/ui
- php artisan ui react
- npm install
- npm run dev

ENJOY :-)
