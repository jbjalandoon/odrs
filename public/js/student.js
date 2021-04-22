const server = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '/')

$(document).ready(function() {
    $('.data-table').DataTable({
      dom: 'frtp',
    });
});

function showDetail(checkbox){
  if (checkbox.checked == true) {
    document.getElementById('qty-form-'+checkbox.id).disabled = false;

  } else {
    document.getElementById('qty-form-'+checkbox.id).disabled = true;
  }
}


function deleteEntry(id, url){
  $.ajax({
    url: url + '/delete',
    type: 'post',
    data: {
      id: id
    },
    success: function(html){
      $("#content").html(html);
      $('.table').DataTable({
        dom: 'frtp',
      });
    }
  });
}

function addEntry(url){
  window.history.pushState('', 'New Page Title', '/admin/' + url + '/add');
  $.ajax({
    url: url + '/add',
    type: 'get',
    success: function(html){
      $("#content").html(html);
    }
  });
}

function activateUser(id, url){
  $.ajax({
    url: url + '/activate',
    type: 'post',
    data: {
      id: id
    },
    success: function(html){
      // alert(html);
      $("#content").html(html);
      $('.table').DataTable({
        dom: 'frtp',
      });
    }
  });
}

jQuery(function ($) {
  $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }

});



  // $(".sideLink").click(function(){
  //   const page = $(this).children('span').html();
  //   window.history.pushState('', 'New Page Title', '/student/' + page.replace(/\s+/g, '-').toLowerCase());
  //   const url = page.replace(/\s+/g, '-').toLowerCase();
  //   $.ajax({
  //     url: url,
  //     type : 'GET',
  //     success: function(html){
  //       $("#content").html(html);
  //       $('.table').DataTable({
  //         dom: 'frtp',
  //       });
  //     }
  //   });
  // }).hover(function(){
  //   $(this).css('cursor', 'pointer');
  // });
});
