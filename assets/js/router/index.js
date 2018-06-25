import Vue from 'vue';
import Router from 'vue-router';
import Homepage from '../pages/Homepage.vue';
import Film_card from '../pages/Film_card.vue';
import Films_list from '../pages/Films_list.vue';
import Form from '../pages/Form.vue';
import Quiz_question from '../pages/Quiz_question.vue';
import Quiz_answer from '../pages/Quiz_answer.vue';
import Quiz_results from '../pages/Quiz_results.vue';
import Search from '../pages/Search.vue';
Vue.use(Router);
Vue.use(Film_card);



export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Homepage
        },
        {
            path: '/film/:id',
            name: 'film',
            component: Film_card,
            params: true
        },
        {
            path:'/list',
            name: 'list',
            component: Films_list
        },
        {
            path:'/search',
            name: 'search',
            component: Search
        },
        {
            path: '/form',
            name: 'form',
            component: Form
        },
        {
            path: '/question',
            name: 'question',
            component: Quiz_question,
            props: true
        },
        {
            path: '/answer',
            name: 'answer',
            component: Quiz_answer
        },
        {
            path: '/results',
            name: 'results',
            component: Quiz_results
        },
    ],
    scrollBehavior (to, from) {
        return { x: 0, y: 0 }
    }
})

