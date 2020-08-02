import Vue from 'vue';
import ExampleComponent from '../../resources/js/components/ExampleComponent.vue';

require('bootstrap/dist/css/bootstrap.css');

export default { title: 'Example Component' };

export const exampleComponent = () => ({
    components: { ExampleComponent },
    template: '<example-component></example-component>'
});