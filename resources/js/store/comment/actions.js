const actions = {
    fetchGet({commit, state}, payload) {
        commit('loadingSet', state.loading++);

        return fetch( payload.url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            response.json().then((r) =>
            {
                commit('modelSet', r);
                commit('loadingSet', state.loading--);
            });
        });
    },
    fetchPut({commit, state}, payload) {
        return fetch(payload.url, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(),
        });
    },
    fetchPost({commit, state}, payload) {
        return fetch(payload.url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload.variable),
        });
    },
    fetchDel({commit, state}, payload) {
        return fetch(payload.url, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload.variable),
        });
    },
};

export default actions;
