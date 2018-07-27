import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter ({
    routes: [
        // home
        {
            path: '/home',
            component: require('./components/home/Index'),
            children: [
                {
                    path: 'video_chat',
                    component: require('./components/home/VideoChat'),
                },
            ],
        },
        // test
        {
            path: '/test',
            component: require('./components/test/Index'),
            children: [
                {
                    path: 'receiver',
                    component: require('./components/test/Receiver'),
                },
                {
                    path: 'sender',
                    component: require('./components/test/Sender'),
                },
            ],
        },
    ]
})