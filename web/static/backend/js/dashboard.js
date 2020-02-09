(function($) {
  'use strict';
  if($("#revenue-chart").length) {
    $("#revenue-chart").sparkline('html', {
      enableTagOptions: true,
      width: '100%',
      height: '70',
      fillColor: 'false',
      barWidth: 2,
      barSpacing: 10,
      chartRangeMin: 0
    });
  }
})(jQuery);
