import commentIndex from "./comment/index";
import {createStore} from 'vuex';

const store = createStore({
    modules: {
        commentIndex: commentIndex,
    }
});

export default store;



