## Installing Locally

To install the API locally for development, you'll need to follow these steps:

1. Install Homestead
1. Clone the repo
1. Create a .env file
1. Install dependencies
1. Create the database
1. Create a hosts entry

### Install Homestead

Follow the instructions at https://laravel.com/docs/homestead.

You'll also need to add a site configuration to the `Homestead.yaml` file:

```yaml
sites:
    - map: vitl.test
      to: /home/vagrant/code/public
```

### Clone the repo

Create a `code` folder in your home directory, and clone the Vitl Test repo into it:

```bash
git clone git@bitbucket.org:cliftonconnects/abf-api.git
```

### Create a .env file

Create a `.env` file inside the project directory, and paste in the contents of [this snippet](https://bitbucket.org/snippets/cliftonconnects/6e5xo9/abf-api-development-env-file).

### Install dependencies

Install Laravel and the other app dependencies via composer:

```bash
composer install
```

### Create the database

Connect to the Homestead MySQL server and create a new database called `abf`. The quickest way to get the API database populated is to take a copy of the `abf-demo` database and import it into your new local DB.

### Create Elasticsearch indices and import models

Create an Elasticsearch index for the relevant model by running:

```bash
php artisan elastic:create-index "App\Models\Business\Customer"
```

and import the existing records:

```bash
php artisan scout:import "App\Models\Business\Customer"
```

The current list of Elasticsearch-enabled models is:

```text
App\Models\Account
App\Models\Activity\Comment
App\Models\Business\Customer
App\Models\Business\Partner
App\Models\Colour
App\Models\Enquiry
App\Models\Product
App\Models\Referral
```

You'll need to start the queue to process the imports (NB: this could take a while!):

```bash
php artisan queue:listen
```

### Create a hosts entry

Create an entry in the hosts file of your local machine to point `api.abf.test` at the IP `192.168.25.10`.

## Running the Tests

To run the E2E test suite, you'll need to create test indices in your Elasticsearch instance by running the following artisan command:

```bash
php artisan elastic:create-test-indices --env=testing
```

You can then run the tests my running phpunit from within the project directory:

```bash
phpunit
```
