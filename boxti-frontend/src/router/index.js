import Vue from 'vue'
import Router from 'vue-router'
import ListCandidate from '../views/ListCandidate.vue'
import FormCandidate from '../views/FormCandidate.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    hash: false,
    routes: [
        {
            path: '/',
            name: 'ListCandidate',
            component: ListCandidate,
        },
        {
            path: '/form-candidate',
            name: 'FormCandidate',
            component: FormCandidate,
        }
    ]
})
