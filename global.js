var isSigningIn = true;

function getLinearGradient(s) {
  switch (s) {
    case "Dougherty Valley High School":
      return "linear-gradient(to bottom, #1E90FF, #99ddff, #e6e6e6) fixed";
      break;
    case "Monte Vista High School":
      return "linear-gradient(to bottom right, #ffffff, #ffb3b3, #ff1a1a, #800000) fixed";
      break;
    case "San Ramon Valley High School":
      return "linear-gradient(to bottom right, #ffff99, #ffff66, #009900, #1a3300) fixed";
      break;
    case "California High School":
      return "linear-gradient(to bottom right, #fff0e6, #ff751a, #1a0a00) fixed";
      break;
    default:
      return "linear-gradient(to bottom, #f2f2f2, #e6e6e6, #2d862d, #01458c) fixed";
  }
}

function signInMode(school) {
  document.getElementById("sign-in").className = "selectedTablink";
  document.getElementById("sign-out").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING IN"
  document.body.style.background = getLinearGradient(school);
  isSigningIn = true;
  document.getElementById("self-promo").style.color = "#e6e6e6";
  document.getElementById("name").focus();
}

function signOutMode() {
  document.getElementById("sign-out").className = "selectedTablink";
  document.getElementById("sign-in").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING OUT"
  document.body.style.background = "linear-gradient(to bottom, #ffa500, #ffff00, #ffffff) fixed";
  isSigningIn = false;
  document.getElementById("self-promo").style.color = "black";
  document.getElementById("name").focus();
}

document.getElementById('name').onkeydown = function(event) {
  if (event.keyCode == 13) {
    if (isSigningIn) {
      signIn();
    } else {
      signOut();
    }
  }
};