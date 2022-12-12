<?php

namespace Tests\Feature\Listeners;

use Tests\TestCase;

class ProcessTestResultsTest extends TestCase
{
    /** @test */
    public function it_saves_correct_perspective_values()
    {
        // Assert the perspective values on the Test-Questions.csv file match the actual values saved on the listener.
        // A data provider could be used to make this easier.
    }
}
