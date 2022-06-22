import {createApp} from 'vue';
import PrimeVue from 'primevue/config';
import {createRouter, createWebHashHistory} from 'vue-router';
import TreeTable from 'primevue/treetable';
import Vuex from 'vuex'
import Store from './store/store'

import RootIndex from './components/Index'
import CommentIndex from './components/comment/Index'
import CommentEdit from './components/comment/Edit'

const app = createApp(RootIndex);

const routes = [
    {path: '/', name: 'comment.index', component: CommentIndex},
    {path: '/:id', name: 'comment.edit', component: CommentEdit},
]

export const router = createRouter({
    history: createWebHashHistory(),
    routes: routes,
});

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import InputText from 'primevue/inputtext';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Button from 'primevue/button';
import ProgressSpinner from 'primevue/progressspinner';
import ProgressBar from 'primevue/progressbar';
import Menubar from 'primevue/menubar';
import Dropdown from 'primevue/dropdown';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Toolbar from 'primevue/toolbar';
import Dialog from 'primevue/dialog';
import InputNumber from 'primevue/inputnumber';
import Card from 'primevue/card';
import Menu from 'primevue/menu';
import Textarea from 'primevue/textarea';
import Checkbox from 'primevue/checkbox';
import InputSwitch from 'primevue/inputswitch';

app.use(ToastService);
app.use(router);
app.use(PrimeVue);
app.use(Vuex);
app.use(Store);

app.component('TreeTable', TreeTable);
app.component('Column', Column);
app.component('TabView', TabView);
app.component('TabPanel', TabPanel);
app.component('InputText', InputText);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('ColumnGroup', ColumnGroup);
app.component('Button', Button);
app.component('ProgressSpinner', ProgressSpinner);
app.component('ProgressBar', ProgressBar);
app.component('Menubar', Menubar);
app.component('Dropdown', Dropdown);
app.component('Toast', Toast);
app.component('Toolbar', Toolbar);
app.component('Dialog', Dialog);
app.component('InputNumber', InputNumber);
app.component('Card', Card);
app.component('Menu', Menu);
app.component('Textarea', Textarea);
app.component('Checkbox', Checkbox);
app.component('InputSwitch', InputSwitch);

app.mount('#app');
