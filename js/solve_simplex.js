window.onload = function(){
  simplex_method_form.init_submit.onclick = solve;
  simplex_method_form.obj_function.onblur =  checkObjFunc;
  simplex_method_form.constraints.onblur =  checkConstraints;
}

 
function checkObjFunc(){
	msg="";
	str=simplex_method_form.obj_function.value;
	if(str=="") msg = "Please enter an objective function.";
	document.getElementsByName('of_err')[0].innerHTML=msg;
	if(str=="") return false;
	else return true;
}

function checkConstraints(){
	msg="";
	str=simplex_method_form.obj_function.value;
	if(str=="") msg = "Please enter constraint(s)";
	document.getElementsByName('c_err')[0].innerHTML=msg;
	if(str=="") return false;
	else return true;
}

function solve(){
	if(checkObjFunc()&&checkConstraints()){
		return true;
	}
	else{
		document.getElementsByName('err')[0].innerHTML="Fill-in inputs.";
		return false;
	}
}
