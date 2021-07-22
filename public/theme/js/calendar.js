(function($) {
  'use strict';
  $(function() {
      function set_calendar() {
          if ($('#calendar').length) {
              $('#calendar').fullCalendar({
                  header: {
                      left: 'prev,next today',
                      center: 'title',
                      // right: 'month,basicWeek,basicDay'
                  },
                  defaultDate: "2020-01-01",
                  navLinks: false, // can click day/week names to navigate views
                  editable: true,
                  eventLimit: true, // allow "more" link when too many events
                  events: [
                      {title: 'Meeting',
                          start: '2020-01-12',
                          end: '2020-01-30'}
                  ]
              })
          }
      }

  });
})(jQuery);
