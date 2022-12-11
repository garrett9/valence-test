<?php

use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $path = storage_path('data/Questions.csv');
        $handle = fopen($path, 'r');
        fgets($handle); // Ignore headers

        $test = new Test();
        $test->name = Test::PERSPECTIVE_TEST;
        $test->display_name = 'Discover Your Perspective';
        $test->description = 'Complete the 7 min test and get a detailed report of your lenses on the world.';
        $test->save();

        $index = 0;
        while ($line = fgets($handle)) {
            $values = explode(',', trim($line));
            $question = new TestQuestion();
            $question->text = $values[0];
            $question->dimension = $values[1];
            $question->direction = $values[2];
            $question->meaning = $values[3];
            $question->order = $index;
            $index++;

            $test->questions()->save($question);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Test::byName(Test::PERSPECTIVE_TEST)->delete();
    }
};
