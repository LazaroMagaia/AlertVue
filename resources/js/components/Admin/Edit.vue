<template>
<div>
    <Notify/>
    <div class="container form">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" @submit.prevent="updateDomain">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Dominio</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control" name="url_name"
                                                v-model="form.url_name"
                                                placeholder="exemplo.com">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--container-->
</div>
</template>
<script>
import Notify from "../Notify.vue";
export default {
    data(){
        return{
            form:{
                url_name:""
            },
            errors:{

            }
        }
    },
    props: ["id"],
    methods:{
         async updateDomain() {
            this.SubmitStatus = true;
            await axios.post("http://127.0.0.1:8000/api/editAlert/" + this.id, this.form)
                .then(() => {
                this.$notify({
                    group: "top",
                    title: "SUCESSO",
                    text: "Site registrado com sucesso"
                }, 4000);
                window.location.href="/admin/alert";
            })
                .catch(() => {
                this.$notify({
                    group: "error",
                    title: "SITE INVALIDO",
                    text: "O site ja esta em uso"
                }, 4000);
            })
                .finally(() => {
                this.SubmitStatus = false;
            });
        },
    },
    components: { Notify }

}
</script>
