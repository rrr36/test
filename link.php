<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=login.html", true, 303);
 }
?>
<!DOCTYPE html>
<html>


<head>
<meta charset="utf-8">

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
  <script type="text/javascript" >
  var uid ="<?php $uid = $_GET['lic']; echo $uid;?>";
  var resource_url = 'uid.php?uid='+ uid;
  $.get(resource_url, function(data) {
          /* data will hold the php array as a javascript object */
          var template = Handlebars.compile(document.getElementById('doc-template').innerHTML);
          document.getElementById('content-placeholder').innerHTML = template(data);
  });

  function f(){
  var name = "<?php $name = $_GET['name']; echo $name;?>";
  var d = document.getElementById('date');
  var date = d.value;
  var url='http://localhost/tobevisited.php?name='+name + '&uid=' + uid + '&date=' + date + '&type=add';
window.open(url);
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
.address {
    font-size: 0.8em;
    color: #888;
}
#contact{
  display:none;
}
form{
  display:block;
  padding-top: 5%;
}
#mainNav {
    background-color: #f05f40;
}
#content-placeholder{
  padding-top:5%;
}
  </style>
</head>

<body>

<div id="content-placeholder"></div>
<script id="doc-template" type="text/x-handlebars-template">

<h3 id="name">BetterDoctor - {{data.profile.first_name}} {{data.profile.last_name}}, {{data.profile.title}}</h3>
    <p class="address">

    </p>
    <p class="bio">{{data.profile.dynamic_bio}}</p>
    <table>
        <tr>

            <td><a href="{{data.attribution_url}}" target="_new">{{data.attribution_url}}</a></td>
        </tr>
        <tr>
            <th>Picture</th>
            <td><img src="{{data.profile.image_url}}"></img></td>
        </tr>
        <tr>
            <th>Specialties</th>
            <td>
            {{#data.specialties}}
            {{name}}<br>
            {{/data.specialties}}
            </td>
        </tr>


<tr>
      {{#data.practices}}

          <th>Practice</th>
      <td>{{name}}<br></td>

      <th>Address</th>
      <td>{{visit_address.street}}<br>
      {{visit_address.city}}, {{visit_address.state}} {{visit_address.zip}}</td>


      <th>Contact</th>
      {{#phones}}

      <td>{{number}}-{{type}}</td>
      {{/phones}}

</tr>

    {{/data.practices}}

<tr>
  {{#data.insurances}}
  <th>Insurance name<th>
    <td>{{insurance_plan.name}}
</tr>
  {{/data.insurances}}
    <tr>
      <td><input type=text placeholder="yyyy-dd-mm 00:00:00" id="date">Enter Date</td>
      <td><input type=button value="Schedule" id="b" onclick="f()"></td>
      <td><a href="favdoc.php?uid={{data.uid}}&type=add">Favourite</td>
    </tr>
    </tbody>
    </table>
</script>
</body>


</html>
