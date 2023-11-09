document.addEventListener("DOMContentLoaded", main);

function main()
{
  document.getElementById("windows").addEventListener("click", showWindows);
  document.getElementById("linux").addEventListener("click", showLinux);
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