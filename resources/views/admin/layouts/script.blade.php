  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('admin/plugins/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/apexchart/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/peity/jquery.peity.min.js') }}"></script>
  <script>
    $(".data-attributes span").peity("donut")
  </script>
  <script src="{{ asset('admin/js/main.js') }}"></script>
  <script src="{{ asset('admin/js/dashboard1.js') }}"></script>
  <script>
	   new PerfectScrollbar(".user-list")
  </script>

    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}         "></script>
  <script src="{{ asset('admin/plugins/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
  <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/js/main.js') }}"></script>


    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}         "></script>
  <script src="{{ asset('admin/plugins/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-tags/js/tagsinput.js') }}"></script>
  <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/js/main.js') }}"></script>

    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}         "></script>
  <script src="{{ asset('admin/plugins/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script>
	  new PerfectScrollbar(".user-list")
  </script>
  <script src="{{ asset('admin/js/main.js') }}  "></script>

  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>

    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bi-eye-slash-fill");
            $('#show_hide_password i').removeClass("bi-eye-fill");
          } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password i').addClass("bi-eye-fill");
          }
        });
      });
    </script>

    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('admin/plugins/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/fullcalendar/js/main.min.js') }}"></script>
   <script>
		document.addEventListener('DOMContentLoaded', function () {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
				},
				initialView: 'dayGridMonth',
				initialDate: '2020-09-12',
				navLinks: true,
				selectable: true,
				nowIndicator: true,
				dayMaxEvents: true,
				editable: true,
				selectable: true,
				businessHours: true,
				dayMaxEvents: true, 
				events: [{
					title: 'All Day Event',
					start: '2020-09-01',
				}, {
					title: 'Long Event',
					start: '2020-09-07',
					end: '2020-09-10'
				}, {
					groupId: 999,
					title: 'Repeating Event',
					start: '2020-09-09T16:00:00'
				}, {
					groupId: 999,
					title: 'Repeating Event',
					start: '2020-09-16T16:00:00'
				}, {
					title: 'Conference',
					start: '2020-09-11',
					end: '2020-09-13'
				}, {
					title: 'Meeting',
					start: '2020-09-12T10:30:00',
					end: '2020-09-12T12:30:00'
				}, {
					title: 'Lunch',
					start: '2020-09-12T12:00:00'
				}, {
					title: 'Meeting',
					start: '2020-09-12T14:30:00'
				}, {
					title: 'Happy Hour',
					start: '2020-09-12T17:30:00'
				}, {
					title: 'Dinner',
					start: '2020-09-12T20:00:00'
				}, {
					title: 'Birthday Party',
					start: '2020-09-13T07:00:00'
				}, {
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2020-09-28'
				}]
			});
			calendar.render();
		});
	</script>
  <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/js/main.js') }}"></script>