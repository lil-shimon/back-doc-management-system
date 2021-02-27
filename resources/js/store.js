export default {
    state: {
        isLogin: false,
        user: {}
    },
    user_info: {
        token: ""
    },

    setCurrentUser() {
        axios.post("/api/auth/me", res => {
            this.state.user = res.data.user;
            this.state.isLogin = true;
        });
    },

    /**
     * Init the store.
     */
    init() {
        this.setCurrentUser();
    }
};
