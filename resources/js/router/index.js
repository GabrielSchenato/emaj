import Vue from 'vue';
import Router from 'vue-router';
import paths from './paths';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

Vue.use(Router);
const router = new Router({
    base: '/',
    mode: 'hash',
    linkActiveClass: 'active',
    routes: paths
});
// router gards
router.beforeEach((to, from, next) => {
    NProgress.start();
    if (to.meta.auth) {
        const token = window.localStorage.getItem('access_token_emaj');
        if (!token) {
            NProgress.done();
        }
    }
    next();
});

router.afterEach((to, from) => {
    NProgress.done();
});

export default router;
