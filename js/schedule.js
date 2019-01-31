var obj;
var outputBuilder = "";
function loaddata()
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     obj = JSON.parse(this.response);
        for(let i =0;i<obj.schedule.length;i++)
            {
                outputBuilder += "<tr><td>"+obj.schedule[i]+"</td>";
                outputBuilder += "<td>"+obj.scheduleDays[i]+"</td></tr>";
            }
        document.getElementById("output").innerHTML = outputBuilder;
    }
  };
  xhttp.open("GET", "results.json", true);
  xhttp.send();

                
            
}
loaddata();