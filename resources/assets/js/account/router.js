import Home         from './components/Home.vue'
import Services     from './components/Services.vue'
import Reviews      from './components/Reviews.vue'
import Tariffs      from './components/Tariffs.vue'
import VueRouter    from 'vue-router'
import Vue          from 'vue'

Vue.use(VueRouter)

const Portfolio = { template: '<h3>Portfolio</h3>' }

export default new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    routes: [
        { path: '/account', component: Home },
        { path: '/account/services', component: Services },
        { path: '/account/portfolio', component: Portfolio },
        { path: '/account/reviews', component: Reviews },
        { path: '/account/tariffs', component: Tariffs }
    ]
});