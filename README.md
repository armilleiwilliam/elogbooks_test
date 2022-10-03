
## About the project
It runs on Laravel v9 and React integrated in the same application.

## Installation:
- git repository is public, you should be able to clone it without permissions.
- this is the link: https://github.com/armilleiwilliam/elogbooks_test
  however you can run “git clone https://github.com/armilleiwilliam/elogbooks_test.git”
- run “composer install”
- run “npm install"
- run “npm run dev” (or build) to build the react app
- create the env. file, create a new mysql database and set the database credentials on env.
- if the database is successfully connected by running “php artisan migrate:refresh –-seed” should create a fresh database
  with dummy data stored with the seeder and factories I have developed. I’d suggest to not copy and paste the above command
  (php artisan migrate:refresh –-seed ) but to type it in as it might not work. When opening the view the list of jobs should
  be already populated as Users, Properties and Jobs tables are created and populated with dummy data.
- run “php artisan serve”
- it might ask you to generate the App Key, just click on “Geneate App Key” on the right hand side of the browser window
  when accessing  http://127.0.0.1:8000 or run "php artisan key:generate". Then refresh the page.
- you will then see a simple blank page with the links to the two views. Click on one of them. Otherwise, access to them directly with:
- list of jobs: http://127.0.0.1:8000/property-jobs/
- log a job: http://127.0.0.1:8000/property-jobs/add-job
- for testing, run “php artisan test” after following the below instructions in "Testing with PhpUnit" section. 

## Graphic:
The graphic is very minimal, I have tried to focus mainly on the programming following your instructions, as this is the
main scope of the test.

## Understanding of the project:
As far as I understood the two views need to have an Api interaction between a front end (I chose React) and
backend framework (I chose Laravel). Every request and even the list of jobs in the main page have been created with React
Api requesting data from a Laravel back end. To be honest for
the list of jobs in the main view I would have used only laravel with a blade view, it would have been easier and quicker,
but I understand you needed to see how good my skills in React are.
In case I might not have understood your requirements completely I have added a section which you didn't request, the editing and updating
of a job. Basically it has been built entirely with Laravel and blade. That was simply to show you
my Laravel skills more fully, also in this case the graphic is very minimal.

## Components:
The views are included in a component “x-app-layout”, usually I use something like extend(“layout.app.blade”) for each view,
but I think components make life somehow easier and keep the code more tidy.

## Controllers and comments
Usually 4-5 methods per controller, but considering the methods in this application are quite short I left them all (about 7) in the 
same controller. 
I usually create methods which names are self-explanatory, so, I leave comments
when it's necessary in order to not have too many lines of code. 

## Testing with PhpUnit:
- for testing purposes I use “sqlite” and database “:memory:” (see phpunit.xml), so, there is no need to set any physical database
  as it uses the memory of your machine. But in order to have it working you need to have php-sqlite3 installed, 
  if you don’t have it run “sudo apt-get install php-sqlite3”, you might need to enable it on your php.ini. Otherwise, create 
   a database just for testing and add it to phpunit.xml file replacing ':memory:' line, then comment the DB_CONNECTION “sqlite” line.
  In some cases the settings could be ignored returning a failing test when you have :memory: set, run "php artisan config:clear" and 
  "php artisan migrate:refresh --seed" to restore the database. Why you need to restore the db? Because if you run the test and it does ignore
  the setting ":memory:" it deletes entirely the physical database (use RefreshDatabase;), so you have to 
  restore the dummy data. I hope it makes sense.  :-) For your information when I last ran the test it was successful. 


## User:
- considering there is no login process, when creating a new job the user is assigned hard coded (user_id = 1).

## FOR YOUR INFOMATION:
You won’t need it, but just for you information, to install react on my application I have ran the following:
- composer require laravel/ui
- php artisan ui react
- npm install
- npm run dev

ENJOY :-)
