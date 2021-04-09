$(document).ready(function () {
  var url = "admins/manager/comments"
  console.log(url);
  $.ajax({
    type: "GET",
    url: url,
    data: 'data',
    dataType: "json",
    success: function (response) {
      console.log(response);
    }
  });
});