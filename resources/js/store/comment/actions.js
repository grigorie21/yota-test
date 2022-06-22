import {router} from "../../app.js"

const actions = {
    fetchIndex({commit, state}, payload) {
        commit('loadingSet', state.loading++);

        return fetch(payload.url, {
            method: 'GET',
        }).then((response) => {
            response.json().then((r) => {
                commit('modelSet', r);
                commit('modelTreeSet', r);
                commit('loadingSet', state.loading--);
            });
        });
    },
    fetchGet({commit, state}, payload) {
        commit('loadingSet', state.loading++);
        return fetch(payload.url, {
            method: 'GET',
        }).then((response) => {
            response.json().then((r) => {
                commit('modelSet', r);
                commit('loadingSet', state.loading--);
            });
        });
    },
    fetchPut({commit, state}, payload) {
        return fetch(payload.url, {
            method: 'PUT',
            headers: state.headers,
            body: JSON.stringify(payload.body),
        }).then((response) => {
            response.json().then((r) => {
                if (r.success) {
                    // router.push({name: 'comment.edit', params: {id: r.data.id}});
                }
            });
        });
    },
    fetchPost({commit, state}, payload) {
        return fetch(payload.url, {
            method: 'POST',
            headers: state.headers,
            body: JSON.stringify(payload.body),
        }).then((response) => {
            response.json().then((r) => {
                if (r.success) {
                    router.push({name: 'comment.edit', params: {id: r.data.id}});
                }
            });
        });
    },
    fetchDel({dispatch, commit, state}, payload) {
        return fetch(payload.url + '/' + payload.id, {
            method: 'DELETE',
            headers: state.headers,
        }).then((response) => {
            response.json().then((r) => {
                if (r.data.success) {
                    dispatch('fetchIndex', {url: payload.url});
                }
            });
        });
    },
};

export default actions;
