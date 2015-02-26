<?php
  header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
  header( 'Cache-Control: post-check=0, pre-check=0', false ); 
  header( 'Pragma: no-cache' );
  require_once("diet.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Diet Problem Solver</title>

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

    <link rel="shortcut icon" type="image/x-icon" href="img/cake.png" />

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
                <a class="navbar-brand" href="#page-top">Diet Problem Solver</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                         <a href="index.php">Ultimate Optimizer Diet Solver</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#simplex_method">Simplex Method</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Diet Solver Section -->
    <section class="success" id="diet_problem_solver">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br><br><br>
                    <h2>Diet Problem Solver</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">

            <div class="row">
            <?php
                    echo "<div class='col-lg-6 text-center'>";
                    echo "<p>You selected ".sizeof($selected)." foods to consider for your diet.</p>";
                    foreach ($selected as $key => $value) {
                        echo $food_list[$key]['name']."<br>";
                    }
                    echo"</div>";
                if ($feasible == 0){
                    echo "<div class='col-lg-6 text-center'>";
                        echo "<h3>The problem is INFEASIBLE.</h3>";
                        echo "<p>It is not possible to meet the nutritional constraints with the foods that you have selected.</p>";
                        echo "Tableau per iteration can be viewed below.";
                    echo "</div>";
                }else{
                     echo "<div class='col-lg-6 text-center'>";
                        echo "<h3>The Optimized MENU</h3>";
                        echo "<p>The cost of this optimal diet is $".round($values['answer'], 2)." per day.</p>";
                        echo "<table class='table table-striped table-hover'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Food</th>";
                                    echo "<th>Servings</th>";
                                    echo "<th>Cost($)</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                                $ctr = 0;
                                foreach ($values as $key => $value) {
                                    if ($costs[$ctr] > 0) {
                                        echo "<tr class='info'>";
                                        echo "<td>{$key}</td>";
                                        echo "<td>".round($values[$key], 2)."</td>";
                                        echo "<td>".round($costs[$ctr], 2)."</td>";
                                        echo "</tr>";
                                    }
                                    $ctr++;
                                }
                            echo "</tbody>";
                        echo "</table>";
                        echo "Tableau per iteration can be viewed below.";
                        echo "</div>";                  
                }
            ?>
            </div>
<!-- Initial Tableau -->
<div class="row">
    <p>Initial Tableau</p>
</div>
<div class="col-lg-12" style="overflow-y: scroll; height:500px;">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
            <?php
                foreach ($tableau[0][0] as $key => $value) {
                    echo "<th>${key}</th>";
                }
            ?>
        </tr>
      </thead>
      <tbody>
        <?php
            $ctr = 1;
            foreach ($init_tableau as $key => $value) {
                if ($ctr%2==0)
                    echo "<tr class='info'>";
                else
                    echo "<tr class='warning'>";
                if ($ctr == sizeof($init_tableau)) {
                    echo "<tr class='danger'>";
                }

                echo "<td>${ctr}</td>";
                foreach ($init_tableau[$key] as $k => $v) {
                    echo "<td>${v}</td>";
                }
                echo "</tr>";
                $ctr++;
            }
        ?>
      </tbody>
    </table> 
</div>
<!-- end of Initial Tableau -->

<!-- Other Tableau -->
<?php
    $count = 2;
    foreach ($tableau as $idx => $content) {
        echo "<div class='row'>";
            echo "<p>Tableau ${count}</p>";
        echo "</div>";
        echo "<div class='col-lg-12' style='overflow-y: scroll; height:500px;'>";
        echo "<table class='table table-striped table-hover '>";
            echo "<thead>";
                echo "<tr>";
                  echo "<th>#</th>";
                        foreach ($tableau[0][0] as $key => $value) {
                            echo "<th>${key}</th>";
                        }
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                $ctr = 1;
                foreach ($tableau[$idx] as $key => $value) {
                    if ($ctr%2==0)
                        echo "<tr class='info'>";
                    else
                        echo "<tr class='warning'>";
                    if ($ctr == sizeof($init_tableau)) {
                        echo "<tr class='danger'>";
                    }

                    echo "<td>${ctr}</td>";
                    foreach ($tableau[$idx][$key] as $k => $v) {
                        echo "<td>".round($v, 4)."</td>";
                    }
                    echo "</tr>";
                    $ctr++;
                }
            echo "</tbody>";
        echo "</table>";
        echo "</div>";
        $count++;
    }
?>
<!-- end of Other Tableau -->    


            </div>
        </div>
    </section>

<?php
  require_once("footer.php");
?>