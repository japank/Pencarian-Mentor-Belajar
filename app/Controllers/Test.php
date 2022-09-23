<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\UsersModel;
use App\Models\ChoicesModel;
class Test extends BaseController
{
    public function __construct()
    {
        $this->question = new QuestionModel();
        $this->choices = new ChoicesModel();

    }

    public function index()
    {
        $users = new UsersModel();
        $tes = session()->get('role');
        $data['total_question'] = $this->question->getTotal();
        

                if($tes == 'pendamping'){
					return view('mentor/test', $data);

                } else {
					return view('home');
				}
        
    }

    public function starttest()
    {
        $users = new UsersModel();
        $tes = session()->get('role');
        $data['question'] = $this->question->getQuestion();
        $data['choices'] = $this->choices->getChoices();
        $data['total_question'] = $this->question->getTotal();

                if($tes == 'pendamping'){
					return view('mentor/test_start', $data);

                } else {
					return view('home');
				}
        
    }
    public function process()
    {
        //session_start();
        
        if(!isset($_SESSION['score'])){
            $_SESSION['score']= 0;
        }
        if($_POST){
            $number = $_POST['number'];
            $selected_choice = $_POST['choice'];
            $next = $number+1;
            $prev = $number-1;
            $total= $this->question->getTotal();
            
            foreach ($total as $totalrow) 
            $total2 = $totalrow->total;

            $idnew = $this->choices->getCorrectChoices();
            foreach ($idnew as $id_correct)
            $correct_choice2 = $id_correct->id;
            
            
            
            if($correct_choice2 == $selected_choice){
                $_SESSION['score']++;
            }

            if($number == $total2){
                $data['total_question'] = $total;
                return view('mentor/test_score', $data);
            }else{
                return redirect()->to(site_url('teststart?n='.$next));
            }
        }

        
        
        //return view('tes');
    }

    public function add()
    {
        return view('admin/test_add_question');
    }

    public function addProcess(){
        
    }
}
