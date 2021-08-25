const routes = [{
        path: '/',
        component: () =>
            import ('../pages/Products.vue'),
        name: 'home'
    },
    {
        path: '/categories',
        component: () =>
            import ('../pages/Categories.vue'),
        name: 'categories'
    }
]

export default routes;