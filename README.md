# Rector Issue

## Property $name was not found in reflection of class App\Models\User

### Installation

- Clone the repo:
`git clone [REPO_URL] [DIRECTORY_NAME]`

- Create `.env` file from the example file:
`php -r "file_exists('.env') || copy('.env.example', '.env');"`

- Setup .env variables

- Install the dependencies: `composer install`

- Generate Key: `php artisan key:generate`

- DB migrate: `php artisan migrate`

- Run Rector