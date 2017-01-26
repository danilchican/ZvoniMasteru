import Room         from './components/Room.vue'
import VueRouter    from 'vue-router'
import Vue          from 'vue'

// Use plugin.
// This installs <router-view> and <router-link>,
// and injects $router and $route to all router-enabled child components
Vue.use(VueRouter)

//Define route components
const Account = { template: '<h3>Account</h3>' }
const Services = { template: '<h3>Services</h3>' }
const Specialities = { template: '<h3>Specialities</h3>' }
const Portfolio = { template: '<h3>Portfolio</h3>' }
const Reviews = { template: '<h3>Reviews</h3>' }
const Tariffs = { template: '<h3>Tariffs</h3>' }

export default new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    routes: [
        { path: '/account', component: Account },
        { path: '/account/services', component: Services },
        { path: '/account/specialities', component: Specialities },
        { path: '/account/portfolio', component: Portfolio }, // example of route with a seperate component
        { path: '/account/reviews', component: Reviews },
        { path: '/account/tariffs', component: Tariffs }
    ]
});