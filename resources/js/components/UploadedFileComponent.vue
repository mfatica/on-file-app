<template>
    <div class="card">
        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{upload.name}}</h5>
            
            <div>
                <vue-tags-input
                    v-model="tag"
                    :tags="upload.tags"
                    @tags-changed="tagsChanged"
                    @before-adding-tag="beforeAddingTag"
                    @before-deleting-tag="beforeDeletingTag"
                    :autocomplete-items="filteredItems"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
        components: {
            VueTagsInput
        },
        props: {
            upload: Object
        },
        data() {
            return {
                tag: '',
                autocompleteItems: [{
                    'text': 'tom'
                }, {
                    'text': 'dick'
                }, {
                    'text': 'harry'
                }]
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            tagsChanged(newTags) {
                console.log(this.upload.tags, newTags);
                this.upload.tags = newTags;
            },
            beforeAddingTag(obj) {
                const text = obj.tag.text;
                const addTag = obj.addTag;

                const tagExists = this.upload.tags.some(function (tag) {    
                    return tag.text === text;
                });

                if (tagExists) {
                    return;
                }

                axios.post('/api/uploads/' + this.upload.id + '/tags/' + text)
                    .then(_ => {
                        addTag();
                    });
            },
            beforeDeletingTag(obj) {
                const tag = obj.tag;
                const deleteTag = obj.deleteTag;

                axios.delete('/api/uploads/' + this.upload.id + '/tags/' + tag.text)
                    .then(_ => {
                        deleteTag();
                    });
            }
        },
        computed: {
            filteredItems() {
                return this.autocompleteItems.filter(i => {
                    return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
                });
            }
        }
    }
</script>
