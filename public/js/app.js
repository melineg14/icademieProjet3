// Mobile navbar close ancre
$('.ancre').on('click', function(){
  $('.navbar-collapse').collapse('hide');
});

// Navbar add navbar-collapse-shadow class
$('#main-nav-bar').find('.navbar:has(".in")').addClass('navbar-collapse-shadow');

$('#main-nav-bar').on('shown.bs.collapse', function (e) {
   $(e.target).closest('.navbar').addClass(' navbar-collapse-shadow');
}).on('hidden.bs.collapse', function (e) {
   $(e.target).closest('.navbar').removeClass(' navbar-collapse-shadow');
})