<?php
?>

 <!doctype HTML>
<HTML>
    <HEAD>
        <title>Stat1</title>
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
                Az értékelések eloszlása
            </p>
            <svg width="900" height="500"></svg>
        </div>


<script>

var svg2 = d3.select("svg"),
    width = +svg2.attr("width"),
    height = +svg2.attr("height"),
    radius = Math.min(width, height) / 2,
    g = svg2.append("g").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var color = d3.scaleOrdinal(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

var pie = d3.pie()
    .sort(null)
    .value(function(d) { return d.count; });

var path = d3.arc()
    .outerRadius(radius - 10)
    .innerRadius(0);

var label = d3.arc()
    .outerRadius(radius - 40)
    .innerRadius(radius - 40);

d3.csv("myfile2.csv", function(d) {
  d.count = +d.count;
  return d;
}, function(error, data) {
  if (error) throw error;

  var arc = g.selectAll(".arc")
    .data(pie(data))
    .enter().append("g")
      .attr("class", "arc");

  arc.append("path")
      .attr("d", path)
      .attr("fill", function(d) { return color(d.data.star); });

  arc.append("text")
      .attr("transform", function(d) { return "translate(" + label.centroid(d) + ")"; })
      .attr("dy", "0.35em")
      .text(function(d) { return d.data.star; });
});

</script>
    </BODY>
</HTML>