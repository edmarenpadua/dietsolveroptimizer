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

    <link rel="shortcut icon" type="image/x-icon" href="img/cake.png" />

<script>
    function toggle() {
        checkboxes = document.getElementsByName('food[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = true;
        }
    }
</script>

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
                <div class="col-sm-2"></div>
                <img class="img-responsive col-sm-2" src="img/ultimate.png" alt="">
                <img class="img-responsive col-sm-2" src="img/diet.png" alt="">
                <img class="img-responsive col-sm-2" src="img/problem.png" alt="">
                <img class="img-responsive col-sm-2" src="img/optimizer.png" alt="">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <br><br><br>
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
                                        <input type="radio" name="optimize" id="minimize" value="1">
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
<form name="diet_solver_form" id="diet_solver_form" validate method="post" action = "diet_solver.php">
<div class ="col-sm-10" >
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_1" value="1">
                 Frozen Broccoli
                <img src="img/food_items/01_frozen_broccoli.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_2" value="2">
                Carrots, Raw
                <img src="img/food_items/02_carrots.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_3" value="3">
                Celery, Raw
                <img src="img/food_items/03_celery.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_4" value="4">
                Frozen, Corn
                <img src="img/food_items/04_corn.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_5" value="5">
                Lettuce, Iceberg, Raw
                <img src="img/food_items/05_lettuce.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_6" value="6">
                Peppers, Sweet, Raw
                <img src="img/food_items/06_pepper.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_7" value="7">
                Potatoes, Baked
                <img src="img/food_items/07_baked_potato.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_8" value="8">
                Tofu
                <img src="img/food_items/08_tofu.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_9" value="9">
                Roasted Chicken
                <img src="img/food_items/09_roasted_chicken.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_10" value="10">
                Spaghetti with Sauce
                <img src="img/food_items/10_spaghetti.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_11" value="11">
                Tomato, Red, Ripe, Raw
                <img src="img/food_items/11_tomato.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_12" value="12">
                Apple, Raw, with Skin
                <img src="img/food_items/12_apple.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_13" value="13">
                Banana
                <img src="img/food_items/13_banana.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_14" value="14">
                Grapes
                <img src="img/food_items/14_grapes.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_15" value="15">
                Kiwifruit, Raw, Fresh
                <img src="img/food_items/15_kiwi.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_16" value="16">
                Oranges
                <img src="img/food_items/16_oranges.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_17" value="17">
                Bagels
                <img src="img/food_items/17_bagels.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_18" value="18">
                Wheat Bread
                <img src="img/food_items/18_wheat_bread.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_19" value="19">
                White Bread
                <img src="img/food_items/19_white_bread.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_20" value="20">
                Oatmeal Cookies
                <img src="img/food_items/20_oatmeal_cookies.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_21" value="21">
                Apple Pie
                <img src="img/food_items/21_apple_pie.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_22" value="22">
                Chocolate Chip Cookies
                <img src="img/food_items/22_cchip_cookies.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_23" value="23">
                Butter, Regular
                <img src="img/food_items/23_butter.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_24" value="24">
                Cheddar Cheese
                <img src="img/food_items/24_cheddar_cheese.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_25" value="25">
                3.3% Fat, Whole Milk
                <img src="img/food_items/25_wholefat_milk.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_26" value="26">
                2% Lowfat Milk
                <img src="img/food_items/26_lowfat_milk.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_27" value="27">
                Skim Milk
                <img src="img/food_items/27_skim_milk.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_28" value="28">
                Poached Eggs
                <img src="img/food_items/28_poached_eggs.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_29" value="29">
                Scrambled Eggs
                <img src="img/food_items/29_scrambled_eggs.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_30" value="30">
                Bologna, Turkey
                <img src="img/food_items/30_b_turkey.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_31" value="31">
                Frankfurter, Beef
                <img src="img/food_items/31_f_beef.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_32" value="32">
                Ham, Sliced, Extra lean
                <img src="img/food_items/32_ham.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_33" value="33">
                Kielbasa, Pork
                <img src="img/food_items/33_k_pork.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_34" value="34">
                Cap'n Crunch
                <img src="img/food_items/34_capn_crunch.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_35" value="35">
                Cheerios
                <img src="img/food_items/35_cheerios.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_36" value="36">
                Corn Flakes, Kellog's
                <img src="img/food_items/36_corn_flakes.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_37" value="37">
                Raisin Bran, Kellog's
                <img src="img/food_items/37_raisin_bran.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_38" value="38">
                Rice Krispies, Kellog's
                <img src="img/food_items/38_rice_krispies.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_39" value="39">
                Special K, Kellog's
                <img src="img/food_items/39_special_k.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_40" value="40">
                Oatmeal
                <img src="img/food_items/40_oatmeal.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_41" value="41">
                Malt-O-Meal, Chocolate
                <img src="img/food_items/41_malt_meal.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_42" value="42">
                Pizza with Pepperoni
                <img src="img/food_items/42_pizza.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_43" value="43">
                Taco
                <img src="img/food_items/43_taco.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_44" value="44">
                Hamburger with Toppings
                <img src="img/food_items/44_hamburger.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_45" value="45">
                Hotdog, Plain
                <img src="img/food_items/45_hotdog.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_46" value="46">
                Couscous
                <img src="img/food_items/46_couscous.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_47" value="47">
                White Rice
                <img src="img/food_items/47_white_rice.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_48" value="48">
                Macaroni, Ckd
                <img src="img/food_items/48_macaroni.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_49" value="49">
                Peanut Butter
                <img src="img/food_items/49_peanut_butter.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_50" value="50">
                Pork
                <img src="img/food_items/50_pork.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_51" value="51">
                Sardines in Oil
                <img src="img/food_items/51_sardines.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_52" value="52">
                White Tuna in Water
                <img src="img/food_items/52_tuna.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_53" value="53">
                Popcorn, Air-popped
                <img src="img/food_items/53_popcorn.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_54" value="54">
                Potato Chips, Bbq Flavor
                <img src="img/food_items/54_potato_chips.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_55" value="55">
                Pretzels
                <img src="img/food_items/55_pretzels.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_56" value="56">
                Tortilla Chip
                <img src="img/food_items/56_tortilla_chip.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_57" value="57">
                Chicken Noodle Soup
                <img src="img/food_items/57_chicken_ns.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_58" value="58">
                Split Pea and Hamsoup
                <img src="img/food_items/58_sp_soup.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_59" value="59">
                Vegebeef Soup
                <img src="img/food_items/59_vegebeef_soup.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_60" value="60">
                New England Clam Chowder
                <img src="img/food_items/60_clam_chowder.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_61" value="61">
                Tomato Soup
                <img src="img/food_items/61_tomato_soup.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_62" value="62">
                New Eng. Clam Chowder, with Milk
                <img src="img/food_items/62_clam_chowder_milk.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_63" value="63">
                Corn Mushroom Soup with Milk
                <img src="img/food_items/63_corn_mushroom.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
    <div class="col-sm-3 food-item">
        <div class="checkbox">
        <label>
            <input type="checkbox" name="food[]" id="food_64" value="64">
                Beanbacon Soup with Water
                <img src="img/food_items/64_bean_bacon_soup.png" class="img-responsive" alt="">
            </label>
        </div>
    </div>
</div>

<div class="col-sm-2 btn-group-vertical btn-lg sticky">
    <a class="btn btn-primary" onClick="toggle()">
         Toggle all
    </a>
    <br/>
    <button type="reset" class="btn btn-danger">
         Clear all
    </button>
    <br/>
    <button type="submit" class="btn btn-primary">
        Gimme mah diet!
    </button>
</div>
</form>
            </div>
        </div>
    </section>

<?php
  require_once("footer.php");
?>
