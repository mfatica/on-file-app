import Vue from 'vue';
import UploadedFileComponent from '../../resources/js/components/UploadedFileComponent.vue';

require('bootstrap/dist/css/bootstrap.css');

export default { title: 'Uploaded File Component' };

export const noTags = () => ({
    components: { UploadedFileComponent },
    template: '<uploaded-file-component :tags="[]"></uploaded-file-component>'
});

export const withTags = () => ({
    components: { UploadedFileComponent },
    data() {
        return {
            tags: [{text: "abc"}]
        }
    },
    template: '<uploaded-file-component :tags="tags"></uploaded-file-component>'
});

export const multiple = () => ({
    components: { UploadedFileComponent },
    template: `
    <div class="container">
        <div class="row">
            <div class="col-3-sm">
                <uploaded-file-component :tags="[]"></uploaded-file-component>
            </div>
            <div class="col-3-sm">
                <uploaded-file-component :tags="[]"></uploaded-file-component>
            </div>
            <div class="col-3-sm">
                <uploaded-file-component :tags="[]"></uploaded-file-component>
            </div>
            <div class="col-3-sm">
                <uploaded-file-component :tags="[]"></uploaded-file-component>
            </div>
            <div class="col-3-sm">
                <uploaded-file-component :tags="[]"></uploaded-file-component>
            </div>
        </div>
    </div>
    `
});