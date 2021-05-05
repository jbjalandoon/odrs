const server = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '/')

script();

function filter(id){
  $.ajax({
    url : 'claimed-requests',
    type: 'get',
    data: {id: id},
    success: function(html){
      $("#content").html(html);
      script();
    }
  });
}

function displayPermissions(id){
  alert(id);
  $.ajax({
    url: 'getPermissions',
    type: 'get',
    data: {id: id},
    success: function(html){
      $(this).html(html);
      script();
    }
  });
}

function script(){
  $('.dataTable').DataTable({
    pageLength: 9,
    dom: 'frtp',
  });

    $(".js-example-responsive").select2({
  });

  $('#type').change(function(){
    var type = 'yearly';
    if ($('#type').val() == 'monthly') {
      type = 'month';
    } else if ($('#type').val() == 'yearly'){
      type = 'text';
    } else {
      type = 'date';
    }
    $('#argument').attr('type', type);
  });

  var adminPendingTable = $('#admin-pending-table').DataTable({
    "columnDefs" : [{
      "targets" : [0],
      "visible" : false,
      "searchable" : false,
    }],
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "dom": '<"row"<"col-6"<"select-pending mb-3">><"col-6"f>>t<"row"<"col-6"<"action-pending mt-3">><"col-6 float-end mt-3"p>>',
    fnInitComplete: function(){
        $('div.select-pending').html('<span class="h2"> Pending Request </span>');
        $('div.action-pending').html('<button id="confirm-request" class="btn btn-primary">Confirm Selected</button>');
      }
  });


   $('#admin-pending-table td').on( 'click', 'tr', function () {
      if($(this).id == 'row'){
        $(this).toggleClass('selected');
      }
   });

   $("#confirm-request").on('click', function(){
     // alert(approvalTable.rows('.selected').data().length);
     const data = [];
     for (var i = 0; i < adminPendingTable.rows('.selected').data().length; i++) {
       data.push(adminPendingTable.rows('.selected').data()[i]);
     }
     // alert(data);
     $.ajax({
       type: "POST",
       data: {data},
       url: "request-confirm",
       success: function(msg){
         // alert(msg);
         // $(".container").html('');
         $("#content").html(msg);
         script();
       },
       error: function (request, error) {
         // console.log(arguments);
         alert(" Can't do because: " + error);
       },
     });
   });

   var onProcessTable = $('#process-table').DataTable({
     "columnDefs" : [{
       "targets" : [0,1],
       "visible" : false,
       "searchable" : false,
     }],
     "bPaginate": true,
     "bLengthChange": false,
     "bFilter": true,
     "bInfo": false,
     "bAutoWidth": false,
     "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 float-end mt-3"p>>',
     fnInitComplete: function(){
         $('div.select').html('<span class="h2"> On Process Documents </span>');
         $('div.action').html('<button id="process-selected" class="btn btn-primary">Process Complete</button>');
       }
   });

    $('#process-table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#admin-pending-table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });

   $("#process-selected").on('click', function(){
     const data = [];
     for (var i = 0; i < onProcessTable.rows('.selected').data().length; i++) {
       data.push(onProcessTable.rows('.selected').data()[i]);
     }
     $.ajax({
       type: "POST",
       data: {data},
       url: "process",
       success: function(msg){
         $("#content").html(msg);
         script();
       },
       error: function (request, error) {
         // console.log(arguments);
         alert(" Can't do because: " + error);
       },
     });
   });

   var approvalTable = $('#approval-table').DataTable({
     "columnDefs" : [{
       "targets" : [0,1],
       "visible" : false,
       "searchable" : false,
     }],
     "bPaginate": true,
     "bLengthChange": false,
     "bFilter": true,
     "bInfo": false,
     "bAutoWidth": false,
     "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 mt-3 float-end"p>>',
     fnInitComplete: function(){
         $('div.select').html('<span class="h2"> Office Approval </span>');
         $('div.action').html('<button id="approve-selected" class="btn btn-primary">Approve</button>');
       }
   });

   $("#approve-selected").on('click', function(){
     // alert(approvalTable.rows('.selected').data().length);
     const data = [];
     for (var i = 0; i < approvalTable.rows('.selected').data().length; i++) {
       data.push(approvalTable.rows('.selected').data()[i]);
     }
     $.ajax({
       type: "POST",
       data: {data},
       url: "approve-request",
       success: function(msg){
         // alert(msg);
         // $(".container").html('');
         $("#content").html(msg);
         script();
       },
       error: function (request, error) {
         // console.log(arguments);
         // alert(" Can't do because: " + error);
       },
     });
   });

   $('#approval-table tbody').on ('click', 'tr', function(){
     $(this).toggleClass('selected');
   });
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

  $(".sideLink").click(function(){
    const page = $(this).children('span').html();
    window.history.pushState('', 'New Page Title', '/admin/' + page.replace(/\s+/g, '-').toLowerCase());
    const url = page.replace(/\s+/g, '-').toLowerCase();
    $.ajax({
      url: url,
      type : 'GET',
      success: function(html){
        $("#content").html(html);
        script();
      }
    });
  }).hover(function(){
    $(this).css('cursor', 'pointer');
  });
});

//for active links
var header = document.getElementById("link");
var list = header.getElementsByClassName("li");

for (var i = 0; i < list.length; i++) {
  list[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}