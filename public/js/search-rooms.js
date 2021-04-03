$(document).ready(function () {
  $('#search-text').keyup(function (e) {
    $(this).css("background-color", "#e9ad28");
    if ($(this).val() == '') {
      $(this).css("background-color", "white");
    }
    var url = " {{route('rooms.search')}} ";
    console.log('url: ', url);
    $.ajax({
      type: "GET",
      url: "{{route('rooms.search')}}",
      data: {
        'search': $('input[name="search"]').val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        var html = '';
        $.each(response, function (item, value) {
          html += '<div class="col-md-2"> '
          '<ul>' +
            '<li>' +
            "<a href='{{route('rooms.show', ['id'=> " + value.id + "])}}'>"
            + value.name +
            '</a>' +
            '</li>' +
            '</ul>' +
            '</div>';
        });
        $('#result').html('');
        $('#result').append(html);
        // $("#result").val(response.name);
      }
    });
  });
});
