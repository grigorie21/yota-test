<template>
    {{expandedKeys}}
    <div class="card">
        <h5>Basic</h5>
        <Button @click="edit()" icon="pi pi-plus" iconPos="right" class="p-button-sm p-button-success" />
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
        <!--        <TreeTable :value="nodes">-->
        <!--            <Column field="name" header="Name" :expander="true"></Column>-->
        <!--            <Column field="size" header="Size"></Column>-->
        <!--            <Column field="type" header="Type"></Column>-->
        <!--        </TreeTable>-->
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
            nodes: null,
            columns: null,
            expandedKeys: {}
        };
    },
    computed: {
        ...mapGetters('commentIndex', ['model', 'modelTree', 'loading', 'node']),
    },
    mounted() {
        this['commentIndex/fetchIndex']({url: this.url['model']});

        this.nodes = this.modelTree.data;

        if (this.node){
            console.log('node', this.node);
            this.expandNode(this.node);
            console.log('expandnodekeys', this.expandedKeys);

        }


        console.log(222, this.nodes);
        this.columns = [
            {field: 'id', header: 'id', expander: true},
            {field: 'text', header: 'text'},
            {field: 'created_at', header: 'created_at'},
            {field: 'updated_at', header: 'updated_at'}
        ];
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

        // edit(id) {
        //     // if (id == 'new'){
        //     this['programCommon/tabActiveSet'](0);
        //     // }
        //
        //     this['programCommon/pageNameSet']('program_edit');
        //     this.$router.push({name: 'program.hub', params: {id: id}});
        // },
        // add(v){
        //     console.log(v);
        //     console.log(v.node.key);
        //     console.log(v.node.data);
        //
        // },

        add(v) {
            // this.$router.push({name: 'comment.index'});

            console.log(34, v);
            this.nodeSet(v.node);
            console.log(345, this.node);


            this['commentIndex/fetchPost']({
                url: this.url['model'],
                body: {
                    parent_id: v.node.data.id
                }
            });


            // this.$router.push({name: 'comment.edit', params: {id: 'new'}});
        },
        addNew(v) {
            this.nodeSet(null);

            this['commentIndex/fetchPost']({
                url: this.url['model'],
                body: {
                    parent_id: v.node.data.id
                }
            });


            // this.$router.push({name: 'comment.edit', params: {id: 'new'}});
        },
        del(v){
            this['commentIndex/fetchDel']({
                url: this.url['model'],
                // key: v.node.key,
                id: v.node.data.id
            });
        },
        edit(v){
            this.nodeSet(v.node);
            this.$router.push({name: 'comment.edit', params: {id: v.node.data.id}});
        },
        expandNode(node) {
            console.log('expandNode', node)
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
