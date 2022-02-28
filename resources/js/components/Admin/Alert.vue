<template>
    <div>
        <Notify/>
        <div class="row">
            <div class="col-md-8">
                <div class="Modal-delete" v-if="modal">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{name}}</h2>
                        </div><!--remover-->
                        <div class="card-body">
                            <h3>Tem certeza que deseja remover ?</h3>
                        </div><!--body-->
                        <div class="card-footer">
                            <button class="btn btn-danger">Remover</button>
                            <button @click="modalOFF" class="btn btn-dark">Cancelar</button>
                        </div><!--footer-->
                    </div>
                    {{deleteCode}}
                </div><!--modal-delete-->
            </div><!--col-->
        </div><!--row-->
        <div class="Alert container">
            <div class="new_alert">
                    <div class="col-md-6 col-12">
                        <form class="form form-vertical" @submit.prevent="createDomain">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first-name-vertical"> Novo dominio</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control" name="url_name"
                                                v-model="form.url_name"
                                                placeholder="exemplo.com">
                                        </div>
                                    </div>
                                    <div class="col-6 my-4">
                                        <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1" :disabled="SubmitStatus">
                                            <span v-if="SubmitStatus">criando o dominio...</span>
                                            <span v-if="!SubmitStatus">Novo dominio</span>
                                        </button>
                                        <button type="reset"
                                            class="btn btn-dark me-1 mb-1" :disabled="SubmitStatus">
                                            limpar</button>
                                        </div><!--form-group-->
                                    </div><!--col-6-->
                                    <small class="text-danger" v-if="errors.name">
                                            {{errors.url_name[0]}}
                                    </small>
                                </div>
                            </div>
                        </form>
                    </div>
            </div><!--new_alert-->
                <h3>Meus dominios</h3>
            <!-- Borderless table start -->
            <section class="section">
                <div class="row" id="table-borderless">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <!-- table with no border -->
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                            <tr style="text-transform:uppercase;">
                                                <th>Dominio(url)</th>
                                                <th>Ultima verificacao</th>
                                                <th>Status do site</th>
                                                <th>Acoes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr v-for="domain in alldomain.data" :key="domain.id">
                                                    <td>{{domain.url_name}}</td>
                                                    <td>{{domain.date_time_reset}}</td>
                                                    <td v-if="domain.status=== 1"><i class="bi bi-emoji-smile-fill"></i> FUNCIONANDO NORMALMENTE</td>
                                                    <td v-if="domain.status=== 0"><i class="bi bi-x-circle-fill"></i> FORA DO AR</td>
                                                    <td>
                                                        <a :href="'/admin/alert/edit/'+domain.id" class="btn btn-primary">Editar</a>
                                                        <a href="/admin/show/1" class="btn btn-warning">ver</a>
                                                        <a href="" class="btn btn-danger"
                                                        @click.prevent="Delete(domain.id,domain.url_name)">Remover</a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Borderless table end -->
        </div><!--alert-->
    </div>
</template>
<script>
import Notify from "../Notify.vue";
export default {
    data() {
        return {
            form: {
                url_name: "",
            },
            SubmitStatus: false,
            alldomain: [],
            alldomainStatus: true,
            errors: {},
            modal:false,
            deleteCode:'',
            name:'',
        };
    },
    props: ["id"],
    async created() {
        await this.getAllDomain();
    },
    methods: {
        async createDomain() {
            this.SubmitStatus = true;
            await axios.post("http://127.0.0.1:8000/api/createAlert/" + this.id, this.form)
                .then(() => {
                this.$notify({
                    group: "top",
                    title: "SUCESSO",
                    text: "Site registrado com sucesso"
                }, 4000);
                this.getAllDomain();
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
        async getAllDomain() {
            await axios.get("http://127.0.0.1:8000/api/allAlert/" + this.id)
                .then(({ data }) => {
                this.alldomain = data;
            })
                .catch(() => {
                this.alldomainStatus = false;
            });
        },
        Delete(id,name){
            this.modal= true;
            this.deleteCode =id;
            this.name = name;
        }
        ,modalOFF(){
            this.modal = false;
        }
    },
    components: { Notify }
}
</script>
