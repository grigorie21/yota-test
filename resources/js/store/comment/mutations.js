function transformTree(srcTree, outTree) {
    srcTree.nested.forEach((srcChild, idx) => {
        let childId = outTree.key === undefined ? idx : outTree.key + "-" + idx;
        let outChild = {
            'key': childId,
            'data': {
                'id': srcChild.id,
                'text': srcChild.text,
                'created_at':  srcChild.created_at,
                'updated_at':  srcChild.updated_at,
            },
        };
        outTree.children.push(outChild);
        if (srcChild.nested.length) {
            outChild.children = [];
            transformTree(srcChild, outChild);
        }
    });
}

// function delTreeBranch(srcTree, outTree) {
//     srcTree.nested.forEach((srcChild, idx) => {
//         let childId = outTree.key === undefined ? idx : outTree.key + "-" + idx;
//         let outChild = {
//             'key': childId,
//             'data': {
//                 'id': srcChild.id,
//                 'text': srcChild.text,
//                 'created_at':  srcChild.created_at,
//                 'updated_at':  srcChild.updated_at,
//             },
//         };
//         outTree.children.push(outChild);
//         if (srcChild.nested.length) {
//             outChild.children = [];
//             transformTree(srcChild, outChild);
//         }
//     });
// }

const mutations = {
    modelSet(state, payload) {
        return state.model = payload;
    },
    modelTreeSet(state, payload) {
        let displayTree = {children: []};
        transformTree({nested: payload.data}, displayTree);

        return state.modelTree = displayTree.children;
    },
    modelTreeDelSet(state, payload) {


        return state.modelTree = 1;
    },
    loadingSet(state, payload) {
        return state.loading = payload;
    },
    nodeSet(state, payload) {
        return state.node = payload;
    },
};

export default mutations;
