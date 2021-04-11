$(document).ready(function () {
  $('#search-text').keyup(function (e) {
    $(this).css("background-color", "#e9ad28");
    if ($(this).val() == '') {
      $(this).css("background-color", "white");
      // $('#result').html('');
    }
    var url = "http://hotelmanagement.test/rooms/search";
    console.log('url1: ', url);
    $.ajax({
      type: "GET",
      url: url,
      data: {
        'search': $('input[name="search"]').val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        var html = '';
        html += '<ul class="nav nav-pills nav-stacked search-room">';
        $.each(response, function (item, value) {
          html += '<li class="nav-item">' +
            '<a class="nav-link text-warning text-bold" href="http://hotelmanagement.test/rooms' + '/' + value.id + '">' + value.name + '</a>' +
            '</li>' + '</br>';
        });
        html += '</ul>';

        $('#result').html('');
        $('#result').append(html);
      }
    });
  });
});
