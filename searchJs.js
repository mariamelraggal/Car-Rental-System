const button = document.getElementById('searchBtn');
const searchId = document.getElementById('live_search');
function searchBtn() {
      var input = searchId.value;
        $.ajax({
          url:"liveSearch.php",
          method:"POST",
          data:{input:input},
          success:function(data) {
            $("#searchResult").html(data);
          }
        });
}
button.addEventListener('click',searchBtn);
