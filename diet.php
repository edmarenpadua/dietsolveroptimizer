<?php
  header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
  header( 'Cache-Control: post-check=0, pre-check=0', false ); 
  header( 'Pragma: no-cache' );
?>

<?php
    /*
    * gets the variables from equation
    * @params: the equation where variables will be taken
    * @params: array where variables wil be placed
    * returns thea array of variables
    */
    function get_variables($equation_array, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";

        //find the LHS of the equation
        foreach ($equation_array as $key => $value) {
            preg_match_all($regex, $value, $output_array);
            //remove signs in evry term
            foreach ($output_array[2] as $key2 => $value2) {
                $value2 = preg_replace('/\+/', "", $value2);
                $value2 = preg_replace('/\-/', "", $value2);

                //if variable is not yet part of the variable array
                //and variable length > 0, push it to variable array
                if (!in_array($value2, $variable_array)&&strlen($value2)>0)
                    array_push($variable_array, $value2);
            }       
        }
        return $variable_array;
    }

    /*
    * gets the coefficient of a term
    * @params: the equation where variables will be taken
    * @params: array of variables used
    * returns a row vector of coefficients
    */
    function get_coeff($equation, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";
        $value = 1;
        $index = "";
        $coeff = [];
        $row_vector = [];
        
        preg_match_all($regex, $equation, $output_array);
        
        foreach ($output_array[0] as $key => $term) {
            //removes leading "plus" signs
            $term = preg_replace('/\+/', "", $term);
            
            //if number is found(decimal or whole number)
            //identify of there is a negative sign; if yes, negate the coeff
            //retain of positive
            if (preg_match("/[\+\-]?[0-9]*[\.]?[0-9]*/", $term, $match) && strlen($term)>0){
                if (preg_match('/\-/', $match[0], $m)){
                    $match[0] = preg_replace('/\-/', "", $match[0]);
                    $value = -1*$match[0];
                    if (strlen($m[0])==1)
                        $value = -1;
                }   
                else{
                    $value =  1*$match[0];
                    if (strlen($match[0])==0)
                        $value = 1;
                }
            }

            //sets the index of the coeff bases from its literal
            if (strlen($term)>0){
                if (preg_match("/[a-zA-Z]+[0-9]*/", $term, $match)){
                    $index = $match[0];
                }   
                else{
                    $index = "ans";
                }
            }
            $coeff[$index] = $value;
        }

        $ctr = 0;
        while ($ctr != sizeof($variable_array)) {
            array_push($row_vector, 0);
            $ctr++;
        }

        //puts variables to a row vector
        foreach ($variable_array as $k => $v) {
            foreach ($coeff as $i => $c) {
                if ($v == $i)
                    $row_vector[$k] = $c;
                if ($i == "ans")
                    $row_vector[sizeof($variable_array)-1] = $c;
            }
        }

        return $row_vector;
    }


    /*
    * returns an assoc array of basic solution of an eqaution
    * @params: the last column of the tableau
    */
    function get_basic_solution($answers, $row, $col){
        $ctr = sizeof($answers) - $row -1;
        $basic = [];
        $count = 0;

        while ($ctr < $col) {
            $basic[$count] = $answers[$ctr];
            $ctr++;
            $count++;
        }
        return $basic;
    }

    /*
    * returns 1 if there is still a negative element, else 0
    * @params: row vector
    */
    function is_negative($equation){
        foreach ($equation as $key => $value) {
            if($key == sizeof($equation)-1)
                return 0;

            if ($value < 0)
                return 1;
        }
    }

    /*
    * performs gauss jrdan on matrix
    * @params: the matrix of eqautions
    * retuns a pivoted matrix
    */
    function pivot($eq_arr){
        $max = 0;
        $idx = 0;

        //searches for the PIVOT COL from the obj function
        foreach ($eq_arr[sizeof($eq_arr)-1] as $key => $value) {
            if ($value < 0) {
                if (abs($value) > $max) {
                    $max = abs($value);
                    $idx = $key;
               }
            }
        }

        $min_ratio = 1000000000;
        $ratio_indx = 0;

        //searches for the PIVOT ROW
        foreach ($eq_arr as $k => $v) {
            foreach ($eq_arr[$k] as $key => $value) {
                if ($key == $idx && $k != sizeof($eq_arr)-1) {
                    $ans = $eq_arr[$k][sizeof($eq_arr[0])-1];
                   
                    if ($value > 0) {
                        if ($ans/$value < $min_ratio) {
                            $min_ratio = $ans/$value;
                            $ratio_indx = $k;
                       }
                    }
                }
            }
        }

        $pivot_col = $idx;
        $pivot_row = $ratio_indx;

       
        $denumer = $eq_arr[$pivot_row][$pivot_col];

       // echo "<br>PIVOT COL: ".$pivot_col."PIVOT ROW: ".$pivot_row."VALUE: ".$denumer."<br>";
        if ($denumer <= 0) {
            return 0;
        }

        foreach ($eq_arr[$pivot_row] as $key => $value) {
            //normalizes the pivot row
            $eq_arr[$pivot_row][$key] = $value/$denumer;
        }
        //var_dump($eq_arr);

        //implement pivoting
        //curr_row_elem = curr_row_elem - (pivot_col_elem * pivot_row_elem);
        foreach ($eq_arr as $k => $v) {
            $pivot_element = $eq_arr[$k][$pivot_col];
            foreach ($eq_arr[$k] as $key => $value) {
                if ($k != $pivot_row) {
                   $eq_arr[$k][$key] = $value-($pivot_element*$eq_arr[$pivot_row][$key]);
                    $num = $pivot_element;
                }
            }
        }

        return $eq_arr;
        
    }

	//array that will hold the user's selected foods
	$selected = [];
	if(!empty($_POST['food'])) {
		foreach($_POST['food'] as $check) {
			array_push($selected, $check);
		}
	}

	$string = file_get_contents("food_list.json");
	//array that holds the nutritional contents per food
	$food_list=json_decode($string,true);

	//array containing the nutritional constraints
	//min, max, name, var name in json
	$constraints = [
		0 => [2000, 2250, "Calories", "calories"],
		1 => [0, 300, "Cholesterol", "cholesterol"],
		2 => [0, 65, "Total Fat", "t_fat"],
		3 => [0, 2400, "Sodium", "sodium"],
		4 => [0, 300, "Carbohydrates", "carbs"],
		5 => [25, 100, "Dietary Fiber", "d_fiber"],
		6 => [50, 100, "Protein", "protein"],
		7 => [5000, 50000, "Vit A", "vit_A"],
		8 => [50, 20000, "Vit C", "vit_C"],
		9 => [800, 1600, "Calcium", "calcium"],
		10 => [10, 30, "Iron", "iron"]
	];

	//creates the objective function
	$obj_function = "";
	foreach ($selected as $k => $v) {
		$obj_function .= $food_list[$v-1]["ppserving"]."f".$k. "+";
	}

	$obj_function = "z=".substr($obj_function, 0, strlen($obj_function)-1);

	//echo $obj_function;

	//constraints_array
	$arr_constraints = [];

	//constraints for number of servings
	foreach ($selected as $k => $v) {
		array_push($arr_constraints, "f".$k.">=0");
		array_push($arr_constraints, "f".$k."<=10");
	}
	

	$min = "";
	$max = "";
	$eq = "";

	//nutritional constraints
	foreach ($constraints as $key => $value) {
		$nutrient = $constraints[$key][3];
		foreach ($selected as $k => $v) {
			$eq .= $food_list[$v-1][$nutrient]."f".$k."+";
		}
		$min = substr($eq, 0, strlen($eq)-1).">=".$constraints[$key][0];
		$max = substr($eq, 0, strlen($eq)-1)."<=".$constraints[$key][1];

		array_push($arr_constraints, $min);
		array_push($arr_constraints, $max);
		$eq="";
	}
    //var_dump($arr_constraints);
	//gets variables
	$variable_arr =[];

	//dumt array for obj function
	$arr = [];
	array_push($arr, $obj_function);

	$variable_arr = get_variables($arr_constraints, $variable_arr);
	$variable_arr = get_variables($arr, $variable_arr);


    //matrix for  tableau
    $matrix = [];
    foreach ($arr_constraints as $a => $b) {
        $matrix[$a] = get_coeff($arr_constraints[$a], $variable_arr);
        if ($a%2==1) {
            foreach ($matrix[$a] as $k => $v) {
                $matrix[$a][$k] = -1*$v;
            }
        }
    }
    $matrix[sizeof($arr_constraints)]=get_coeff($arr[0], $variable_arr);

    //create the transpose matrix
    $transpose_matrix = [];
    $row_ctr = $col_ctr = 0;
    $row_len = sizeof($matrix);
    $col_len = sizeof($variable_arr);

    while ($col_ctr < $col_len) {
        $row_v = [];
        $row_ctr = 0;
        while ($row_ctr < $row_len) {
            array_push($row_v, $matrix[$row_ctr][$col_ctr]);
            $row_ctr++;
        }
        $transpose_matrix[$col_ctr] = $row_v;
        $col_ctr++;
    }

    //Introduce slack variables to the transpose 
    $count = 0;
    while($count < $col_len){
        foreach ($transpose_matrix as $a => $b) {
            $l = sizeof($transpose_matrix[$a]);
            $rhs_value = $transpose_matrix[$a][$l-1];
            if ($a == $count)
                $transpose_matrix[$a][$l-1] = 1;
            else $transpose_matrix[$a][$l-1] = 0;
            $transpose_matrix[$a][$l] = $rhs_value;
        }
        $count++;
    }

    //force the RHS of the objective function to be 0
    $rows = sizeof($transpose_matrix);
    $cols = sizeof($transpose_matrix[0]);
    $transpose_matrix[$rows-1][$cols-1] = 0;

    foreach ($transpose_matrix[$rows-1] as $last => $val) {
        if ($last != $cols-2) {
            $transpose_matrix[$rows-1][$last] = $val*-1;
        }
    }
    //get initial tableau and basic solution
    $init_tableau = $transpose_matrix;
    
    $tableau = [];
    $basic_sol = [];
    $count = 0;
    $feasible = 1;


    //echo sizeof($transpose_matrix)-1;
    //get tableau and basic sol for other rows
    while(is_negative($transpose_matrix[sizeof($transpose_matrix)-1])){
    //while($count < 10){
        $p =  pivot($transpose_matrix);
        if ($p == 0) {
            $feasible = 0;
            break;
        }
        else $transpose_matrix = $p;
        $tableau[$count] =  $transpose_matrix;
        //$basic_sol[$count] = get_basic_solution($transpose_matrix, $variable_array);
        $count++;
    }

    $values= [];
    $costs = [];

    if ($feasible == 1) {
        $basic_sol = get_basic_solution($transpose_matrix[$rows-1], $rows, $cols);
        $ctr = sizeof($basic_sol);
        echo $ctr;
        foreach ($basic_sol as $key => $value) {
            if ($key < $ctr-2){
                $values[$food_list[$key]['name']] = $value;
                $costs[$key] = $food_list[$key]['ppserving']*$value;
            }
            else if ($key == $ctr-1){
                $values["answer"] = $value;
                $costs[$key-1] = 0;
            }
        }
    }
?>