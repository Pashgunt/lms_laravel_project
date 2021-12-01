<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Http\Request;

class ActivitiesTestRepository extends Repositories
{
    public function createActivity(Request $request)
    {
        $data = $request->all();
        $questions = [];

        for ($i = 1; $i <= $data['test_count']; $i++) {
            $questions[] = [
                "question$i" => $data["question$i"],
                "answer1-$i" => $data["answer1-$i"],
                "answer2-$i" => $data["answer2-$i"],
                "answer3-$i" => $data["answer3-$i"],
                "answer4-$i" => $data["answer4-$i"],
                'true-answer' => $data["trueAnswer$i"]
            ];
        }

        $this->create([
            'title' => $request->input('test_title'),
            'about' => $request->input('test_about'),
            'questions' => serialize($questions)
        ]);
    }

    public function getLastId(){
        return $this->model
            ->select('id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
    }
}
