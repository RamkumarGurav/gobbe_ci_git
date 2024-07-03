<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="<?=_admin_files_?>js/script.js"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
<script>
    anychart.onDocumentReady(function () {

      // add data
      var data = [
        ["2003", 1, 0, 0],
        ["2004", 4, 0, 0],
        ["2005", 6, 0, 0],
        ["2006", 9, 1, 0],
        ["2007", 12, 2, 0],
        ["2008", 13, 5, 1],
        ["2009", 15, 6, 1],
        ["2010", 16, 9, 1],
        ["2011", 16, 10, 4],
        ["2012", 17, 11, 5],
        ["2013", 17, 13, 6],
        ["2014", 17, 14, 7],
        ["2015", 17, 14, 10],
        ["2016", 17, 14, 12],
        ["2017", 19, 16, 12],
        ["2018", 20, 17, 14],
        ["2019", 20, 19, 16],
        ["2020", 20, 20, 17],
        ["2021", 20, 20, 20],
        ["2022", 20, 22, 20]
      ];

      // create a data set
      var dataSet = anychart.data.set(data);

      // map the data for all series
      var firstSeriesData = dataSet.mapAs({x: 0, value: 1});
      var secondSeriesData = dataSet.mapAs({x: 0, value: 2});
      var thirdSeriesData = dataSet.mapAs({x: 0, value: 3});

      // create a line chart
      var chart = anychart.line();

      // create the series and name them
      var firstSeries = chart.line(firstSeriesData);
      firstSeries.name("Sales");
      var secondSeries = chart.line(secondSeriesData);
      secondSeries.name("Order");
      var thirdSeries = chart.line(thirdSeriesData);
      thirdSeries.name("Purchase");

      // add a legend
      chart.legend().enabled(true);

      // add a title
      chart.title("Weekly Sales Data");

      // specify where to display the chart
      chart.container("cont");

      // draw the resulting chart
      chart.draw();

    });
  </script>
<script>
$(".category-add").click(function () {
$(".tpi-add-category").toggleClass("tpi-add-category-b");
});
$(".tpa-conp-close").click(function () {
$(".tpi-add-category").removeClass("tpi-add-category-b");
});
$(".tpc-cancel").click(function () {
$(".tpi-add-category").removeClass("tpi-add-category-b");
});

$(".tpt-cateogry-edit").click(function () {
$(".tpi-edit-category").toggleClass("tpi-edit-category-b");
});
$(".tpa-conp-close").click(function () {
$(".tpi-edit-category").removeClass("tpi-edit-category-b");
});
$(".tpc-cancel").click(function () {
$(".tpi-edit-category").removeClass("tpi-edit-category-b");
});
</script>
