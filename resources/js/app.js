import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


var channel = Echo.private(`App.Models.User.${userID}`);
channel.notification(function(data) {

  alert(JSON.stringify(data));
});