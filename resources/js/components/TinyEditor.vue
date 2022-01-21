<template>
    <div>
        <editor v-model="content" :init="options"
                ref="tiny"
                output-format="html"
                api-key="pybsvxv1sh17qxt52kkecs5ra7tyagdpp7xqpwf9dm26ifq4"></editor>
        <div class="row">
            <div class="col">
                <span class="badge"
                      :class="content.includes('{name}') ? 'badge-secondary': 'badge-primary'"
                      @click.prevent="insertVariable('{name}')">{name}</span>
            </div>
        </div>
        <button class="btn btn-success mt-3" id="btnSave" @click.prevent="update">Save</button>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
import axios from "axios";
import he from "he"
export default {
    name: "TinyEditor",
    props: {
        data: {
            type: String,
            default: null
        },
        type:{
            default: 'single-will'
        }
    },
    data() {
        return {
            content: '',
            options: {
                plugins: 'autoresize',
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | help'
            }
        }
    },
    components: {
        Editor
    },
    methods: {
        hasString(string) {
            return this.content.includes(string)
        },
        insertVariable(text) {
            if (this.content.includes(text)) {
                console.log('String Already available')
            } else {
                this.$refs.tiny.editor.execCommand('mceInsertContent', false, text)
            }
        },
        update() {
            axios.post('/form/update', {
                content: this.content,
                form: this.type
            }).then(res => {
                this.$notify({
                    type: 'success',
                    title: 'Update',
                    text: 'Will form updated successfully'
                })
            }).catch(err => {
                console.log(err.error);
                this.$notify({
                    type: 'error',
                    title: 'Update',
                    text: 'Will form updated successfully'
                })
            });
        }
    },
    mounted() {
        this.content = he.decode(this.data)
    }
}
</script>

<style scoped>

</style>
