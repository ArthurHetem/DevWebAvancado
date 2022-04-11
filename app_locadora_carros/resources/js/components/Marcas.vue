<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- INICIO CARD BUSCA -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <input-container-component
                                        titulo="ID"
                                        id="inputId"
                                        id-help="idHelp"
                                        texto-ajuda="Opcional. Informe o ID da marca">
                                            <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                    </input-container-component>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <input-container-component
                                        titulo="Nome da marca"
                                        id="inputNome"
                                        id-help="nomeHelp"
                                        texto-ajuda="Opcional. Informe o nome da marca">
                                            <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome">
                                    </input-container-component>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                        </div>
                    </template>
                </card-component>
                <!-- FIM CARD BUSCA -->
                <!-- INICIO CARD RELACAO DE MARCAS -->
                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-sm float-end btn-primary" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                    </template>
                </card-component>
                <!-- FIM CARD RELACAO DE MARCAS -->
            </div>
        </div>
        <modal-component id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:alertas>
                <alert-component v-if="transacaoStatus == 'Adicionado'" tipo="success"></alert-component>
                <alert-component v-if="transacaoStatus == 'Erro'" tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a marca"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component
                        titulo="Nome da marca"
                        id="novoNome"
                        id-help="novoNomeHelp"
                        texto-ajuda="Informe o nome da marca">
                            <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="nomeMarca">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component
                        titulo="Logo da marca"
                        id="inputLogo"
                        id-help="logoHelp"
                        texto-ajuda="Selecione o logo da marca">
                            <input type="file" class="form-control" id="inputLogo" aria-describedby="logoHelp" placeholder="Logo da marca" @change="carregarImagem($event)">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="cadastrarMarca()">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                urlBase: 'http://localhost:8002/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: '',
                transacaoDetalhes: [],
                marcas: [],
            }
        },
        computed: {
                token(){
                    return  'Bearer ' + document.cookie.split(';').find(row => row.includes('token=')).split('=')[1]
                }
            },
        methods: {
            carregarLista() {
                axios.get(this.urlBase)
                    .then(response => {
                        this.Marcas = response.data
                    }).catch(error => {
                        console.log(error)
                    })
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files;
            },
            cadastrarMarca() {

                let formData = new FormData();

                formData.append('nome', this.nomeMarca);
                formData.append('imagem', this.arquivoImagem[0]);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                .then(response => {
                    console.log(response)
                    this.transacaoStatus = 'Adicionado'
                })
                .catch(error => {
                    console.log(error)
                    this.transacaoStatus = 'Erro'
                    this.transacaoDetalhes = error.response
                })
            }
        },
        mounted() {
            this.carregarLista()
        }
    }
</script>
