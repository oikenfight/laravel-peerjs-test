import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'
import Peer from 'peerjs'

Vue.use(Vuex)

const state = {
    peer: new Peer({
        host: '127.0.0.1',
        port: 9000,
        path: '/peerjs',
        debug: 3,
        proxied: true,
    }),
    message: '',
}

export default new Vuex.Store({
    state,
    actions,
    getters,
    mutations,
})