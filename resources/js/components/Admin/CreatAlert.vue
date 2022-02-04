<template>
<div class="container form">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" @submit.prevent="insertAlert">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Dominio</label>
                                        <input type="text" id="first-name-vertical"
                                            class="form-control" name="url_name"
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
</template>
<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        async insertAlert(){
            await axios.post()
            .then()
            .catch();
        }      
    }
    
}
</script>