const routes = [
    {
        path: '/',
        name: 'index',
        component: require('../components/Login.vue').default
    },   
    
    //#region PRODUCTS
    {
        path: '/products/create',
        name: 'products.create',
        component: require('../components/products/Create.vue').default
    },
    {
        path: '/products',
        name: 'products',
        component: require('../components/products/Index.vue').default
    },
    {
        path: '/products/:product',
        name: 'products.show',
        component: require('../components/products/Show.vue').default
    },
    {
        path: '/products/:product/edit',
        name: 'products.edit',
        component: require('../components/products/Edit.vue').default
    },    
    //#endregion

    {
        path: '/:pathMatch(.*)*',
        component: require('../components/PageNotFound.vue').default
    },
];

export default routes;