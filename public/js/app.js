var page = 1;
$(window).scroll(function() {
  if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    page++;
    var keyword = getParameterByName('keyword'); //alert(keyword);
    loadMoreData(page,keyword);
  }
});
function loadMoreData(page,keyword){
  var url='?page=' + page;
  if(keyword!==null) 
  {
    url='?keyword='+ keyword +'&page=' + page;
  }

  $.ajax(
  {
    url: url,
    type: "get",
    beforeSend: function()
    {
      $('.ajax-load').show();
    }
  })
  .done(function(data)
  {
    if(data.html == ""){
      $('.ajax-load').html("Đã tải hết dữ liệu!");
      return;
    }
    $('.ajax-load').hide();
    $("#post-data").append(data.html);
  })
  .fail(function(jqXHR, ajaxOptions, thrownError)
  {
    alert('server not responding...');
  });
}
//lay dc keyword tim kiem de truyen vao ajax xu ly thay doi kieu url
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}