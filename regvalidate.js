function validate() {
  var inputs = document.getElementsByClassName('input');
  var error = document.getElementById('error');
  for (let i = 0; i < inputs.length; i++){
	  inputs[i].value=inputs[i].value.replace(/^\s+|\s+$/gm,'');
    if(inputs[i].value.length == 0 ){
      error.innerText = "INVALID!! " + inputs[i].getAttribute('placeholder');
      return false;
    }
  }
  if(inputs[2].value.length!=11 ){
    error.innerText = "National Id must be 11 numbers.";
    return false;
  }
  
  //password and confirm password validation
  if(inputs[9].value != inputs[10].value){
    error.innerText = "Password and Confirm Password don't match.";
    return false;
  }
  //email validation
  var email = inputs[3].value;
  if (!(/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(email))) {
    error.innerText = "INVALID Email Format.";
    return false;
  }
}
