import { createRouter, createWebHistory } from 'vue-router'

import Dashboard from '../pages/Dashboard.vue'
import CollectionDetails from '../pages/CollectionDetails.vue'

const router = createRouter({
    linkExactActiveClass: 'active',
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
        }, {
            path: '/collection-details/:id',
            name: 'collectionDetails',
            component: CollectionDetails,
        },
    ],
})

export default router
