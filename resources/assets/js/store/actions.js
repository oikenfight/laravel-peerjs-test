export default {
    connectPeer ({commit}, connection) {
        commit('CONNECT_PEER', connection)
        commit('CONNECTED')
    },
}