const { default: axios } = require('axios');

window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// interceptando as requests
axios.interceptors.request.use(
    config => {
        // config.headers = {
        //     'Authorization': this.token,
        //     'Accept': 'application/json'
        // }
        let token = document.cookie.split(';').find(indice => {
            return indice.includes('token=');
        })

        token = token.split('=')[1];
        token = 'Bearer ' + token;


        config.headers.Authorization = token;
        config.headers.Accept = 'application/json';
        return config
    },
    error => {
        return Promise.reject(error)
    }
)

// interceptando as reponses
axios.interceptors.response.use(
    response => {
        return response
    },
    error => {
        return Promise.reject(error)
    }
)
