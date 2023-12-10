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
} 
}

function showWindows()
{
  document.getElementById("opsys").style.display = "none";
  document.getElementById("wcontent").style.display = "block";
  document.getElementById("w16").style.display = "none";
  document.getElementById("wParallel").style.display = "none";
}

function showW301()
{
  document.getElementById("wcontent").style.display = "none";
  document.getElementById("w301").style.display = "block";
  document.getElementById("w16").style.display = "none";
  document.getElementById("wParallel").style.display = "none";

}

function showW16()
{
  document.getElementById("wcontent").style.display = "none";
  document.getElementById("w301").style.display = "none";
  document.getElementById("w16").style.display = "block";
  document.getElementById("wParallel").style.display = "none";
}

function showWParallel()
{
  document.getElementById("wcontent").style.display = "none";
  document.getElementById("w301").style.display = "none";
  document.getElementById("w16").style.display = "none";
  document.getElementById("wParallel").style.display = "block";
}

function showLinux()
{
  document.getElementById("opsys").style.display = "none";
  document.getElementById("lcontent").style.display = "block";
  document.getElementById("l16").style.display = "none";
  document.getElementById("lParallel").style.display = "none";
}

function showL301()
{
  document.getElementById("lcontent").style.display = "none";
  document.getElementById("l301").style.display = "block";
  document.getElementById("l16").style.display = "none";
  document.getElementById("lParallel").style.display = "none";

}

function showL16()
{
  document.getElementById("lcontent").style.display = "none";
  document.getElementById("l301").style.display = "none";
  document.getElementById("l16").style.display = "block";
  document.getElementById("lParallel").style.display = "none";
}

function showLParallel()
{
  document.getElementById("lcontent").style.display = "none";
  document.getElementById("l301").style.display = "none";
  document.getElementById("l16").style.display = "none";
  document.getElementById("lParallel").style.display = "block";
}