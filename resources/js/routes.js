const Welcome = () => import('./components/Welcome.vue')
const ImageList = () => import('./components/category/List.vue')
const ImageCreate = () => import('./components/category/Add.vue')
const ImageView = () => import('./components/category/View.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'imageList',
        path: '/images',
        component: ImageList
    },
    {
        name: 'imagesAdd',
        path: '/images/add',
        component: ImageCreate
    },
    {
        name: 'imagesView',
        path: '/images/:id/view',
        component: ImageView
    }
]