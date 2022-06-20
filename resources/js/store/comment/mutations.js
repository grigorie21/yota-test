const mutations = {
    modelSet (state, payload){
        return state.model = payload;
    },
    loadingSet (state, payload){
        return state.loading = payload;
    },
};

export default mutations;
