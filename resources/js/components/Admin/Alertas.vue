<template>
    <div>
        <div class="Alert container">
            <div class="new_alert">
                    <div class="col-md-6 col-12">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first-name-vertical"> Novo dominio</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control" name="url_name"
                                                placeholder="exemplo.com">
                                        </div>
                                    </div>
                                    <div class="col-6 my-4">
                                        <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">novo dominio</button>
                                        <button type="reset"
                                            class="btn btn-dark me-1 mb-1">limpar</button>
                                        </div><!--form-group-->
                                    </div><!--col-6-->
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
                                            <tr>
                                                <td>llmagaia</td>
                                                <td>hoje</td>
                                                <td>icone-certo FUNCIONANDO NORMALMENT</td>
                                                <td>
                                                    <a href='/admin/editar/1' class="btn btn-primary">Editar</a>
                                                    <a href="/admin/show/1" class="btn btn-warning">ver</a>
                                                    <a href="" class="btn btn-danger">Remover</a>
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
export default {
    
}
</script>