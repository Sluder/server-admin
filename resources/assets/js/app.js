
require('./bootstrap');
require('chart.js');


// ---------- Broadcasting ----------
import Echo from "laravel-echo";

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '4462fe93b06d03e412be',
    cluster: 'us2',
    encrypted: true
});

