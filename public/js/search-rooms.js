$(document).ready(function () {
  $('#search-text').keyup(function (e) {
    $(this).css("background-color", "#e9ad28");
    if ($(this).val() == '') {
      $(this).css("background-color", "white");
    }
    var url = "rooms/search";
    console.log('url: ', url);
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
        $.each(response, function (item, value) {
          // html+='<div class="col-md-2"> '+value.name+'</div>';
          // });
          // html += '<div class="col-md-2">' + '<ul class="nav nav-pills nav-stacked anyClass">' + '<li class="nav-item">'
          //   + '</li>'+ '</ul>'+ '</div>';
          html +=
            '<div class="col-md-2">'
            + '<ul class="nav nav-pills nav-stacked" style=" height:150px; overflow-y: scroll;">'
            + '<li class="nav-item">'
            + '<a class="nav-link" href="rooms/' + value.id + '">'
            + value.name
            + '</a>'
            + '</li>'
            + '</ul>'
            + '</div>';
        });
        $('#result').html('');
        $('#result').append(html);
      }
    });
  });
});
