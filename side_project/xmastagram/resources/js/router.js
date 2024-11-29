import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from "../views/components/auth/LoginComponent.vue";
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';

const routes = [
    {
        path: '/login',
        component: LoginComponent,
    },
    {
        path: '/boards',
        component: BoardListComponent,
    },
    {
        path: '/boards/create',
        component: BoardCreateComponent,
    },
    {
        path: '/registration',
        component: UserRegistrationComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;