<?php

namespace App\Controllers;

use App\Models\ExamOptionModel;
use App\Models\ExamQuestionModel;
use App\Models\ExamDetailModel;
use App\Models\ExamQuestionAnswerByUserModel;
use App\Models\ExamUserTakeExamModel;

class Exam extends BaseController
{
    public function __construct()
    {
        $this->question = new ExamQuestionModel();
        $this->option = new ExamOptionModel();
        $this->exam_detail = new ExamDetailModel();
        $this->exam_question_answer = new ExamQuestionAnswerByUserModel();
        $this->user_take_exam = new ExamUserTakeExamModel();
    }

    public function index()
    {
        return view('mentor/exam_list');
    }


    public function loadExam()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_exam' => $this->exam_detail->getExamList(),
                'usernow' => $usernow
            ];

            $msg = [
                'data' => view('mentor/exam_listajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function started($exam_id)
    {
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            $username = session()->get('username');
            $checkedDataAvailable = $this->user_take_exam->where([
                'username' => $username,
                'exam_id' => $exam_id,
            ])->findAll();
            if (empty($checkedDataAvailable)) {
                $this->user_take_exam->insert([
                    'username' => $username,
                    'exam_id' => $exam_id,
                ]);
            }

            $data = [
                'exam_id' => $exam_id,
            ];
            return view('mentor/exam_started', $data);
        } else {
            return view('home');
        }
    }

    public function loadQuestion()
    {
        if ($this->request->isAJAX()) {
            $username = session()->get('username');
            $question_id = $this->request->getVar('question_id');
            $exam_id = $this->request->getVar('exam_id');

            if ($question_id == '') {
                $show_question = $this->question->getQuestion($exam_id);
            } else {
                $show_question = $this->question->getQuestion2($question_id);
            }

            $output = '';
            foreach ($show_question as $row) {
                $output .= '
                    <h1>' . $row["question_title"] . '<h1>
                    <hr />
                    <hr />
                    <div class="row">
                    ';

                $show_option = $this->option->getOption($row['question_id']);

                $count = 1;
                foreach ($show_option as $show_option_row) {

                    $checked = '';
                    $getuseranswer = $this->exam_question_answer->getUserAnswer($username, $exam_id, $show_option_row['question_id']);
                    foreach ($getuseranswer as $p) {
                        $checked = '';
                        if ($p->user_answer_option == $count) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                    }

                    $output .= '
                        <div class="col-md-6" style="margin-bottom:32px;">
                            <div class="radio">
                                            <label><h4><input type="radio" 
                                            name="option_1" class="answer_option" 
                                            data-question_id="' . $show_option_row['question_id'] . '" 
                                            data-id="' . $count . '" ' . $checked . '
                                            />' . $show_option_row["option_title"] . '</h4></label>
                        </div></div>';

                    $count = $count + 1;
                }
                $output .= '
                    </div>';

                $previous_result = $this->question->getIdPrevQuestion($row['question_id'], $exam_id);
                $previous_id = '';
                $next_id = '';
                foreach ($previous_result as $previous_row) {
                    $previous_id = $previous_row['question_id'];
                }

                $next_result = $this->question->getIdNextQuestion($row['question_id'], $exam_id);
                foreach ($next_result as $next_row) {
                    $next_id = $next_row['question_id'];
                }

                $if_prev_disable = '';
                $if_next_disable = '';

                if ($previous_id == '') {
                    $if_prev_disable = 'disabled';
                }

                if ($next_id == '') {
                    $if_next_disable = 'disabled';
                }

                $output .= '
                <br/> <br/>
                <div align="center">
                    <button type="button" name="previous" class="btn btn-info btn-lg previous" id="' . $previous_id . '" ' . $if_prev_disable . '>Previous</button>
                    <button type="button" name="next" class="btn btn-info btn-lg next" id="' . $next_id . '" ' . $if_next_disable . '>Next</button>
                    <button type="button" name="testing" class="btn btn-info btn-lg testing" id="">testing</button>
                
                    </div>
                
                ';
            }
            echo $output;
        }
    }

    public function questionNavigation()
    {
        if ($this->request->isAJAX()) {
            $exam_id = $this->request->getVar('exam_id');
            $fetchIdFromAllQuestion = $this->question->fetchAllQuestionId($exam_id);

            $output = '
            <div class="card">
                <div class="card-header"> Question Navigation</div>
                    <div class="card-body">
                        <div class="row">
            ';

            $count = 1;

            foreach ($fetchIdFromAllQuestion as $row) {
                $output .= '
                <div class="col-md-2" style="margin-bottom:24px;">
                    <button type="button" class="btn btn-primary btn-lg question_navigation"
                        data-question_id = "' . $row['question_id'] . '"> ' . $count . '
                    </button>
                </div>
                ';
                $count = $count + 1;
            }
            $output .= '
                    </div>
                </div>
            </div>
            ';

            echo $output;
        }
    }

    public function userAnswer()
    {
        if ($this->request->isAJAX()) {
            $username = session()->get('username');
            $user_answer_option = $this->request->getVar('answer_option');
            $exam_id = $this->request->getVar('exam_id');
            $question_id = $this->request->getVar('question_id');
            $exam_right_answer_mark = $this->exam_detail->getQuestionRightAnswerMark($exam_id);
            $exam_wrong_answer_mark = $this->exam_detail->getQuestionWrongAnswerMark($exam_id);
            $original_answer = $this->question->getQuestionAnswerOption($question_id);
            $marks = 0;
            if ($original_answer == $user_answer_option) {
                $marks = '+' . $exam_right_answer_mark;
            } else {
                $marks = '-' . $exam_wrong_answer_mark;
            }

            $checkedDataAvailable = $this->exam_question_answer->where([
                'username' => $username,
                'exam_id' => $exam_id,
                'question_id' => $question_id,
            ])->findAll();

            if (empty($checkedDataAvailable)) {
                $this->exam_question_answer->insert([
                    'username' => $username,
                    'exam_id' => $exam_id,
                    'question_id' => $question_id,
                    'user_answer_option' => $user_answer_option,
                    'marks' => $marks,
                ]);
            } else {
                $this->exam_question_answer->updateQuestionAnswer($username, $exam_id, $question_id, $user_answer_option, $marks);
            }
        }
    }

    public function result()
    {
        return view('mentor/exam_result_list');
    }
    public function loadExamResult()
    {
        if ($this->request->isAJAX()) {
            $exam_status = $this->user_take_exam->getStatus();
            if ($exam_status == 'complete') {
                $data = [
                    'exam_result' => $this->exam_detail->getExamTaked(),
                ];

                $msg = [
                    'data' => view('mentor/exam_result_listajax', $data)
                ];


                echo json_encode($msg);
            } else {
                echo "ujian dulu";
            }
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function resultDetail($exam_id)
    {
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            $username = session()->get('username');

            $data = [
                'score' => $this->exam_question_answer->getTotalScore($username, $exam_id),
                'exam_id' => $exam_id,
            ];
            return view('mentor/exam_result_detail', $data);
        } else {
            return view('home');
        }
    }

    public function loadResultDetail($exam_id)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'exam_result' => $this->question->getExamResultDetail($exam_id),
                'option' => $this->option->getAllOption(),

            ];

            $msg = [
                'data' => view('mentor/exam_result_detailajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
