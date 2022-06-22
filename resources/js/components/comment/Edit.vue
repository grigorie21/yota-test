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
            this['commentIndex/fetchPost']({url: this.url['model'], body: {value: this.value}});
        },
        edit() {
            this['commentIndex/fetchPut']({
                url: this.url['model'] + '/' + this.$router.currentRoute.value.params.id,
                body: {text: this.model.data.text}
            });
        },
        back() {
            this.$router.push({name: 'comment.index'});
        },
    }
}
</script>

<style scoped>

</style>
