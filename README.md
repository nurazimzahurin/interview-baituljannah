## Getting Started

1. Clone this repo
1. Run composer.
   ```shell
    composer install
   ```
1. Run npm.
   ```shell
    npm install
    npm run watch
   ```
1. Create .env file based on env.example
1. Make sure APP_URL in .env file is configured.
1. Configure db in .env
1. Configure mail in .env eg: mailtrap
1. Run artisan key:generate.
   ```shell
    php artisan key:generate
   ```
1. Run artisan storage:link.
   ```shell
    php artisan storage:link
   ```
1. Run artisan migration.
   ```shell
    php artisan migrate
   ```

## Features

1. CRUD opreations.
1. user can view list.
1. user can view product's detail.
1. user can create product.
1. product's owner can edit/delete product.
1. non product's owner can review product.
1. certain comment is not allowed for review. This will trigger mail to product's owner to notify censored reviews.
1. product's reviewed will be logged and trigger stock recalculation as mocking buying process.
