<?php

namespace App\Listeners;

use App\Events\TestSubmitted;
use App\Models\TestQuestion;
use Illuminate\Support\Collection;

class ProcessTestResults
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TestSubmitted $event)
    {
        $answers = new Collection($event->getAnswers());
        $questions = TestQuestion::whereIn('id', $answers->pluck('id'))->get()->groupBy('id');

        $scores = [];
        foreach (['EI', 'SN', 'TF', 'JP'] as $dimension) {
            $scores[$dimension] = [
                'count' => 0,
                'value' => 0,
            ];
        }

        foreach ($answers as $answer) {
            $question = $questions[$answer['id']]->first();
            $value = (int) $answer['value'];
            $dimension = $question->dimension;
            $direction = $question->direction;

            if ($direction < 0) {
                // Reverse the value since the direction goes the other way.
                // Mod 8 because the max value is 7. That means a value of 7
                // is reversed to a value of 1.
                $value = 8 % $value;
            }

            $scores[$dimension]['value'] += $value;
            $scores[$dimension]['count']++;
        }

        $results = [];
        foreach ($scores as $dimension => $score) {
            $results[$dimension] = $score['count'] > 0 ? round($score['value'] / $score['count'], 1) : 0;
        }

        $answers = $answers->map(function (array $values) {
            return [
                'test_question_id' => $values['id'],
                'value' => $values['value'],
            ];
        });

        $event->getUser()->tests()->attach($event->getTest(), [
            'results' => $results,
            'answers' => $answers,
        ]);
    }
}
