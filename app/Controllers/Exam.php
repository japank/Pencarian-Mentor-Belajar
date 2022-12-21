<?php

namespace App\Controllers;

use App\Models\ExamOptionModel;
use App\Models\ExamQuestionModel;
use App\Models\ExamDetailModel;
use App\Models\ExamQuestionAnswerByUserModel;
use App\Models\ExamUserTakeExamModel;
use App\Models\MentorDetailModel;

class Exam extends BaseController
{
    public function __construct()
    {
        $this->question = new ExamQuestionModel();
        $this->option = new ExamOptionModel();
        $this->exam_detail = new ExamDetailModel();
        $this->exam_question_answer = new ExamQuestionAnswerByUserModel();
        $this->user_take_exam = new ExamUserTakeExamModel();
        $this->mentor_detail = new MentorDetailModel();
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
                'usernow' => $usernow,
                'mentor_detail' => $this->mentor_detail->getMentorDetail($usernow),
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


            $dataExam = $this->exam_detail->find($exam_id);
            $data = [
                'exam_id' => $exam_id,
                'name' => $dataExam->name,
                'level' => $dataExam->level,
                'time' => $dataExam->time
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
                $count = 1;
                $check_length = strlen($row['question_title']);
                if ($check_length < '150') {
                    $output .= '

                    <h3>' . $row["question_title"] . '<h3>
                    <br><br>
                    <div class="row">
                    ';
                } elseif ($check_length > '150' & $check_length < '400') {
                    $output .= '
                    <h4>' . $row["question_title"] . '<h4>
                    <br><br>
                    <div class="row">
                    ';
                } elseif ($check_length > '400' & $check_length < '700') {
                    $output .= '
                    <h5>' . $row["question_title"] . '<h5>
                    <br><br>
                    <div class="row">
                    ';
                } else {
                    $output .= '
                    <h6>' . $row["question_title"] . '<h6>
                    <br><br>
                    <div class="row">
                    ';
                }

                $show_option = $this->option->getOption($row['question_id']);

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

                    if ($check_length < '150') {
                        $output .= '
                        <div class="col-md-6" style="margin-bottom:32px;">
                            <div class="radio">
                                            <label><h4><input type="radio" 
                                            name="option_1" class="answer_option" 
                                            data-question_id="' . $show_option_row['question_id'] . '" 
                                            data-id="' . $count . '" ' . $checked . '
                                            />'   . $show_option_row["option_title"] . '</h4></label>
                        </div></div>';
                    } elseif ($check_length > '150' & $check_length < '400') {
                        $output .= '
                        <div class="col-md-6" style="margin-bottom:32px;">
                            <div class="radio">
                                            <label><h5><input type="radio" 
                                            name="option_1" class="answer_option" 
                                            data-question_id="' . $show_option_row['question_id'] . '" 
                                            data-id="' . $count . '" ' . $checked . '
                                            />'   . $show_option_row["option_title"] . '</h5></label>
                        </div></div>';
                    } else {
                        $output .= '
                        <div class="col-md-6" style="margin-bottom:32px;">
                            <div class="radio">
                                            <label><h6><input type="radio" 
                                            name="option_1" class="answer_option" 
                                            data-question_id="' . $show_option_row['question_id'] . '" 
                                            data-id="' . $count . '" ' . $checked . '
                                            />'   . $show_option_row["option_title"] . '</h6></label>
                        </div></div>';
                    }


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
                $nextorsubmit = 'next';
                $nextorsubmit_text = 'Next';
                $btn = 'btn-info';

                if ($previous_id == '') {
                    $if_prev_disable = 'disabled';
                }

                if ($next_id == '') {
                    $if_next_disable = 'disabled';
                    $nextorsubmit = 'submit';
                    $nextorsubmit_text = 'Submit';
                    $btn = 'btn-warning';
                    $next_id = $exam_id;
                }

                $output .= '
                <br/> <br/>
                <div align="center">
                    <button type="button" name="previous" class="btn btn-info btn-lg previous" id="' . $previous_id . '" ' . $if_prev_disable . '>Previous</button>
                    <button type="button" name="' . $nextorsubmit . '" class="btn ' . $btn . ' btn-lg ' . $nextorsubmit . '" id="' . $next_id . '" >' . $nextorsubmit_text . '</button>
                    <!--<button type="button" name="testing" class="btn btn-info btn-lg testing" id="">testing</button>-->
                
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
                <div class="col-md-2" style="margin-bottom:24px;margin-left:2%">
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
    public function userSubmit()
    {
        if ($this->request->isAJAX()) {
            $username = session()->get('username');
            $exam_id = $this->request->getVar('exam_id');
            $score = $this->exam_question_answer->getTotalScore($username, $exam_id);

            $this->user_take_exam->updateStatus($username, $exam_id, $score);

            $dataExam = $this->exam_detail->find($exam_id);
            $pass_score = $dataExam->pass_score;
            $level = $dataExam->level;

            if ($score >= $pass_score) {
                if ($level == '1') {
                    $this->mentor_detail->updateLevel($username, 1);
                } elseif ($level == '2') {
                    $this->mentor_detail->updateLevel($username, 2);
                } elseif ($level == '3') {
                    $this->mentor_detail->updateLevel($username, 3);
                }
            } else {
            }

            $msg = [
                'sukses' => 'Jawaban  Berhasil di submit'
            ];
            echo json_encode($msg);
        }
    }

    public function submitAnswerWhenTimout()
    {
        if ($this->request->isAJAX()) {
            $username = session()->get('username');
            $exam_id = $this->request->getVar('exam_id');
            $score = $this->exam_question_answer->getTotalScore($username, $exam_id);

            $this->user_take_exam->updateStatus($username, $exam_id, $score);
            $dataExam = $this->exam_detail->find($exam_id);
            $pass_score = $dataExam->pass_score;
            $level = $dataExam->level;

            if ($score >= $pass_score) {
                if ($level == '1') {
                    $this->mentor_detail->updateLevel($username, 1);
                } elseif ($level == '2') {
                    $this->mentor_detail->updateLevel($username, 2);
                } elseif ($level == '3') {
                    $this->mentor_detail->updateLevel($username, 3);
                }
            } else {
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

                $msg = [
                    'data' => view('mentor/empty_exam_result')
                ];


                echo json_encode($msg);
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

            $dataExam = $this->exam_detail->find($exam_id);
            $data = [
                'score' => $this->exam_question_answer->getTotalScore($username, $exam_id),
                'exam_id' => $exam_id,
                'pass_score' => $dataExam->pass_score,
                'name' => $dataExam->name,
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


    // ADMIN
    // //////////////////////////////////////////////////////////////
    public function List()
    {
        return view('admin/exam_list');
    }

    public function loadExamByAdmin()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_exam' => $this->exam_detail->getExamList(),
                'usernow' => $usernow
            ];

            $msg = [
                'data' => view('admin/exam_listajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function detail($exam_id)
    {
        $data = [
            'exam_id' => $exam_id,
            'exam_detail' => $this->exam_detail->getExamTitle($exam_id)
        ];
        return view('admin/exam_detail', $data);
    }

    public function loadExamDetail($exam_id)
    {
        if ($this->request->isAJAX()) {
            $dataExamDetail = $this->exam_detail->getExamDetail($exam_id);
            $dataQuestion = $this->question->getQuestion3($exam_id);
            $usernow = session()->get('username');
            $data = [
                'exam_detail' => $dataQuestion,
                'usernow' => $usernow,
                'option' => $this->option->getAllOption(),
                'exam_id' => $exam_id
            ];

            $msg = [
                'data' => view('admin/exam_detailajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function addQuestion($exam_id)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'exam_id' => $exam_id,
                'exam_detail' => $this->exam_detail->getExamTitle($exam_id)
            ];

            $msg = [
                'data' => view('admin/add_question_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function process($exam_id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'question_title' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option1' => [
                    'label' => 'Option 1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option2' => [
                    'label' => 'Option 2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option3' => [
                    'label' => 'Option 3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option4' => [
                    'label' => 'Option 4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'correct_answer' => [
                    'label' => 'Correct Answer',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'question_title' => $validation->getError('question_title'),
                        'option1' => $validation->getError('option1'),
                        'option2' => $validation->getError('option2'),
                        'option3' => $validation->getError('option3'),
                        'option4' => $validation->getError('option4'),
                        'correct_answer' => $validation->getError('correct_answer'),
                    ]
                ];
            } else {

                $question =  $this->request->getVar('question_title');
                $option1 =  $this->request->getVar('option1');
                $option2 =  $this->request->getVar('option2');
                $option3 =  $this->request->getVar('option3');
                $option4 =  $this->request->getVar('option4');
                $correct_answer =  $this->request->getVar('correct_answer');

                $this->question->insert([
                    'exam_id' => $exam_id,
                    'question_title' => $question,
                    'answer_option' => $correct_answer
                ]);
                $last_insert_id = $this->question->getInsertID();
                $this->option->addOption($exam_id, $last_insert_id, $option1, $option2, $option3, $option4);

                $msg = [
                    'sukses' => 'Tambah Logbook berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function editQuestion()
    {
        if ($this->request->isAJAX()) {

            $dataQuestion = $this->question->find($this->request->getVar('id_question'));

            $dataOption1 = $this->option->find($this->request->getVar('id_option1'));
            $dataOption2 = $this->option->find($this->request->getVar('id_option2'));
            $dataOption3 = $this->option->find($this->request->getVar('id_option3'));
            $dataOption4 = $this->option->find($this->request->getVar('id_option4'));
            $data = [
                'question_title' => $dataQuestion->question_title,
                'answer_option' => $dataQuestion->answer_option,
                'option1' => $dataOption1->option_title,
                'option2' => $dataOption2->option_title,
                'option3' => $dataOption3->option_title,
                'option4' => $dataOption4->option_title,
                'question_id' => $this->request->getVar('id_question'),
                'id_option1' => $dataOption1->id_option,
                'id_option2' => $dataOption2->id_option,
                'id_option3' => $dataOption3->id_option,
                'id_option4' => $dataOption4->id_option,


            ];

            $msg = [
                'sukses' => view('admin/edit_question_modal', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updateQuestion($question_id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'question_title' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option1' => [
                    'label' => 'Option 1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option2' => [
                    'label' => 'Option 2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option3' => [
                    'label' => 'Option 3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'option4' => [
                    'label' => 'Option 4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'correct_answer' => [
                    'label' => 'Correct Answer',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'question_title' => $validation->getError('question_title'),
                        'option1' => $validation->getError('option1'),
                        'option2' => $validation->getError('option2'),
                        'option3' => $validation->getError('option3'),
                        'option4' => $validation->getError('option4'),
                        'correct_answer' => $validation->getError('correct_answer'),
                    ]
                ];
            } else {

                $this->question->update($question_id, [
                    'question_title' =>  $this->request->getVar('question_title'),
                    'answer_option' => $this->request->getVar('correct_answer')
                ]);

                $this->option->update(
                    $this->request->getVar('id_option1'),
                    [
                        'option_title' =>  $this->request->getVar('option1'),
                    ]
                );

                $this->option->update(
                    $this->request->getVar('id_option2'),
                    [
                        'option_title' =>  $this->request->getVar('option2'),
                    ]
                );

                $this->option->update(
                    $this->request->getVar('id_option3'),
                    [
                        'option_title' =>  $this->request->getVar('option3'),
                    ]
                );

                $this->option->update(
                    $this->request->getVar('id_option4'),
                    [
                        'option_title' =>  $this->request->getVar('option4'),
                    ]
                );

                $msg = [
                    'sukses' => 'Data Logbook berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function deleteQuestion()
    {
        if ($this->request->isAJAX()) {

            $question_id = $this->request->getVar('id_question');
            $this->question->delete($question_id);
            $this->option->deleteOption($question_id);
            $msg = [
                'sukses' => 'Data Logbook berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function addExam()
    {
        if ($this->request->isAJAX()) {

            $data = [];

            $msg = [
                'data' => view('admin/add_exam_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function addingExam()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Exam',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'marks_per_right_answer' => [
                    'label' => 'Point Benar',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'marks_per_wrong_answer' => [
                    'label' => 'Point Salah',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'pass_score' => [
                    'label' => 'Skor Kelulusan',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'time' => [
                    'label' => 'Waktu',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name'),
                        'level' => $validation->getError('level'),
                        'marks_per_right_answer' => $validation->getError('marks_per_right_answer'),
                        'marks_per_wrong_answer' => $validation->getError('marks_per_wrong_answer'),
                        'pass_score' => $validation->getError('pass_score'),
                        'time' => $validation->getError('time'),

                    ]
                ];
            } else {
                $this->exam_detail->insert([
                    'name' => $this->request->getVar('name'),
                    'level' => $this->request->getVar('level'),
                    'marks_per_right_answer' => $this->request->getVar('marks_per_right_answer'),
                    'marks_per_wrong_answer' => $this->request->getVar('marks_per_wrong_answer'),
                    'pass_score' => $this->request->getVar('pass_score'),
                    'time' => $this->request->getVar('time'),
                ]);

                $msg = [
                    'sukses' => 'Tambah Exam berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function editExam()
    {
        if ($this->request->isAJAX()) {

            $dataExam = $this->exam_detail->find($this->request->getVar('exam_id'));
            $data = [
                'name' => $dataExam->name,
                'level' => $dataExam->level,
                'marks_per_right_answer' => $dataExam->marks_per_right_answer,
                'marks_per_wrong_answer' => $dataExam->marks_per_wrong_answer,
                'pass_score' => $dataExam->pass_score,
                'time' => $dataExam->time,
                'exam_id' => $dataExam->exam_id
            ];

            $msg = [
                'sukses' => view('admin/exam_edit_modal', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updateExam($exam_id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Exam',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'marks_per_right_answer' => [
                    'label' => 'Point Benar',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'marks_per_wrong_answer' => [
                    'label' => 'Point Salah',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'pass_score' => [
                    'label' => 'Skor Kelulusan',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
                'time' => [
                    'label' => 'Waktu',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} hanya menerima inputan angka'
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name'),
                        'level' => $validation->getError('level'),
                        'marks_per_right_answer' => $validation->getError('marks_per_right_answer'),
                        'marks_per_wrong_answer' => $validation->getError('marks_per_wrong_answer'),
                        'pass_score' => $validation->getError('pass_score'),
                        'time' => $validation->getError('time'),

                    ]
                ];
            } else {
                $this->exam_detail->update($exam_id, [
                    'name' => $this->request->getVar('name'),
                    'level' => $this->request->getVar('level'),
                    'marks_per_right_answer' => $this->request->getVar('marks_per_right_answer'),
                    'marks_per_wrong_answer' => $this->request->getVar('marks_per_wrong_answer'),
                    'pass_score' => $this->request->getVar('pass_score'),
                    'time' => $this->request->getVar('time'),
                ]);

                $msg = [
                    'sukses' => 'Edit Exam berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function deleteExam()
    {
        if ($this->request->isAJAX()) {

            $exam_id = $this->request->getVar('exam_id');
            $this->exam_detail->delete($exam_id);

            $msg = [
                'sukses' => 'Data Exam berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function resultTestAllMentor()
    {
        return view('admin/exam_result_list');
    }
    public function loadExamResultTestAllMentor()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'exam_result' => $this->exam_detail->getExamTakedByAllMentor(),
            ];

            $msg = [
                'data' => view('admin/exam_result_listajax', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
