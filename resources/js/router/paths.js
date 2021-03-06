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
    path: '/cadastro/usuarios',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastro/usuarios',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastro/Usuarios.vue`
    )
  },
  {
    path: '/cadastro/clientes',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastro/clientes',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastro/Clientes.vue`
    )
  },
  {
    path: '/cadastro/tipodemandas',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastro/tipodemandas',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastro/TipoDemandas.vue`
    )
  },
  {
    path: '/cadastro/alunos',
    meta: { breadcrumb: true, auth: {roles: ['admin', 'secretaria'], redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastro/alunos',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastro/Alunos.vue`
    )
  },
  {
    path: '/cadastro/parametrostriagem',
    meta: { breadcrumb: true, auth: {roles: 'admin', redirect: {path: 'login'}, forbiddenRedirect: '/403'} },
    name: 'cadastro/parametrostriagem',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/cadastro/ParametrosTriagem.vue`
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
    path: '/movimento/fichatriagens',
    meta: { breadcrumb: true, auth: true },
    name: 'movimento/fichatriagens',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/movimento/FichaTriagens.vue`
    )
  },
  {
    path: '/relatorio/relatividadesprestadas',
    meta: { breadcrumb: true, auth: true },
    name: 'relatorio/relatividadesprestadas',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/relatorio/RelatorioAtividadesPrestadas.vue`
    )
  },
  {
    path: '/relatorio/relprofessoresalunos',
    meta: { breadcrumb: true, auth: true },
    name: 'relatorio/relprofessoresalunos',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/relatorio/RelatorioProfessoresAlunos.vue`
    )
  },
  {
    path: '/relatorio/reldiasperiodosalunos',
    meta: { breadcrumb: true, auth: true },
    name: 'relatorio/reldiasperiodosalunos',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/relatorio/RelatorioDiasPeriodosAlunos.vue`
    )
  },
  {
    path: '/relatorio/relclientesprotocolos',
    meta: { breadcrumb: true, auth: true },
    name: 'relatorio/relclientesprotocolos',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/relatorio/RelatorioClientesProtocolos.vue`
    )
  },
  {
    path: '/alteracoes',
    meta: { breadcrumb: true, auth: true },
    name: 'Alterações',
    component: () => import(
      /* webpackChunkName: "routes" */
      `@/views/Alteracoes.vue`
    )
  },
];
