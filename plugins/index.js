document.addEventListener("DOMContentLoaded", main);

function main()
{
  document.getElementById("windows").addEventListener("click", showWindows);
  document.getElementById("linux").addEventListener("click", showLinux);
  
  
  var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
} }

function showWindows()
{
  var content = "test";
  console.log(content);

  document.getElementById("content").innerHTML = content;
}

function showLinux()
{

}