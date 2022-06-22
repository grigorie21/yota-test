<template>
    <div class="card">
        <Button @click="addNew()" icon="pi pi-plus" iconPos="right" class="p-button-sm p-button-success" />
        <TreeTable :value="modelTree" editMode="cell" class="editable-cells-table" :expandedKeys="expandedKeys">
            <Column field="id" header="Id" :expander="true"></Column>
            <Column field="text" header="text"></Column>
            <Column field="created_at" header="created_at"></Column>
            <Column field="updated_at" header="updated_at"></Column>
            <Column>
                <template #body="slotProps">
                    <Button @click="add(slotProps)" icon="pi pi-plus" iconPos="right" class="p-button-sm p-button-success"/>
                    <Button @click="del(slotProps)" icon="pi pi-trash" iconPos="right" class="p-button-sm p-button-danger" />
                    <Button @click="edit(slotProps)" icon="pi pi-pencil" iconPos="right" class="p-button-sm p-button-warning" />
                </template>
            </Column>
        </TreeTable>
    </div>
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
            expandedKeys: {}
        };
    },
    computed: {
        ...mapGetters('commentIndex', ['model', 'modelTree', 'loading', 'node']),
    },
    watch: {
        modelTree (newVal) {
            if (this.node){
                let topLevel = /(^[^\-]+)(-?)/.exec(this.node.key)[1];
                let topBranch = this.modelTree.find(v => v.key == topLevel);
                this.expandNode(topBranch);
            }
        },
    },
    mounted() {
        this['commentIndex/fetchIndex']({url: this.url['model']});
    },
    methods: {
        ...mapMutations('commentIndex', ['modelSet', 'modelTreeSet', 'loadingSet', 'nodeSet']),
        ...mapActions([
            'commentIndex/fetchGet',
            'commentIndex/fetchIndex',
            'commentIndex/fetchPost',
            'commentIndex/fetchPut',
            'commentIndex/fetchDel',
        ]),
        add(v) {
            this.nodeSet(v.node);

            this['commentIndex/fetchPost']({
                url: this.url['model'],
                body: {
                    parent_id: v.node.data.id
                }
            });
        },
        addNew() {
            this.nodeSet(null);
            this['commentIndex/fetchPost']({
                url: this.url['model'],
                body: {
                    parent_id: null
                }
            });
        },
        del(v){
            this['commentIndex/fetchDel']({
                url: this.url['model'],
                id: v.node.data.id
            });
        },
        edit(v){
            this.nodeSet(v.node);
            this.$router.push({name: 'comment.edit', params: {id: v.node.data.id}});
        },
        expandNode(node) {
            if (node.children && node.children.length) {
                this.expandedKeys[node.key] = true;

                for (let child of node.children) {
                    this.expandNode(child);
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
