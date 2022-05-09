<template>
    <div>
        <editor v-model="content" :init="options"
                ref="tiny"
                output-format="html"
                api-key="pybsvxv1sh17qxt52kkecs5ra7tyagdpp7xqpwf9dm26ifq4"></editor>
        <div class="row">
            <div class="col">
                <span class="badge mr-2"
                      v-for="variable in variables"
                      :class="content.includes(`{{$${variable}}}`) ? 'badge-secondary': 'badge-primary'"
                      @click.prevent="insertVariable(`{{$${variable}}}`)">{{ '{$' + variable + '}' }}</span>
            </div>
        </div>
        <button class="btn btn-success mt-3" id="btnSave" @click.prevent="update">Save</button>

        <div>
            <span> Notes: </span>
            <p>
                For each repeater data the available variables are <br></p>
            <div class="row">
                <div class="col-2">
                    <h5>Address Summary</h5>
                    <ul>
                        <li>
                            city
                        </li>
                        <li>line 1</li>
                        <li> line 2</li>
                        <li>county</li>
                        <li>country</li>
                        <li>postal</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>secondApplicant</h5>
                    <ul>
                        <li>firstName</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>relation</li>
                        <li>email</li>
                        <li>dob</li>
                        <li>city</li>
                        <li>line 1</li>
                        <li> line 2</li>
                        <li>county</li>
                        <li>country</li>
                        <li>postal</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>Executor : *Use foreach loop to put data*</h5>
                    <code>
                        @foreach($executor as $exe)

                        @endforeach
                    </code>
                    <ul>
                        <li>firstName</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>relation</li>
                        <li>email</li>
                        <li>dob</li>
                        <li>city</li>
                        <li>line 1</li>
                        <li> line 2</li>
                        <li>county</li>
                        <li>country</li>
                        <li>postal</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>reserveExecutor : *Use foreach loop to put data*</h5>
                    <code>
                        @foreach($reserveExecutor as $exe)

                        @endforeach
                    </code>
                    <ul>
                        <li>firstName</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>relation</li>
                        <li>email</li>
                        <li>dob</li>
                        <li>city</li>
                        <li>line 1</li>
                        <li> line 2</li>
                        <li>county</li>
                        <li>country</li>
                        <li>postal</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>giftOptions : *Use foreach loop to put data*</h5>
                    <code>
                        @foreach($giftOptions as $gift)

                        @endforeach
                    </code>
                    <ul>
                        <li>giftTo</li>
                        <li>firstName</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>predeceased</li>
                        <li>secondApplicantRelation</li>
                        <li>beneficiary->firstName</li>
                        <li>beneficiary->lastName</li>
                        <li>beneficiary->middleName</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>giftMoney : *Use foreach loop to put data*</h5>
                    <code>
                        @foreach($giftMoney as $gift)

                        @endforeach
                    </code>
                    <ul>
                        <li>firstName</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>relation</li>
                        <li>predeceased</li>
                        <li>moneyDetails</li>
                        <li>secondApplicantRelation</li>
                        <li>secondApplicantRelation</li>
                        <li>beneficiary->firstName</li>
                        <li>beneficiary->lastName</li>
                        <li>beneficiary->middleName</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>giftCharity </h5>
                    <ul>
                        <li>name</li>
                        <li>money</li>
                        <li>reference</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>giftBank : *Use foreach loop on persons data to put data*</h5>
                    <code>
                        @foreach($giftBank['persons'] as $bank)

                        @endforeach
                    </code>
                    <ul>
                        <li>bankName</li>
                        <li>bankReference</li>
                        <li>middleName</li>
                        <li>lastName</li>
                        <li>relation</li>
                        <li>predeceased</li>
                        <li>shareType</li>
                        <li>share</li>
                        <li>moneyDetails</li>
                        <li>secondApplicantRelation</li>
                        <li>beneficiary->firstName</li>
                        <li>beneficiary->lastName</li>
                        <li>beneficiary->middleName</li>
                    </ul>
                </div>
            </div>
        </div>
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
        type: {
            default: 'single-will'
        }
    },
    data() {
        return {
            variables: "",
            content: '',
            options: {
                plugins: 'autoresize image code',
                toolbar: 'insertfile undo redo | formatselect | bold italic image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | help code',
                image_title: true,
                automatic_uploads: true,
                entity_encoding: "raw",
                images_upload_url: '/upload',
                file_picker_types: 'image',
                block_unsupported_drop: false,
                images_upload_handler: function (blobInfo, success, failure, folderName) {
                    var xhr, formData;
                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;

                    xhr.open('POST', '/upload');
                    var token = document.head.querySelector("[name=csrf-token]").content;
                    xhr.setRequestHeader("X-CSRF-Token", token);

                    xhr.onload = function () {
                        var json;

                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }
                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        success(json.location);

                    };

                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);

                }
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
            this.$refs.tiny.editor.execCommand('mceInsertContent', false, text)
        },
        getVariables() {
            axios.get('/form/variables').then(res => {
                this.variables = res.data.variables
            });
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
        this.getVariables()
    }
}
</script>

<style scoped>

</style>
