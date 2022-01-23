function validate() {
  var inputs = document.getElementsByClassName('input');
  var error = document.getElementById('error');
  for (let i = 0; i < inputs.length; i++) {
	  inputs[i].value=inputs[i].value.replace(/^\s+|\s+$/gm,'');
    if(inputs[i].value.length == 0){
      error.innerText = "INVALID!! " + inputs[i].getAttribute('placeholder');
      return false;
    }
  }
}
