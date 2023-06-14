const mainRoutes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/Home.vue'),
    meta: {
      pageTitle: 'Profile',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
      ],
    },
  },
  {
    path: '/achievements',
    name: 'achievements',
    component: () => import('@/views/Achievements.vue'),
    meta: {
      pageTitle: 'Osiągnięcia',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
        {
          text: 'Osiągnięcia',
          active: false,
        },
      ],
    },
  },
  {
    path: '/test/categories',
    name: 'test.categories',
    component: () => import('@/views/Test/Categories.vue'),
    meta: {
      pageTitle: 'Kategorie testów',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
        {
          text: 'Lista Testów',
          active: false,
        },
      ],
    },
  },
  {
    path: '/test/:test_number',
    name: 'test.show',
    component: () => import('@/views/Test/Test.vue'),
    meta: {
      pageTitle: 'Test',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
        {
            text: 'Lista Testów',
            active: false,
            to: '/test/categories'
        },
        {
          text: 'Test',
          active: false,
        },
      ],
    },
  },
  {
    path: '/repeat/categories',
    name: 'repeat.categories',
    component: () => import('@/views/Repeat/Categories.vue'),
    meta: {
      pageTitle: 'Kategorie powtórek',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: false,
        },
        {
          text: 'Powtórki',
          active: false,
        },
        {
          text: 'Kategorie',
          active: true,
        },
      ],
    },
  },
  {
    path: '/repeat/:category_name',
    name: 'repeat',
    component: () => import('@/views/Repeat/Show.vue'),
    meta: {
      pageTitle: 'Powtórka',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: false,
        },
        {
          text: 'Powtórka',
          active: true,
        },
      ],
    },
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/Login.vue'),
    meta: {
      layout: 'full',
      pageTitle: '',
      loggedIn: false,
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
      ],
    },
  },
  {
    path: '/forgot_password',
    name: 'forgotPassword',
    component: () => import('@/views/ForgotPassword.vue'),
    meta: {
      layout: 'full',
      pageTitle: '',
      loggedIn: false,
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },

      ],
    },
  },
  {
    path: '/register',
    name: 'register',
    component: () =>
      import ('@/views/register.vue'),
    meta: {
      layout: 'full',
      pageTitle: '',
      loggedIn: false,
      breadcrumb: [{
        text: 'Me',
        active: true,
      }],
    },
  },
  {
    path: '/ranking',
    name: 'ranking',
    component: () => import('@/views/Ranking.vue'),
    meta: {
      pageTitle: 'Ranking',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Ranking',
          active: false,
        },
      ],
    },
  },
  {
    path: '/change_avatar',
    name: 'change_avatar',
    component: () => import('@/views/Change_avatar.vue'),
    meta: {
      pageTitle: 'Avatar',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
        {
          text: 'Awatar',
          active: true,
        },
      ],
    },
  },
  {
    path: '/profil',
    name: 'profil',
    component: () => import('@/views/Profil.vue'),
    meta: {
      pageTitle: 'Profile',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Me',
          active: true,
        },
        {
          text: 'Profil',
          active: true,
        },
      ],
    },
  },
  {
    path: '/dictionary',
    name: 'dictionary',
    component: () => import('@/views/Dictionary/Dictionary.vue'),
    meta: {
      pageTitle: 'Słownik',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Słownik',
          active: false,
        },
      ],
    },
  },
  {
    path: '/dictionary/:category',
    name: 'dictionary.category',
    component: () => import('@/views/Dictionary/DictionaryCategory.vue'),
    meta: {
      pageTitle: 'Kategorie',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Słownik',
          active: false,
          to: '/dictionary',
        },
        {
            text: 'Kategoria',
            active: false,
        },
      ],
    },
  },
  {
    path: '/time_play/play/:num_sec',
    name: 'play.show',
    component: () => import('@/views/Time_play/Play.vue'),
    meta: {
      pageTitle: 'Test',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
            text: 'Gry',
            active: false,
            to: '/time_play/time_play_categories',
          },
        {
          text: 'Test',
          active: false,
        },
      ],
    },
  },
  {
    path: '/time_play/time_play_categories',
    name: 'time_play.time_play_categories',
    component: () => import('@/views/Time_play/Time_play_categories.vue'),
    meta: {
      pageTitle: 'Gry czasowe',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Gry',
          active: false,
        },
      ],
    },
  },
  {
    path: '/time_play/time_play_history/:num_sec',
    name: 'time_play.time_play_history',
    component: () => import('@/views/Time_play/Time_play_history.vue'),
    meta: {
      pageTitle: 'Historia gier czasowych',
      loggedIn: true,
      roles: ['admin', 'user'],
      breadcrumb: [
        {
          text: 'Gry',
          active: false,
          to: '/time_play/time_play_categories',
        },
        {
          text: 'Historia',
          active: false,
        },
      ],
    },
  },

]
export default mainRoutes
