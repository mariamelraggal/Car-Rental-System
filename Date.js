
function validate() {
  var start = document.getElementById('start');
  var end = document.getElementById('end');
  var error = document.getElementById('error');
 var now = new Date();
  var target = new Date(start.value);
 if(end.value < start.value){
	  error.innerText = "Return date must be after Pickup date";
  return false;
 }

    if (target.getFullYear() > now.getFullYear())
    {
        return true;
    }
    else if(target.getFullYear() == now.getFullYear())
    {
    if (target.getMonth() < now.getMonth()) {
    return true;
    }
    else if(target.getMonth() == now.getMonth())
    {
    if (target.getDate() >= now.getDate()) {
        return true;
    }
    else
    {
		error.innerText = "Pickup date cannot be in the past";
        return false;
    }
	}
	}
	
}
