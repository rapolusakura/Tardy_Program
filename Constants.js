var service = {

  gs_clid: '64846370604-7gnht5k99v2qt9fbrbqsqtka294jjqod.apps.googleusercontent.com', // Enter your API Client ID here
  gs_clis: 'Wpjhj1zvnulizzotjtjXxILW', // Enter your API Client Secret here
  gs_rtok: '1/rPj6l1t7WEg0yEohQwUueJXejRwltVycHxp0_wgdIWah_7vEcj2JM0WvfVlLHFq_'

};

function getCurrentDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }
  today = mm + '-' + dd + '-' + yyyy;
  return today;
}