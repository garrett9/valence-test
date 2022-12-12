<?php

namespace App\Http\Controllers;

use App\Events\TestSubmitted;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class TestsController extends Controller
{
    /**
     * Show the Perspective test on the main page.
     */
    public function show(): InertiaResponse
    {
        // Hard-coded to show the perspective test for now.
        $test = Test::byName(Test::PERSPECTIVE_TEST)
            ->with('questions')
            ->firstOrFail();
        return Inertia::render('Welcome', [
            'test' => $test,
        ]);
    }

    public function submit(Request $request, Test $test)
    {
        $totalQuestions = $test->questions()->count();
        $request->validate([
            'email' => [
                'required',
                Rule::unique('users', 'email'),
                // TODO need to change this Unique rule to one that only checks to see if a test was submitted for this user
            ],
            'answers' => "required|array|size:{$totalQuestions}",
            'answers.*.id' => [
                'distinct',
                'required',
                Rule::exists('test_questions', 'id')->where('test_id', $test->id),
            ],
            'answers.*.value' => [
                'required',
                'min:1',
                'max:7',
            ],
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->save();

        event(new TestSubmitted($user, $test, $request->answers));

        return Redirect::temporarySignedRoute('tests.result', Carbon::now()->addHour(), [
            'test' => $test,
            'user' => $user,
        ]);
    }

    public function results(Request $request, Test $test, User $user)
    {
        if (!$request->hasValidSignature()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $result = UserTest::where([
            'test_id' => $test->id,
            'user_id' => $user->id,
        ])->first();
        if (!$result) {
            return Redirect::route('tests.submit', [
                'test' => $test,
            ]);
        }

        return Inertia::render('Results', [
            'test' => $test,
            'result' => $result,
        ]);
    }
}
