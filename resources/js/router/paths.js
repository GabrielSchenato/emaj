import Login from "@/views/Login.vue";
export default [

  {
    path: '*',
    meta: {
      public: true,
    },
    redirect: {
      path: '/404'
    }
  },  
  {
    path: '/404',
    meta: {
      public: true,
    },
    name: 'NotFound',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/NotFound.vue`
    )
  },
  {
    path: '/403',
    meta: {
      public: true,
    },
    name: 'AccessDenied',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/Deny.vue`
    )
  },
  {
    path: '/500',
    meta: {
      public: true,
    },
    name: 'ServerError',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/Error.vue`
    )
  },
  {
    path: '/login',
    meta: {
      public: true,
    },
    name: 'Login',
    component: Login
  },
  {
    path: '/',
    meta: { auth: true },
    name: 'Root',
    redirect: {
      name: 'Dashboard'
    }
  },
  {
    path: '/dashboard',
    meta: { breadcrumb: true, auth: true },
    name: 'Dashboard',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/Dashboard.vue`
    )
  },
  {
    path: '/cadastros/usuarios',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastros/usuarios',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastros/Usuarios.vue`
    )
  },
  {
    path: '/cadastros/clientes',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastros/clientes',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastros/Clientes.vue`
    )
  },
  {
    path: '/cadastros/tipodemandas',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastros/tipodemandas',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastros/TipoDemandas.vue`
    )
  },
  {
    path: '/cadastros/parametrostriagem',
    meta: { breadcrumb: true, auth: {roles: 'admin', redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastros/parametrostriagem',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastros/ParametrosTriagem.vue`
    )
  },
  {
    path: '/perfil',
    meta: { breadcrumb: true, auth: true },
    name: 'perfil',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/Perfil.vue`
    )
  },
  {
    path: '/movimentos/fichastriagem',
    meta: { breadcrumb: true, auth: true },
    name: 'movimentos/fichastriagem',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/movimentos/FichasTriagem.vue`
    )
  },
];
