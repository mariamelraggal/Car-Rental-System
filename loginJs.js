function validate() {
  var inputs = document.getElementsByClassName('input');
  var error = document.getElementById('error');
  for (let i = 0; i < inputs.length; i++) {
    if(inputs[i].value.length == 0){
      error.innerText = "INVALID!! " + inputs[i].getAttribute('placeholder');
      return false;
    }
  }
  //email validation
  var email = inputs[0].value;
  if (!(/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(email))) {
    error.innerText = "INVALID Email Format.";
    return false;
  }
}
