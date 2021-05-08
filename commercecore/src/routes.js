import Main from './views/Main.vue'
import Completed from './views/Completed.vue'


export const routes = [
    {
        path: '/',
        component: Main 
    },
    {
        path: '/success',
        component: Completed
    }
]