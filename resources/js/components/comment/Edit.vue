<template>
    <h2>Редактирование комментария</h2>
    <Textarea v-model="model.data.text" rows="5" cols="30" style="width: 100%"/>
    <Button @click="back" label="Назад" class="p-button-sm p-button-info m-4"/>
    <Button @click="edit" label="Сохранить" class="p-button-sm p-button-success"/>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "Edit",
    data() {
        return {
            url: {
                model: '/api/comment',
            },
            value: null,
        };
    },
    computed: {
        ...mapGetters('commentIndex', ['model', 'modelTree', 'loading', 'node']),
    },
    mounted() {

        console.log(this.$router.currentRoute.value.params.id);

        if (this.$router.currentRoute.value.params.id !== 'new') {
            this['commentIndex/fetchGet']({url: this.url['model'] + '/' + this.$router.currentRoute.value.params.id})
        }
    },
    methods: {
        ...mapMutations('commentIndex', ['modelSet', 'modelTreeSet', 'loadingSet']),
        ...mapActions([
            'commentIndex/fetchGet',
            'commentIndex/fetchPost',
            'commentIndex/fetchPut',
            'commentIndex/fetchDel',
        ]),


        add() {
            // сделать запрос в БД
            this['commentIndex/fetchPost']({url: this.url['model'], body: {value: this.value}})
                .then((response) => {
                    response.json().then((r) => {
                        // commit('modelSet', r);
                        // commit('loadingSet', state.loading--);
                        // console.log('loadingSet', state.loading);
                        // console.log('modelSet', r);
                    });
                });
            // если ответ успешно  то

        },
        edit() {
            console.log(this.$router.currentRoute.value.params.id);
            this['commentIndex/fetchPut']({
                url: this.url['model'] + '/' + this.$router.currentRoute.value.params.id,
                body: {text: this.model.data.text}
            });
        },
        back() {
            this.$router.push({name: 'comment.index'});
        },


        // edit(id) {
        //     // if (id == 'new'){
        //     this['programCommon/tabActiveSet'](0);
        //     // }
        //
        //     this['programCommon/pageNameSet']('program_edit');
        //     this.$router.push({name: 'program.hub', params: {id: id}});
        // },
        // tree(v) {
        //
        // }
    }
}
</script>

<style scoped>

</style>
