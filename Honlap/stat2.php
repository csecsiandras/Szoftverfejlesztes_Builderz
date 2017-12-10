
<?php
?>

 <!doctype HTML>
<HTML>
    <HEAD>
        <title>Stat2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="myStyle.css" type="text/css" >
        <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
        
        <script src="js/star-rating.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- -->
        <script src="https://d3js.org/d3.v4.min.js"></script>
        <!-- -->
    </HEAD>
    
    <BODY style="background-color: darkcyan">
        <ul class="ul1">
            <li class="li1"><a class="active" href="ratings.php">Home</a></li>
            <li class="li1"><a href="stat1.php">Statisztika1</a></li>
            <li class="li1"><a href="stat2.php">Statisztika2</a></li>
            <li class="li2">by Builderz</a></li>
        </ul>
        <div>
            <br><br><br><br>
            <p class="p1">
                A játék értékelésének alakulása
            </p>
            <svg width="960" height="500"></svg>
        </div>


        <script>

var sum=0;
var avg=0;

var svg1 = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 50},
    width = +svg1.attr("width") - margin.left - margin.right,
    height = +svg1.attr("height") - margin.top - margin.bottom,
    g = svg1.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var parseTime = d3.timeParse("%d-%b-%y");

var x = d3.scaleLinear()
    .rangeRound([0, width]);

var y = d3.scaleLinear()
    .rangeRound([height, 0]);

var area = d3.area()
    .x(function(d) { return x(d.id); })
    .y1(function(d) { return y(d.value); });

d3.tsv("myfile.tsv", function(d) {
  d.id = +d.id;
  d.value = +d.value;
  return d;
}, function(error, data) {
  if (error) throw error;

  x.domain([1, d3.max(data, function(d) { return d.id; })]);
  y.domain([0, d3.max(data, function(d) { return d.value; })]);
  
  area.y0(y(0));

  g.append("path")
      .datum(data)
      .attr("fill", "lightcoral")
      .attr("d", area);

  g.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x));        

  g.append("g")
      .call(d3.axisLeft(y))
    .append("text")
      .attr("fill", "#000")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", "0.71em")
      .attr("text-anchor", "end")
      .text("értékelés");
});

</script>
    </BODY>
</HTML>
