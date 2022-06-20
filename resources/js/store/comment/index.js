import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    namespaced: true,
    state() {
        return {
            model: {
                data: [],
            },
            loading: 0,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        }
    },
    getters,
    mutations,
    actions
};
