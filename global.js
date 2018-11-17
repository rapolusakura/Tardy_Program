var isSigningIn = true;

function signInMode() {
  document.getElementById("sign-in").className = "selectedTablink";
  document.getElementById("sign-out").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING IN"
  document.body.style.background = "linear-gradient(to bottom, #1E90FF, #99ddff, #e6e6e6) fixed";
  isSigningIn = true;
  document.getElementById("name").focus();
}

function signOutMode() {
  document.getElementById("sign-out").className = "selectedTablink";
  document.getElementById("sign-in").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING OUT"
  document.body.style.background = "linear-gradient(to bottom, #ffa500, #ffff00, #ffffff) fixed";
  isSigningIn = false;
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