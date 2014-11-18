<?php
  header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
  header( 'Cache-Control: post-check=0, pre-check=0', false ); 
  header( 'Pragma: no-cache' );
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ultimate Optimizer with Diet Problem Solver</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">
    <link href="css/design.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Ultimate Diet Problem Optimizer</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#simplex_method">Simplex Method</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#diet_problem_solver">Diet Problem Solver</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/cake.png" alt="">
                    <div class="intro-text">
                        <span class="name">CMSC 150 Project</span>
                        <hr class="star-light">
                        <span class="skills">Ultimate Optimizer - Diet Problem Solver</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Simplex Method Grid Section -->
    <section id="simplex_method">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Simplex Method</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <!-- start of form-->
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="simplex_method_form" id="simplex_method_form" validate method="post" action = "simplex.php">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Objective Function</label>
                                <input type="text" class="form-control" placeholder="Objective Function" id="obj_function" required data-validation-required-message="Please enter an objective function." name="obj_function">
                                <p class="help-block text-danger" name="of_err"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Constraints (Write one equation per line, separated by a comma)</label>
                                <textarea rows="5" class="form-control" placeholder="Please enter constraint(s), separated by a comma. Enter one equation per line." id="constraints" required data-validation-required-message="Please enter constraint(s)." name="constraints"></textarea>
                                <p class="help-block text-danger" name="c_err"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12">
                                <label>Optimize</label>
                                <div class="radio col-xs-12 floating-label-group controls">
                                    <label>
                                        <input type="radio" name="optimize" id="maximize" value= "0" checked="">
                                        <label><p>Maximize</p></label>
                                    </label>
                                </div>
                                <div class="radio col-xs-12 floating-label-group controls">
                                    <label>
                                        <input type="radio" name="optimize" id="minimize" value="0">
                                        <label><p>Minimize</p></label>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-9">
                                <button type="reset" class="btn btn-default btn-lg " >Clear fields</button>
                                <button type="submit" class="btn btn-success btn-lg pull-right" id="init_submit" name="init_submit">Solve!</button>
                                <p class="help-block text-danger" name="err"></p>

                            </div>
                        </div>
                    </form>
                </div> <!-- end of form-->
            </div>
        </div>
    </section>

    <!-- Diet Solver Section -->
    <section class="success" id="diet_problem_solver">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Diet Problem Solver</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                This is the diet solver section
            </div>
        </div>
    </section>

<?php
  require_once("footer.php");
?>
