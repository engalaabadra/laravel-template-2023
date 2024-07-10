import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
const token = document.head.querySelector('meta[name="csrf-token"]').content;
config.headers['X-Socket-ID'] = window.Echo.socketId()

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    // forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    forceTLS: true,
    encryption: true,
   // authEndpoint:'/broadcasting/auth',
    // enabledTransports: ['ws', 'wss'],
    // auth: {
    //     headers: {
    //         Authorization: 'Bearer ' + getToken()
    //     },
    // },
    auth: {
        headers: {
            'Authorization': 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OTY4NWFhZi01YjVjLTQ3NGEtYjgxMC00NzBkMjMyODU0NDMiLCJqdGkiOiI1MGY4Y2M0MDRhYmVjNTVhMTQxY2RiZWM3MWM2ZmRiNzc1ZDZmMGJkZmQ5YTM2ZDQwODI1MGY2N2Q0MjBkMDRkMjFiMzI2NjYwN2RjOGVlYiIsImlhdCI6MTY4NzM3MzQwMy41NjMzMDEsIm5iZiI6MTY4NzM3MzQwMy41NjMzMDMsImV4cCI6MTcxODk5NTgwMy41NTYzMzgsInN1YiI6IjMiLCJzY29wZXMiOltdfQ.FWE9o-QCKl_T9b6kzCBxwEkX_acFyMrd0TmuvKThP8JzLnGWClsmQ2v6HDQUq-cNcZbLagkTQkOE60HlGbosJA01BTopQN8ajZynNP5kjfCmS84LNKrJWQ5zKcCdxqHBac7cf59lfKbYn57ZPp23wnPNMuSgf8s4u_TELNFHY0_OyXt5rc-hiCVrSC0EZfXO7zbx_yyiy3jQ1V0_c-mK7hd7xbZLswueHjJuc7KaAGH7qFO4O3qLShyZPLyyWGhljVi2BuY3jQluVVaQRYR_0sVXahrXh3iCSLUp-ZXBWycUP5-iSHUcosTmWRZeYiBTCQK-3ZB5hrIvJX94avH6d4IPvm7iSkI8hBoPc6QpHHWwmux6Il9WcyXx_eEnw5LHTE7-3dTmw6x9zw1W5A1xDcnvr-LwM999a4-Xmr4tuJIsCQrfXLrcpxYMXmMG9xdukN0oES5lBd-ni_eqJla2W2naU-uD4ug64m1CZMx662Fx0jAJ_34z1Wks4mu4FZBSqZ2Y4u255xZNQtCT9GQq55_px6ZLHnW_dIxPg0ucXUzx546Ui8O0gFcJLwXHgftKzj44YBC2zldOV5qFQ1ugcOFRxzK9jIkH6hJhsakDmvUAxkB0muJlGoxDFmoHkYBV89qZ6q92fCcaeFHLFnnAXP_7lLeCj0NSADlSrXPUGzk'
        }
    }
   
});

// Echo.join('chat.' + roomId)
//     .here((users) => {
//         console.log(users);
//     })
//     .joining((user) => {
//         console.log(user.full_name + ' joined the chat room');
//     })
//     .leaving((user) => {
//         console.log(user.full_name + ' left the chat room');
//     })
//     .listen('MessageSent', (event) => {
//         console.log(event.message);
//     });
// Echo.join('Message.User.5.11')
//     .listen('message.created')