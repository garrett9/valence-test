<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestsControllerTest extends TestCase
{
    /** @test */
    public function it_shows_perspective_test()
    {
        // Assert the test is returned to the front-end and all questions show
    }

    /** @test */
    public function it_handles_perspective_test_submission()
    {
        // Assert the test successfully submits with the required data

        // Assert a new user is created based on the given email address

        // Assert the "TestSubmitted" event is dispatched
    }

    /** @test */
    public function it_returns_error_if_missing_fields()
    {
        // Assert errors are shown if not all questions are submitted

        // Assert error is shown if email is not given
    }

    /** @test */
    public function it_returns_error_if_email_was_already_used()
    {
        // Assert error is shown if someone uses the same email address to submit the test
    }

    /** @test */
    public function it_displays_correct_perspective_result()
    {
        // Assert the expected value in the tests provided in Test-Cases.csv match the actual value shown on the page.
        // A data provider could be used to make this easier.
    }
}
