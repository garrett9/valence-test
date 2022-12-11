## Installation

This project uses [Laradock](https://laradock.io/) for creating the Docker environment to create the application. I created an installation script that should run everything you would need to start the application. It can be seen in `scripts/install.sh`.

1. Navigate to the project's root directory in a terminal and run the following:
    ```
    ./scripts/install
    ```
    This script will perform the following:
    - Build the required docker containers for the application.
    - Create the databases needed in the `mysql` container.
    - Run the database migrations.
    - Build local assets.

    Once the script completes, you can navigate to http://127.0.0.1 to view the application.

## Tests
1. To run the tests, you need to do so within the created `workspace` container. There's a helpful script I added so that you can open a terminal within the container:
    ```
    ./scripts/termina.sh
    ```
1. Once in the container, you can run the tests with the following:
    ```
    php artisan test
    ```
1. To run the tests with code coverage, execute the following composer command:
    ```
    composer test:coverage
    ```
