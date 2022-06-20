<template>
    <div>{{model}}</div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "Index",
    data() {
        return {
            url: {
                model: '/api/comment',
            },
        };
    },
    computed: {
        ...mapGetters('commentIndex', ['model', 'loading']),
    },
    mounted() {
        this['commentIndex/fetchGet']({url: this.url['model']});
    },
    methods: {
        ...mapMutations('commentIndex', ['modelSet', 'loadingSet']),
        ...mapActions([
            'commentIndex/fetchGet',
            'commentIndex/fetchPost',
            'commentIndex/fetchPut',
            'commentIndex/fetchDel',
        ]),

        edit(id) {
            // if (id == 'new'){
            this['programCommon/tabActiveSet'](0);
            // }

            this['programCommon/pageNameSet']('program_edit');
            this.$router.push({name: 'program.hub', params: {id: id}});
        },
}
}
</script>

<style scoped>

</style>
