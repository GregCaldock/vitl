## Installing Locally

To install the API locally for development, you'll need to follow these steps:

1. Install Homestead
1. Clone the repo
1. Create the database
1. SSH into the Vagrant Homestead instance
1. Install dependencies
1. Run the Database migration and seeder
1. Create a hosts entry
1. Browse to the site

### Install Homestead

Follow the instructions at https://laravel.com/docs/homestead.

You'll also need to add a file and site configuration to the `Homestead.yaml` file, the following is for OSX and Linux - Windows will be mapped differently:

```yaml
folders:
    - map: ~/code/vitl
      to: /home/vagrant/code

sites:
    - map: vitl.test
      to: /home/vagrant/code/public
```

### Clone the repo

Create a `code` folder in your home directory, and clone the Vitl Test repo into it:

```bash
git clone https://github.com/GregCaldock/vitl.git
```

### Create the database

Connect to the Homestead MySQL server and create a new database called `homestead` (if it doesn't exist already). 

### SSH into the Vagrant Homestead instance
From the root of Homestead:
```bash
vagrant ssh
```
Then browse to the project root:
```bash
cd /home/vagrant/code
```

Run the following composer and artisan commands from here

### Install dependencies

Install Laravel and the other app dependencies via composer:

```bash
composer install
```

### Run the Database migration and seeder
Run the following artisan commands to set up the database

```bash
php artisan migrate
```
```bash
php artisan db:seed
```

### Create a hosts entry

Create an entry in the hosts file of your local machine to point `vitl.test` at the IP in `Homestead.yaml`.

### Browse to the site
The search should be available on the root of http://vitl.test
