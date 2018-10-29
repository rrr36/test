<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }
?>


<!DOCTYPE html><html>


<head>
  <meta charset="utf-8">
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
  <script>
  // This code depends on jQuery Core and Handlebars.js
function f(){
  var state=document.getElementById('st');
  var loc = state.value;
  alert(loc);
  var resource_url = 'location.php?loc='+ loc;
  $.get(resource_url, function (data) {
      // data: { meta: {<metadata>}, data: {<array[Practice]>} }
      var template = Handlebars.compile(document.getElementById('docs-template').innerHTML);
      document.getElementById('content-placeholder').innerHTML = template(data);
  });
}
  </script>

  <style>
body {
    font-family: ProximaNovaReg, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
h3 {
    color: #bb3794;
}
a {
    text-decoration: none;
}
a, a:visited {
    color: rgb(84, 180, 210);
}
a:hover {
    color: rgb(51,159,192);
}
th {
    text-align: left;
}
td, th {
  padding-right: 20px;
}
  </style>
</head>
<body>
  <form>
<input type=text name="state" id="st" required >State abbrevation
<input type=button onclick="f()">
  </form>
<div id="result">
<h3>BetterDoctor - Doctor Search Results</h3>
<div id="content-placeholder"></div>
<script id="docs-template" type="text/x-handlebars-template">
    <table>
        <thead>
            <th>Name</th>
            <th>Title</th>
            <th>Bio</th>
            <th>Picture</th>
        </thead>
        <tbody>
        {{#data}}
        <tr>
            <td><a href="link.php?lic={{uid}}" target="_new">{{profile.first_name}} {{profile.last_name}}</a><br>
              <img src="{{ratings.0.image_url_small}}"></img></td>
            <td>{{profile.title}}</td>
            <td>{{uid}}</td>
            <td><img src="{{profile.image_url}}"></img></td>
        </tr>
        {{/data}}
        </tbody>
    </table>
</script>
</div>
</body>
</html>
