<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
    <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="https://fastcdn.org/FileSaver.js/1.1.20151003/FileSaver.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.css"/>
</head>
<body>
  <center>
    <br/><br/>
    <form method="GET" action="upload.php">
        <h2>Generate Best by date/Lot# PDF sticker</h2>
		<table>
		  <tr>
            <td><label for="fileSelect">Best before:</label></td>
            <td><input type="text" name="bestbefore" id="bestbefore" placeholder="12/31/2019"/></td>
		  </tr>
		    <td><label for="fileSelect">Lot Number</label></td>
            <td><input type="text" name="lotnumber" id="lotnumber" maxlength="18" placeholder="Max 18 characters"/></td>
		  </tr>
		  <tr>
            <td><input type="submit" id="submit" name="submit" value="Submit"></td>
		  </tr>
		</table>
                <div id="error" style="color:red;"></div></td></tr>
    </form>
    <br/><br/>
  </center>

 <script>
$('#bestbefore').datetimepicker({
       dayOfWeekStart : 1,
       lang:'en',
       format:'m/d/Y',
	   timepicker:false,
       startDate: null
       });

   //form Submit
   $("#submit").click(function(evt){
      evt.preventDefault();
      data_value=$("#bestbefore").val();
      lotnumber=$("#lotnumber").val();
      if(data_value == "")
      {
        $("#error").html("Please enter date");
        return;
      }
      if(lotnumber == "")
      {
        $("#error").html("Please enter lot number");
        return;
      }
      var oReq = new XMLHttpRequest();
      var URLToPDF = 'generate.php?date='+data_value+"&lotnumber="+lotnumber;
      oReq.open("GET", URLToPDF, true);
      oReq.responseType = "blob";
      oReq.onload = function() {
        var file = new Blob([oReq.response], { 
          type: 'application/pdf' 
        });
    
        // Generate file download directly in the browser !
        saveAs(file, "data.pdf");
      };
      oReq.send();
 });
</script>

</body>
</html>
