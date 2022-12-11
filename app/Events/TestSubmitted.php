<?php

namespace App\Events;

use App\Models\Test;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;

    private Test $test;

    private array $answers;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Test $test, array $answers)
    {
        $this->user = $user;
        $this->test = $test;
        $this->answers = $answers;
    }

    /**
     * Get the value of test
     *
     * @return Test
     */
    public function getTest(): Test
    {
        return $this->test;
    }

    /**
     * Get the value of answers
     *
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * Get the value of user
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
