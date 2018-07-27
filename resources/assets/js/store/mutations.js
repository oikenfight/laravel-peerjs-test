export default {
    CONNECT_PEER (state, connection) {
        state.connection = connection
    },

    CONNECTED (state) {
        state.isConnected = true
    },

    DISCONNECTED (state) {
        state.isConnected = false
    },
}