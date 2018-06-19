var region = document.querySelectorAll("#map .region");

var btns = document.querySelectorAll(".region-link");
region.forEach(function(e) {
  btns.forEach(function(b) {
    if (b.classList.contains("is-active")) {
      b.classList.remove("is-active");
    }
  });
  e.addEventListener("mouseover", function() {
    document.querySelector("#btn-" + e.id).classList.add("is-active");
  });
  e.addEventListener("mouseleave", function() {
    document.querySelector("#btn-" + e.id).classList.remove("is-active");
  });
});

btns.forEach(function(e) {
  e.addEventListener("mouseover", function() {
    var id = e.id.replace("btn-", "");
    e.classList.add("is-active");
    document.querySelector("#" + id + " path").setAttribute("fill", "#c83032");
  });
  e.addEventListener("mouseleave", function() {
    if (e.classList.contains("is-active")) {
      e.classList.remove("is-active");
    }
    var id = e.id.replace("btn-", "");
    document.querySelector("#" + id + " path").setAttribute("fill", "#363333");
  });
});
