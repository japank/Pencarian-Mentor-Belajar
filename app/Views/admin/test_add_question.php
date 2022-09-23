<?= $this->extend('layout/templateMentor') ?>
<?= $this->section('content') ?>
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Add Questions</h1> 
                    </div>
                    <div class="col-6">
                        <div class="text-end upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/" class="btn btn-primary text-white"
                                target="_blank">Upgrade to Pro</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <form method="post" action="<?= site_url('test/add/process'); ?>">
            <p>
                <label>question number : </label>
                <input type="number" name="question_number" />
            </p>
            <p>
                <label>question text : </label>
                <input type="text" name="question_text" />
            </p>
            <p>
                <label>choices #1 : </label>
                <input type="text" name="choice1" />
            </p>
            <p>
                <label>choices #2 : </label>
                <input type="text" name="choice2" />
            </p>
            <p>
                <label>choices #3 : </label>
                <input type="text" name="choice3" />
            </p>
            <p>
                <label>choices #4 : </label>
                <input type="text" name="choice4" />
            </p>
            <p>
                <label>correct choice number </label>
                <input type="number" name="correct_choice" />
            </p>
            <p>
                <input type="submit" name="submit" value="submit" />
            </p>


            </form>
            </div>
<?= $this->endSection() ?>