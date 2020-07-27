import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Chat from '../views/Chat.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/chat',
    name: 'Chat',
    component: Chat
  }
]

const router = new VueRouter({
  routes
})

let isAuthenticated = true;

router.beforeEach((to, from, next) => {
  if(to.name === 'Chat' && !isAuthenticated) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router
