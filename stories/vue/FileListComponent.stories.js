import Vue from 'vue';
import FileListComponent from '../../resources/js/components/FileListComponent.vue';

require('bootstrap/dist/css/bootstrap.css');

export default { title: 'File List Component' };

export const undefinedItems = () => ({
    components: { FileListComponent },
    template: '<file-list-component></file-list-component>'
});