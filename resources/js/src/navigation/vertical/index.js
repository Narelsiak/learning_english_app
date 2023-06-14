export default [
  {
    header: 'My account',
  },
  {
    title: 'Profile',
    route: 'home',
    icon: 'CalendarIcon',
  },
  {
    title: 'Agenda',
    route: 'agenda',
    icon: 'CalendarIcon',
  },
  {
    title: 'Prelegenci',
    route: 'agenda.speakers',
    icon: 'MicIcon',
  },
  {
    header: 'Admin',
    roles: [1],
  },
  {
    title: 'Zarządzanie agendą',
    route: 'agenda.manage',
    icon: 'SlidersIcon',
    roles: [1],
  },
  {
    title: 'Partnerzy',
    route: 'partner.index',
    icon: 'BriefcaseIcon',
    roles: [1],
  },
  {
    title: 'Bilety',
    route: 'ticket.index',
    icon: 'DollarSignIcon',
    roles: [1],
  },
  {
    title: 'Kody grupowe',
    route: 'ticket.group.list',
    icon: 'BookmarkIcon',
    roles: [1],
  },
  {
    title: 'DailyWord',
    route: 'DailyWord',
    icon: 'BookmarkIcon',
    roles: [1],
  },
]
