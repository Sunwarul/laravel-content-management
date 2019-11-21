<template>
    <div id="app">
        <h1>{{ me }}</h1>
        <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" name="content" tag-name="textarea"></ckeditor> -->
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        props: ['title'],
        data() {
            return {
                me: 'Sunwarul',
                // editor: ClassicEditor,
                // editorData: '',
                // // editorData: this.prev_content,
                // editorConfig: {},
            };
        },
        mounted() {
            // this.me  = this.title
        }
    }
</script>
