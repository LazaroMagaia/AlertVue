<template>
    <div class="Alert container">
        <div class="show_alert">
            <div class="admin-home-top">
                <div class="single-wrapper">
                    <div>
                        <p>150</p> <span>Quedas</span>
                    </div>
                    <div>
                        <i class="bi bi-x-octagon-fill"></i>
                    </div>
                </div><!--single-wrapper-->
                <div class="single-wrapper">
                    <div>
                        <p>2</p> <span>Membros</span>
                    </div>
                    <div>
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div><!--single-wrapper-->
            </div>
        </div>
        <div class="title-alert-show-estatistic">
             <h1>Estatisticas</h1>
        </div><!--estatistic-->

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
                                        <th>Quando ficou fora do ar</th>
                                        <th>Quando retornou</th>
                                        <th>Tempo que ficou fora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>llmagaia</td>
                                        <td>hoje</td>
                                        <td>05/02/2022 07:20:00</td>
                                        <td>06/02/2022 05:10:00</td>
                                        <td>retornou - ficou fora</td>
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
</template>
<script>
export default {

}
</script>
