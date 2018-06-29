import Vue from 'vue'
import Router from 'vue-router'

// Components
import Splash from '../components/Splash'
import About from '../components/About'
import Services from '../components/Services'
import Portfolio from '../components/Portfolio'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes:
  [
    {
      path: '/',
      name: 'Splash',
      component: Splash
    },
    {
      path: '/about',
      name: 'About',
      component: About
    },
    {
      path: '/services',
      name: 'Services',
      component: Services
    },
    {
      path: '/portfolio',
      name: 'Portfolio',
      component: Portfolio
    }
  ]
})
