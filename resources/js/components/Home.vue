<template>
    <div>
         <div class='home'>
            <div class='container'>
                <div class='banner-principal'>
                    <div class='desc'>
                        <h3>O meu site esta offline ?</h3>
                        <p>Caiu para todos ou so para mim</p>
                        <form @submit.prevent="SearchDomain">
                            <input type="text" v-model.trim="$v.search.$model"
                            name="search" :class="{error: $v.search.$model}">
                            <button type="submit" :disabled="SubmitStatus">
                                <span v-if="SubmitStatus">Descobrindo...</span> 
                                <span v-if="!SubmitStatus">Desobrir</span>
                            </button>
                        </form>
                    </div>
                    <div class='server-response' v-if="searchResponse != null">
                            <div v-if="searchResponse  === true">
                                <p>Esta tudo certo icone-feliz</p>
                                <span>Esta tudo normal por aqui</span>
                            </div>

                            <div v-if="searchResponse  === false">
                                <p v-if="erros === false">Realmente esta fora icone-triste</p>
                                <span v-if="erros === false">Nao conseguimos acessar o seu site</span>
                            </div>
                            <div v-if="erros === true">
                                <p>Dominio invalido</p>
                                <span>tem certeza que eh esse o dominio ?</span>
                            </div>
                    </div>
                </div>
                <div class='mais-vistos'>
                    <h3>Ultimas consultas realizadas</h3>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="domain in alldomain.data" :key="domain.id">
                                                        <td>{{domain.name_url}}</td>
                                                        <td>{{dateTime(domain.time_search)}}</td>
                                                        <td v-if="domain.status=== 1"><i class="bi bi-emoji-smile-fill"></i> FUNCIONANDO NORMALMENTE</td>
                                                        <td v-if="domain.status=== 0"><i class="bi bi-x-circle-fill"></i> FORA DO AR</td>
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

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import { required} from 'vuelidate/lib/validators'
    export default {
        data()
        {
            return{
                search:'',
                searchResponse:'',
                alldomain:[],
                alldomainStatus:true,
                SubmitStatus:false,
                error:{},
                erros:false
            }
        },
        validations:{
            search:{
                required,
            }
        },
        async created(){
            await this.getAllDomain();
        },
        methods:{
             SearchDomain(){
                this.SubmitStatus =true;
                axios.post("http://127.0.0.1:8000/api/search/"+this.search)
                .then(()=>{
                    this.erros = false;
                    this.searchResponse = true;
                    this.getAllDomain();
                }).catch((err)=>{
                    this.error = err;
                    this.erros = true;
                    this.searchResponse = false;   
                }).finally(()=>{
                    this.SubmitStatus = false;
                })
            },
            getAllDomain(){
                axios.get("http://127.0.0.1:8000/api/apache_service_dbs")
                .then(({data})=>{
                    this.alldomain = data
                })
                .catch((error)=>{
                    this.alldomainStatus = false;
                })
            },
            dateTime(h){
                moment.locale("pt"); 
                return h;
            }
        }
    }
</script>
