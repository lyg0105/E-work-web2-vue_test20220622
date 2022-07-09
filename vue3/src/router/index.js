import { createWebHistory, createRouter } from "vue-router";
import Home from "@/views/Home.vue";
import About from "@/views/About.vue";
import Accodion from "@/views/Accodion.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    component: About,
  },
  {
    path: "/accodion",
    name: "Accodion",
    component: Accodion,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;