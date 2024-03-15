# BSS Tracker

## Requirements

- A web server (Apache/NGINX)
- PHP (>= 8.1)
- A database server
  - MariaDB (10.10+)
  - MySQL (5.7+)
  - PostgreSQL (11.0+)
  - SQLite (3.8.8+)
  - SQL Server (2017+)
- Composer (https://getcomposer.org)
- NodeJS (NPM/Yarn for asset bundling)

BSS Tracker uses Laravel as it's PHP Framework. For further detailed instructions on setting up the system (including possible requirements not listed here) please visit the [Laravel Documentation](https://laravel.com/docs/10.x/).

## Deployment

As BSS Tracker is built using Laravel, deployment instructions are identical to those of Laravel. For help getting the application up & running, refer to the [Laravel Deployment Documentation](https://laravel.com/docs/10.x/deployment). 

## Front-end assets

Once Laravel is setup (including Composer dependencies), you must build the front-end assets. You can accomplish this by running the `npm run build` command in the root directory of the application.

## Installation

Once all of the above steps have been completed, you should now be able to navigate to the application URL & follow the web-based installation instructions.
