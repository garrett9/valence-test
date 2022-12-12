## Installation

This project uses [Laradock](https://laradock.io/) for creating the Docker environment to create the application. I created an installation script that should run everything you would need to start the application. It can be seen in `scripts/install.sh`.

1. Clone the repository from GitHub.
    ```
    git clone --recurse-submodules git@github.com:garrett9/valence-test.git 
    ```
1. Navigate to the project's root directory in a terminal and run the following:
    ```
    ./scripts/install
    ```
    This script will perform the following:
    - Build the required docker containers for the application.
    - Create the databases needed in the `mysql` container.
    - Run the database migrations.
    - Build local assets.

    Once the script completes, you can navigate to https://127.0.0.1 to view the application.

## Implementation
For this project, I decided to use [Laravel Inertia](https://inertiajs.com/). This satisfied the requirement of having a front-end framework supported by a back-end API. It also made it easy for me to create database migrations, import the test questions, and write tests. However, as I will mention later, I didn't have time to finish writing my tests :(.

You can find all of the controller logic within `TestsController.php`. This file handles showing the pages requested by the project, and the form submission of completing the Perspective Test. The `submit` function handles the form's submission, but doesn't handle the Perspective value calculations. That is instead handled in the `ProcessTestResults.php` file that is trigged after I fire the `TestSubmitted` event within the `submit` method.

After a test is submitted, a new User is created in the database with the given email that will have an attached record for the submission results. This can be later used for the future store described that detailed a user being able to login and see his/her results once again. Right now, it redirects the user to a signed URL that will expire in 60 minutes upon the test being submitted.

## Moving Forward
Since I unfortunately ran out of time, there are a few things that would need to be done to make this production ready.
1. Finish implementing the tests I stubbed out. I already found that my current "rushed" implementation of calculating the user's Perspective values is not correct based on the test cases provided in the CSV. Moreover, the controller methods themselves should be verified to see if they are working properly.
1. My implementation within `ProcessTestResults.php` page is a little sloppy. With more time, I'd re-evaluate my implementation and see if there are any ways to improve the data manipulation I need to perform.
1. In the `submit` method under `TestsController.php`, my rule for checking if the user already submitted the test only checks if the email exists in the DB. Instead, it should be checking if it already has an associated submission for the test.
1. The front-end interfaces are more like prototypes and production ready components. I'd like to spend more time cleaning them up by making more re-usable components and such.
1. I knew early that I wouldn't have time for this, but an improvement to the `ProcessTestResults.php` event listener should be executed in the background, and a loading indicator should be shown on the results page for a better experience.
1. I did not have enough time to implement the ideal solution for storing answers to the test questions. Right now, they are stored as a JSON column for each test submission. This will make it hard to in the future since indexing on the column values won't be possible. Ideally, I would store each answer as its own record in a new table attached to the question that was being asked.

Other than that, I mostly feel good about the implementation given the time I had and my understanding of the MBTI result. It took some effort to fully understand the calculations that were being asked for. I'm imagining that my current direction might be a little off from what was requested since I made some executive decisions along the way :).

## Tests
To run the tests, you need to do so within the created `workspace` container. There's a helpful script I added to do it easily from the project's root directory.
```
./scripts/ld.sh php artisan test
```

However, I unfortunately ran out of time to actually write any tests. Running the tests would at least show the tests I stubbed out in preperation.
