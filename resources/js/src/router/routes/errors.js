const errorRoutes = [
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/error/Error404.vue'),
    meta: {
      layout: 'full',
      loggedIn: null,
    },
  },
  {
    path: '/error-403',
    name: 'error-403',
    component: () => import('@/views/error/Error403.vue'),
    meta: {
      layout: 'full',
      loggedIn: null,
    },
  },
  {
    path: '*',
    redirect: 'error-404',
  },
]
export default errorRoutes
