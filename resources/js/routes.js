import Home from './components/Home.vue';
import Login from './components/Login.vue';
import NotFound from './components/NotFound.vue';

export default {
    mode: 'history',
    linkActiveClass: 'font-semibold',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home
        },
        {
            path: '/login',
            component: Login
        }
    ]
}